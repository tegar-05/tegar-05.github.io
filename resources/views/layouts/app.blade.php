<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Dynamic Meta Tags --}}
    <title>{{ $seo['title'] ?? \App\Helpers\SeoHelper::getTitle() }}</title>
    <meta name="description" content="{{ $seo['description'] ?? \App\Helpers\SeoHelper::getDescription() }}">
    <meta name="keywords" content="{{ $seo['keywords'] ?? \App\Helpers\SeoHelper::getKeywords() }}">

    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ $seo['canonical'] ?? \App\Helpers\SeoHelper::getCanonicalUrl() }}">

    {{-- Open Graph --}}
    @php
        $og = $seo['og'] ?? \App\Helpers\SeoHelper::getOpenGraph();
    @endphp
    <meta property="og:title" content="{{ $og['og:title'] }}">
    <meta property="og:description" content="{{ $og['og:description'] }}">
    <meta property="og:image" content="{{ $og['og:image'] }}">
    <meta property="og:url" content="{{ $og['og:url'] }}">
    <meta property="og:type" content="{{ $og['og:type'] }}">
    <meta property="og:site_name" content="{{ $og['og:site_name'] }}">

    {{-- Twitter Card --}}
    @php
        $twitter = $seo['twitter'] ?? \App\Helpers\SeoHelper::getTwitterCard();
    @endphp
    <meta name="twitter:card" content="{{ $twitter['twitter:card'] }}">
    <meta name="twitter:title" content="{{ $twitter['twitter:title'] }}">
    <meta name="twitter:description" content="{{ $twitter['twitter:description'] }}">
    <meta name="twitter:image" content="{{ $twitter['twitter:image'] }}">
    <meta name="twitter:site" content="{{ $twitter['twitter:site'] }}">

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    {{-- Hreflang --}}
    <link rel="alternate" hreflang="id" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="en" href="{{ url()->current() }}?lang=en">

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

    {{-- Schema.org JSON-LD --}}
    @php
        $schemas = $seo['schemas'] ?? [];
        if (!isset($schemas['organization'])) {
            $schemas['organization'] = \App\Helpers\SeoHelper::getOrganizationSchema();
        }
        if (!isset($schemas['website'])) {
            $schemas['website'] = \App\Helpers\SeoHelper::getWebsiteSchema();
        }
    @endphp
    @foreach($schemas as $schema)
        <script type="application/ld+json">
            {{ json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) }}
        </script>
    @endforeach
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
