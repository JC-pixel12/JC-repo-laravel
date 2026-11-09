<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') | Tasks for Today</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #404c5e;
            margin: 0;
            color: #333;
        }

        nav {
            background: #0b1420;
            padding: 18px 8%;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-right: 25px;
            font-weight: bold;
        }

        nav a:hover {
            color: #80cbc4;
        }

        .container {
            max-width: 1000px;
            margin: 35px auto;
            padding: 25px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        h1 {
            color: #243447;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #243447;
            color: white;
        }

        .pending {
            color: #d97706;
            font-weight: bold;
        }

        .completed {
            color: #16a34a;
            font-weight: bold;
        }

        .empty {
            color: #777;
            padding: 20px;
            text-align: center;
        }

        footer {
            text-align: center;
            padding: 20px;
            color: #cfd4fa;
        }
    </style>
</head>

<body>

    <nav>
        <a href="{{ route('welcome') }}">Welcome</a>
        <a href="{{ route('tasks') }}">Task List</a>
        <a href="{{ route('profile') }}">Profile</a>
        <a href="{{ route('about') }}">About</a>
    </nav>

    <main class="container">
        @yield('content')
    </main>

    <footer>
        Tasks for Today Management System &copy; {{ date('Y') }}
    </footer>

</body>
</html>