<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
</head>
<body>
    <h1>Edit Task</h1>

    @if ($errors->any())
        <ul style="color:red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Title:</label>
            <input type="text" name="title" value="{{ old('title', $task->title) }}" required>
        </div>

        <br>

        <div>
            <label>Status:</label>
            <select name="status" required>

                <option
                    value="pending"
                    {{ old('status', $task->status) === 'pending' ? 'selected' : '' }}
                >
                    Pending
                </option>

                <option
                    value="done"
                    {{ old('status', $task->status) === 'done' ? 'selected' : '' }}
                >
                    Done
                </option>

            </select>
        </div>

        <br>

        <div>
            <label>Task Date:</label>
            <input type="date" name="task_date" value="{{ old('task_date', $task->task_date->format('Y-m-d')) }}" required>
        </div>

        <br>

        <button type="submit">Update Task</button>
    </form>

    <p>
        <a href="{{ route('tasks') }}">Back to Task List</a>
    </p>
</body>
</html>