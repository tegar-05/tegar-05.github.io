<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Foody' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FFF7F1] text-gray-800">

    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Page Content --}}
    <main class="min-h-screen">
        {{ $slot }}
    </main>

</body>
</html>
