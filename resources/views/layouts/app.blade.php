<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Madame Djeli Cafe & Flores' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Toast animation */
        .toast-fade {
            animation: fadeIn 0.5s ease-out forwards;
        }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-[#faf6ef] text-gray-900 font-sans">

    {{-- Toast --}}
    @if(session('success'))
        <div class="fixed top-5 right-5 bg-green-500 text-white px-6 py-4 rounded-xl shadow-xl z-50 toast-fade">
            {{ session('success') }}
        </div>
    @endif

    {{-- NAVBAR --}}
    @include('layouts.navbar')

    {{-- CONTENT --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('layouts.footer')

</body>
</html>
