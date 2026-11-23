@extends('layouts.app')

@section('title', 'Add New User | POS System')

@section('content')
    <h1>Add New Staff Account</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <lable>Username:</lable>
            <input type="text" name="username" value="{{old('username')}}" required>
        </div>

        <br>

        <div>
            <lable>Full Name:</lable>
            <input type="text" name="full_name" value="{{old('full_name')}}" required>
        </div>

        <br>

        <div>
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>

        <br>

        <div>
            <label>Confirm Password:</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <br>

        <div>
            <label>Avatar:</label>
            <input type="file" name="avatar" accept="image/png,image/jpeg">
        </div>

        <br>

        <button class="custom-btn btn-view" type="submit">Save User</button>
        <a class="custom-btn btn-delete" href="{{route('users.index')}}">Cancel</a>
    </form>
@endsection