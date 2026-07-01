<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;

class TaskManager extends Component
{
    public $title, $description, $due_date, $priority = 'Medium', $taskId = null, $isEditMode = false;

    protected $rules = [
        'title' => 'required|min:3',
        'description' => 'required',
        'due_date' => 'required|date',
        'priority' => 'required',
    ];

    public function render()
    {
        return view('livewire.task-manager', [
            'tasks' => Task::orderBy('is_completed', 'asc')->latest()->get()
        ]);
    }

    public function handleAction($action, $id)
    {
        if ($action === 'done') $this->toggleComplete($id);
        elseif ($action === 'edit') $this->editTask($id);
        elseif ($action === 'delete') $this->deleteTask($id);
    }

    public function saveTask()
    {
        $this->validate(); // Awtomatikong mag-eerror kung walang input
        
        Task::updateOrCreate(['id' => $this->taskId], [
            'title' => $this->title,
            'description' => $this->description,
            'due_date' => $this->due_date,
            'priority' => $this->priority
        ]);

        $this->reset(['title', 'description', 'due_date', 'priority', 'taskId', 'isEditMode']);
    }

    public function editTask($id)
    {
        $task = Task::findOrFail($id);
        $this->taskId = $task->id;
        $this->title = $task->title;
        $this->description = $task->description;
        $this->due_date = $task->due_date;
        $this->priority = $task->priority;
        $this->isEditMode = true;
    }

    public function deleteTask($id) { Task::findOrFail($id)->delete(); }

    public function toggleComplete($id) {
        $task = Task::findOrFail($id);
        $task->update(['is_completed' => !$task->is_completed]);
    }
}