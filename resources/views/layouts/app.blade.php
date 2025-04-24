<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Z CLOTH Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f5f7fa;
        }
        .sidebar {
            height: 100vh;
            background-color: #1b3e6f;
            color: white;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            padding: 10px 20px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #335d9d;
            text-decoration: none;
        }
        .content {
            padding: 20px;
        }
        .header {
            background-color: #004080;
            color: white;
            padding: 15px 20px;
        }
    </style>
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center">Z CLOTH</h4>
        <a href="{{ url('/dashboard') }}">Dashboard</a>
        <a href="{{ url('/orders') }}">Order</a>
        <a href="{{ url('/payments') }}">Payment</a>
    </div>

    <!-- Main content -->
    <div class="flex-grow-1">
        <div class="header">
            <h5>Admin Panel</h5>
        </div>
        <div class="content">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
