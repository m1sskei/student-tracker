<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['title' => 'required', 'priority' => 'required', 'due_date' => 'required']);
        Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description ?? '',
            'due_date' => $request->due_date,
            'priority' => $request->priority,
            'status' => 'pending',
        ]);
        return redirect()->route('dashboard');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate(['title' => 'required', 'priority' => 'required', 'due_date' => 'required']);
        $task->update($request->all());
        return redirect()->route('dashboard');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('dashboard');
    }
}