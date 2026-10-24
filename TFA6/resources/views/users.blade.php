@extends('layouts.app')

@section('title', 'User Accounts | POS System')

@section('content')
    <h1>User Accounts</h1>

    <p>List of staff members registered in the POS system.</p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Full Name</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->full_name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection