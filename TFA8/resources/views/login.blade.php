@extends('layouts.app')

@section('title', 'Login | POS System')

@section('content')
    <div class="container">
        <div class="login-container">

            <h1>POS System Login</h1>

            @if (session('success'))
                <p class="success">{{ session('success') }}</p>
            @endif

            @if (session('error'))
                <p class="error">{{ session('error') }}</p>
            @endif

            @if ($errors->any())
                <div class="error">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('login.submit') }}" method="POST">
                @csrf

                <label>Username:</label>
                <input type="text" name="username" value="{{old('username')}}" requiredautofocus>

                <label>Password:</label>
                <input type="password" name="password" required>

                <button type="submit">Login</button>
            </form>

        </div>
    </div>
@endsection