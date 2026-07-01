<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tasks = [];
        $pendingCount = 0;
        $doneCount = 0;

        if ($user->name === 'Admin') {
            $pendingCount = Task::where('status', 'pending')->count();
            $doneCount = Task::where('status', 'done')->count();
            // Gamitin ang with('user') para makuha ang name ng student
            $tasks = Task::with('user')->get();
        } else {
            $tasks = Task::where('user_id', $user->id)->get();
        }

        return view('dashboard', compact('pendingCount', 'doneCount', 'tasks'));
    }
}