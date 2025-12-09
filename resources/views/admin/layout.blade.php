<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background: #eef1ff;
            font-family: 'Poppins', sans-serif;
        }

        .sidebar {
            width: 220px;
            background: #fff;
            padding: 20px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        .sidebar h2 {
            font-size: 20px;
            margin-bottom: 20px;
            color: #333;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar li {
            margin-bottom: 10px;
        }

        .sidebar a {
            display: block;
            padding: 10px 15px;
            color: #666;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .sidebar a:hover {
            background: rgba(0,123,255,0.1);
            color: #007bff;
        }

        .sidebar a.active {
            background: #007bff;
            color: white;
        }

        .main-content {
            margin-left: 240px;
            padding: 20px;
        }
    </style>
</head>

<body>
    @include('admin.layouts.sidebar')

    <div class="main-content">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
