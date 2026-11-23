@extends('layouts.app')

@section('title', 'Login | POS System')

@section('content')
    <div class="container">
        <div class="login-container">

            <h1>POS System Login</h1>

            @if ($errors->any())
                <ul style="color:red;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            @if (session('success'))
                <p style="color:green;">
                    {{ session('success') }}
                </p>
            @endif

            <form action="{{ route('login.submit') }}" method="POST">
                @csrf

                <label>Username:</label>
                <input type="text" name="username" value="{{old('username')}}" required>

                <label>Password:</label>
                <input type="password" name="password" required>

                <button class="custom-btn btn-view" type="submit">Login</button>
            </form>

            <p>
                <a class="custom-btn btn-delete" href="{{ route('home') }}">Back to Welcome</a>
            </p>
            
        </div>
    </div>
@endsection