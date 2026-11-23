@extends('layouts.app')

@section('title', 'Staff Details | POS System')

@section('content')
    <h1>Staff Details</h1>

    @if($user->avatar)
        <img src="{{ asset('uploads/avatars/' . $user->avatar) }}"
            width="200" height="200" style="object-fit:cover">
    @else
        <img src="{{ asset('images/avatar-placeholder.png') }}"
            width="200" height="200">
    @endif

    <p><strong>Username:</strong> {{ $user->username }}</p>
    <p><strong>Full Name:</strong> {{ $user->full_name }}</p>

    <a class="custom-btn btn-edit" href="{{ route('users.edit', $user->id) }}">Edit</a>
    <a class="custom-btn btn-delete" href="{{ route('users.index') }}">Back</a>  
@endsection