@extends('layouts.app')

@section('title', 'User Accounts | POS System')

@section('content')
    <h1>User Accounts</h1>

    @if (session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    <a href="{{ route('users.create') }}">
        + Add New User
    </a>

    <p>List of staff members registered in the POS system.</p>

    <table>
        <thead>
            <tr>
                <th>Avatar</th>
                <th>ID</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>
                        <img
                            src="{{ $user->avatar
                                ? asset('uploads/avatars/' . $user->avatar)
                                : asset('images/avatar-placeholder.png') }}"
                            alt="{{ $user->full_name }} Avatar"
                            width="60"
                            height="60"
                            style="object-fit: cover; border-radius: 50%;">
                    </td>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->full_name }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}">
                            Edit
                        </a>
                    </td>
                </tr>
            
            @empty
                <tr>
                    <td colspan="5">No users found</td>
                </tr>

            @endforelse
        </tbody>
    </table>
@endsection