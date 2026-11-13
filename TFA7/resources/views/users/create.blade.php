@extends('layouts.app')

@section('title', 'Add New User')

@section('content')
    <h1>Add New User</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('users.store')}}" method="POST">
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

        <button type="submit">Save User</button>
        <a href="{{route('users.index')}}">Cancel</a>
    </form>
@endsection