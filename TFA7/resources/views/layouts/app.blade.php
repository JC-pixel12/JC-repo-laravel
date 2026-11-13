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
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('about') }}">About</a>
        <a href="{{ route('customers.index') }}">Customer Accounts</a>
        <a href="{{ route('users.index') }}">User Accounts</a>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        For Schoolwork Basic Point-of-Sale System &copy; 2026
    </footer>
</body>
</html>