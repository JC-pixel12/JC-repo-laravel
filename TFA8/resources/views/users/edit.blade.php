@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <h1>Edit User Account</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('users.update', $user->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <lable>Username:</lable>
            <input type="text" name="username" value="{{old('username', $user->username)}}" required>
        </div>

        <br>

        <div>
            <lable>Full Name:</lable>
            <input type="text" name="full_name" value="{{old('full_name', $user->full_name)}}" required>
        </div>

        <br>

        <div>
            <label>Current Profile Picture:</label>
            <br>

            <img src="{{ $user->avatar
                    ? asset('uploads/avatars/' . $user->avatar)
                    : asset('images/avatar-placeholder.png') }}" 
                alt="User Avatar"
                width="150"
                height="150"
                style="object-fit: cover; border-radius: 50%;">
        </div>

        <br>

        <div>
            <label>Upload New Profile Picture:</label>
            <input type="file" name="avatar" accept=".jpg,.jpeg,.png,image/jpeg,image/png">
            <small>JPG or PNG only. Maximum size: 2MB.</small>
        </div>

        <br>

        <button type="submit">Save User</button>
        <a href="{{route('users.index')}}">Cancel</a>
    </form>
@endsection