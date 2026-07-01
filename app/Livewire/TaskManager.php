<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;

class TaskManager extends Component
{
    public $tasks, $title, $description, $task_id;
    public $isEditMode = false;

    public function mount() { $this->loadTasks(); }

    public function loadTasks() {
        $this->tasks = Task::orderBy('created_at', 'desc')->get();
    }

    public function saveTask() {
        $this->validate(['title' => 'required|min:3']);

        Task::updateOrCreate(
            ['id' => $this->task_id],
            ['title' => $this->title, 'description' => $this->description]
        );

        $this->resetInputFields();
        $this->loadTasks();
    }

    public function editTask($id) {
        $task = Task::findOrFail($id);
        $this->task_id = $id;
        $this->title = $task->title;
        $this->description = $task->description;
        $this->isEditMode = true;
    }

    public function deleteTask($id) {
        Task::findOrFail($id)->delete();
        $this->loadTasks();
    }

    public function toggleComplete($id) {
        $task = Task::findOrFail($id);
        $task->update(['is_completed' => !$task->is_completed]);
        $this->loadTasks();
    }

    public function resetInputFields() {
        $this->title = ''; $this->description = ''; $this->task_id = null; $this->isEditMode = false;
    }

    public function render() { return view('livewire.task-manager'); }
}