<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskManager extends Component
{
    public $title, $description, $due_date, $priority = 'Medium', $taskId = null, $isEditMode = false;

    protected $rules = [
        'title' => 'required|min:3',
        'description' => 'required',
        'due_date' => 'required|date_format:Y-m-d',
        'priority' => 'required',
    ];

    public function render()
    {
        // Isinama natin ang 'with(user)' para makuha ang pangalan ng may-ari
        $query = Task::with('user')->orderBy('is_completed', 'asc')->latest();

        if (!Auth::user()->hasRole('admin')) {
            $query->where('user_id', Auth::id());
        }

        return view('livewire.task-manager', [
            'tasks' => $query->get()
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
        $this->validate();
        
        Task::updateOrCreate(['id' => $this->taskId], [
            'user_id' => Auth::id(),
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
        
        // Security: Bawal i-edit ng ibang student kung hindi sa kanila, pero pwede ang admin
        if ($task->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) { return; }
        
        $this->taskId = $task->id;
        $this->title = $task->title;
        $this->description = $task->description;
        $this->due_date = $task->due_date;
        $this->priority = $task->priority;
        $this->isEditMode = true;
    }

    public function deleteTask($id) { 
        $task = Task::findOrFail($id);
        if ($task->user_id === Auth::id() || Auth::user()->hasRole('admin')) { $task->delete(); }
    }

    public function toggleComplete($id) {
        $task = Task::findOrFail($id);
        if ($task->user_id === Auth::id() || Auth::user()->hasRole('admin')) {
            $task->update(['is_completed' => !$task->is_completed]);
        }
    }
}