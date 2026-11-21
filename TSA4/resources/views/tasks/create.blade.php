@extends('layouts.app')

@section('title', 'Create Task')

@section('content')
    <div class="card">
        <h1>Create New Task</h1>

        @if ($errors->any())
            <ul style="color:red;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf

            <div>
                <label>Title:</label>
                <input type="text" name="title" value="{{ old('title') }}" required>
            </div>

            <br>

            <div>
                <label>Status:</label>
                <select name="status" required>
                    <option value="pending" {{ old('status', 'pending') === 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="done" {{ old('status') === 'done' ? 'selected' : '' }}>
                        Done
                    </option>
                </select>
            </div>

            <br>

            <div>
                <label>Task Date:</label>
                <input type="date" name="task_date" value="{{ old('task_date') }}" required>
            </div>

            <br>

            <button type="submit">Save Task</button>
        </form>

        <p>
            <a href="{{ route('tasks') }}">Back to Task List</a>
        </p>
    </div>
@endsection