<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'POS System')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f6f9;
            color: #222;
        }

        nav {
            background: #1e293b;
            padding: 18px 30px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-right: 24px;
            font-weight: bold;
        }

        nav a:hover {
            color: #93c5fd;
        }

        main {
            max-width: 1000px;
            margin: 30px auto;
            padding: 25px;
            background: white;
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #e2e8f0;
        }

        footer {
            text-align: center;
            padding: 20px;
            color: #64748b;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .login-container {
            background: white;
            width: 350px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(51, 13, 86, 0.67);
            
        }

        .login-container h1 {
            text-align: center;
            color: #1e293b;
        }

        .login-container label {
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
        }

        .login-container input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        .login-container button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background: #1e293b;
            color: white;
            border: none;
            cursor: pointer;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
        }

        
        .custom-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 16px;
            font-size: 15px;
            font-weight: 600;
            border-radius: 6px;
            border: 1px solid transparent;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.2s ease, border-color 0.2s ease;
        }

        .btn-view{
            --baseBG: #3498db;
            --baseFont: #ffffff;
            background-color: var(--baseBG);
            color: var(--baseFont);   
        }

        .btn-edit{
            --baseBG: #6290C8;
            --baseFont: #ffffff;
            background-color: var(--baseBG);
            color: var(--baseFont);   
        }

        .btn-delete {
            --baseBG: #CA054D;
            --baseFont: #ffffff;
            background-color: var(--baseBG);
            color: var(--baseFont);
        }

        .btn-nav{
            --baseFont: #ffffff;
            --baseBg: #1e293b;
            background-color: var(--baseBg);
            color: var(--baseFont);
            border: none;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-view:hover, .btn-edit:hover, .btn-delete:hover {
            background-color: color-mix(in srgb, var(--baseBG), black 30%);
            
        }
        
        .btn-nav:hover {
            color: #93c5fd;
        }

    </style>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('about') }}">About</a>

        @auth
            <a href="{{ route('products.index') }}">Products</a>
            <a href="{{ route('customers.index') }}">Customers</a>
            <a href="{{ route('users.index') }}">Staff</a>
            <a href="{{ route('sales.create') }}">Record Sale</a>
            <a href="{{ route('sales.index') }}">Sales History</a>

            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button class="btn-nav" type="submit">Logout</button>
            </form>

        @else
            <a href="{{ route('login') }}" style="color:white;">Login</a>
        @endauth
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        For Schoolwork Basic Point-of-Sale System &copy; 2026
    </footer>
</body>
</html>