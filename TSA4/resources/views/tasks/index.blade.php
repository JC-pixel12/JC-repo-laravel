<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
</head>
<body>
    <h1>Task List</h1>

    <nav>
        <a href="{{ route('welcome') }}">Welcome</a> |
        <a href="{{ route('tasks') }}">Tasks</a> |
        <a href="{{ route('profile') }}">Profile</a> |
        <a href="{{ route('about') }}">About</a>

        @auth
            | <a href="{{ route('tasks.create') }}">Create Task</a>

            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            | <a href="{{ route('login') }}">Login</a>
        @endauth
    </nav>

    <hr>

    @if (session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    @if ($tasks->isEmpty())
        <p>No active tasks found.</p>
    @else

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Status</th>
                <th>Date</th>

                @auth
                    <th>Actions</th>
                @endauth
            </tr>
        </thead>

        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->status }}</td>
                    <td>{{ $task->task_date->format('Y-m-d') }}</td>

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

            @endforeach
        </tbody>
    </table>

    @endif
</body>
</html>