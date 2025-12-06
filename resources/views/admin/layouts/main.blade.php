<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #eceff1;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .sidebar {
            width: 220px;
            height: 100vh;
            background: rgba(255,255,255,0.35);
            backdrop-filter: blur(10px);
            border-right: 1px solid rgba(255,255,255,0.2);
            padding: 25px;
            box-shadow: 3px 0 15px rgba(0,0,0,0.1);
        }

        .sidebar h2 {
            font-size: 20px;
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            padding: 10px 12px;
            text-decoration: none;
            color: #333;
            border-radius: 10px;
            margin-bottom: 10px;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,0.6);
        }

        .content {
            flex: 1;
            padding: 30px;
        }

        .glass-card {
            background: rgba(255,255,255,0.25);
            border-radius: 20px;
            padding: 25px;
            backdrop-filter: blur(12px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
            border: 1px solid rgba(255,255,255,0.3);
            width: 30%;
            min-height: 150px;
        }

        .card-row {
            display: flex;
            gap: 25px;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Admin Menu</h2>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.orders.index') }}">Orders</a>
        <a href="{{ route('admin.menu.index') }}">Menu</a>
    </div>

    <div class="content">
        @yield('content')
    </div>

</body>
</html>
