@extends('layouts.app')

@section('title', 'Welcome')

@section('content')

<div class="card">
    <h1>Welcome to Tasks for Today!</h1>

    <p>Here are your scheduled tasks for today.</p>

    <h3>Today's Date: {{ date('F d, Y') }}</h3>

</div>

<div class="card">
    <h2>Today's Tasks</h2>

    @if($tasks->count() > 0)

        <table>
            <thead>
                <tr>
                    <th>Task Title</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>

                        <td class="{{ $task->status }}">
                            {{ ucfirst($task->status) }}
                        </td>

                        <td>
                            {{ $task->task_date->format('F d, Y') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @else

        <p class="empty">No tasks scheduled for today.</p>

    @endif

</div>

@endsection