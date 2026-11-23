@extends('layouts.app')

@section('title', 'User Accounts | POS System')

@section('content')
    <h1>Staff Accounts</h1>

    @if (session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    @if(session('error'))
        <p style="color:red">{{ session('error') }}</p>
    @endif


    <a class="custom-btn btn-view" href="{{ route('users.create') }}">+ Add New User</a>

    <p>List of staff members registered in the POS system.</p>

    <table>
        <thead>
            <tr>
                <th>Avatar</th>
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
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->full_name }}</td>
                    
                    <td>
                        <a class="custom-btn btn-view" href="{{ route('users.show', $user->id) }}">View</a>
                        <a class="custom-btn btn-edit" href="{{ route('users.edit', $user->id) }}">Edit</a>

                        <form action="{{ route('users.destroy', $user->id) }}"method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')

                            <button class="custom-btn btn-delete" type="submit" onclick="return confirm('Delete this staff member?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            
            @empty
                <tr>
                    <td colspan="4">No users found</td>
                </tr>

            @endforelse
        </tbody>
    </table>
@endsection