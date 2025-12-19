<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Madame Djeli'))</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('description', 'Madame Djeli - Premium Caffe & Florest experience with curated coffee and floral artistry')">
    <meta name="keywords" content="coffee, floral, cafe, restaurant, Madame Djeli, Bandung">

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('title', 'Madame Djeli - Caffe & Florest')">
    <meta property="og:description" content="@yield('description', 'Premium caffe and florest experience')">
    <meta property="og:image" content="@yield('og_image', asset('images/logo-djeli.png'))">
    <meta property="og:url" content="{{ url()->current() }}">

    <!-- Additional SEO Meta Tags -->
    <meta name="author" content="Madame Djeli">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Madame Djeli - Caffe & Florest')">
    <meta name="twitter:description" content="@yield('description', 'Premium caffe and florest experience')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/logo-djeli.png'))">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }
        .font-serif {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>
<body class="font-sans antialiased bg-[#F6F1EA] text-[#402A1E]">
    @include('layouts.navbar')

    <!-- Page Content -->
    <main class="relative">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#402A1E] text-white py-12 mt-24">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand -->
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3 mb-4">
                        <img src="/images/logo-djeli.png" alt="Madame Djeli" class="h-8">
                        <span class="font-serif text-xl text-white">Madame Djeli</span>
                    </div>
                    <p class="text-[#BFA58A] mb-4 leading-relaxed">
                        Where the aroma of curated coffee blends with the elegance of handcrafted floral art.
                        A premium space designed for comfort, beauty, and unforgettable taste.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-[#BFA58A] hover:text-white transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-[#BFA58A] hover:text-white transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-[#BFA58A] hover:text-white transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="font-serif text-lg mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-[#BFA58A]">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a></li>
                        <li><a href="{{ route('menu') }}" class="hover:text-white transition-colors">Menu</a></li>
                        <li><a href="{{ route('florist') }}" class="hover:text-white transition-colors">Florist</a></li>
                        <li><a href="{{ route('reservation') }}" class="hover:text-white transition-colors">Reservation</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">About</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="font-serif text-lg mb-4">Contact</h3>
                    <ul class="space-y-2 text-[#BFA58A]">
                        <li>Jl. Melati Indah No. 21</li>
                        <li>Bandung, Jawa Barat</li>
                        <li>Indonesia</li>
                        <li class="mt-4">
                            <a href="tel:+62211234567" class="hover:text-white transition-colors">
                                +62 21 1234 567
                            </a>
                        </li>
                        <li>
                            <a href="mailto:info@madamedjeli.com" class="hover:text-white transition-colors">
                                info@madamedjeli.com
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-[#BFA58A]/20 mt-8 pt-8 text-center text-[#BFA58A]">
                <p>&copy; {{ date('Y') }} Madame Djeli. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
