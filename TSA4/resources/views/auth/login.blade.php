@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="card">
        <h1>Login</h1>

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

            <div>
                <label>Username:</label>
                <input type="text" name="username" value="{{ old('username') }}" required>
            </div>

            <br>

            <div>
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>

            <br>

            <button type="submit">Login</button>
        </form>

        <p>
            <a href="{{ route('welcome') }}">Back to Welcome</a>
        </p>
    </div>
@endsection