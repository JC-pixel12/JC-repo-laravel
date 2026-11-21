<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskCompletedMail;

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
        $tasks = Task::where('is_archived', false)
            ->orderBy('task_date', 'asc')
            ->get();

        return view('tasks', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'status' => 'required|in:pending,done',
            'task_date' => 'required|date',
        ]);

        $validated['is_archived'] = false;

        Task::create($validated);

        return redirect()->route('tasks')
            ->with('success', 'Task created successfully!');
    }

    public function edit(Task $task)
    {
        if ($task->is_archived) {
            abort(404);
        }

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        if ($task->is_archived) {
            abort(404);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'status' => 'required|in:pending,done',
            'task_date' => 'required|date',
        ]);

        $previousStatus = $task->status;

        $task->update($validated);

        if ($previousStatus !== 'done' && $validated['status'] === 'done') {
            Mail::to(config('mail.task_notification_recipient'))
                ->send(new TaskCompletedMail($task));
        }

        return redirect()->route('tasks')
            ->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        if ($task->is_archived) {
            abort(404);
        }

        $task->update([
            'is_archived' => true
        ]);

        return redirect()->route('tasks')
            ->with('success', 'Task archived successfully!');
    }
}
