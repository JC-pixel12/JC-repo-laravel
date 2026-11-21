@extends('layouts.app')

@section('title', 'Profile')

@section('content')

<div class="card">
    <h1>User Profile</h1>

    @if($user)
        <h3>{{$user->full_name}}</h3>

        <p>
            <strong>Username:</strong>
            {{$user->username}}
        </p>

        <p>
            <strong>Full Name:</strong>
            {{$user->full_name}}
        </p>

        <p>
            <strong>Email Address:</strong>
            {{$user->email}}
        </p>

        <p>
            <strong>Account Created:</strong>
            {{\Carbon\Carbon::parse($user->created_at)->format('F d, Y')}}
        </p>

    @else

        <p>No user found.</p>

    @endif
</div>

@endsection