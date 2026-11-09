<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function welcome ()
    {
        $tasks = Task::whereDate('task_date', today())
            ->orderBy('task_date')
            ->get();

        return view('welcome', compact('tasks'));
    }

    public function index()
    {
        $tasks = Task::orderBy('task_date', 'asc')
            ->get();

        return view('tasks', compact('tasks'));
    }
}
