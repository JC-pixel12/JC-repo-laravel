@extends('layouts.app')

@section('title', 'Task List')

@section('content')

<div class="card">
    <h1>Full Task List</h1>

    <p>View all your scheduled tasks.</p>
</div>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Task Title</th>
                <th>Status</th>
                <th>Task Date</th>

                @auth
                    <th>Actions</th>
                @endauth
            </tr>
        </thead>
        <tbody>
            @forelse($tasks as $task)

                <tr>
                    <td>{{$task->id}}</td>
                    <td>{{$task->title}}</td>
                    <td class="{{$task->status}}">{{ucfirst($task->status)}}</td>
                    <td>{{$task->task_date->format('F d, Y')}}</td>

                    @auth
                        <td>
                            <a href="{{ route('tasks.edit', $task) }}">
                                Edit
                            </a>

                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')

                                <button type="submit" onclick="return confirm('Archive this task?')">
                                    Delete
                                </button>

                            </form>
                        </td>

                    @endauth
                </tr>

            @empty

                <tr>
                    <td colspan="4" class="empty">No Tasks available.</td>
                </tr>

            @endforelse
        </tbody>
    </table>
</div>
@endsection