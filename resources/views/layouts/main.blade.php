<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Admin - {{ $title ?? 'Dashboard' }}</title>

  {{-- Vite / Tailwind --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <style>
    /* small helpers for glass look (can move to CSS file) */
    .glass {
      background: rgba(255,255,255,0.06);
      backdrop-filter: blur(10px) saturate(120%);
      -webkit-backdrop-filter: blur(10px) saturate(120%);
      border: 1px solid rgba(255,255,255,0.08);
    }
    .card-glass {
      background: linear-gradient(180deg, rgba(255,255,255,0.04), rgba(255,255,255,0.02));
      border-radius: 14px;
      border: 1px solid rgba(255,255,255,0.06);
      box-shadow: 0 10px 30px rgba(16,24,40,0.06);
    }
  </style>
</head>
<body class="bg-[#F7F5F3] text-[#2b2b2b]">

  <div class="min-h-screen flex">

    {{-- SIDEBAR --}}
    <aside class="w-20 md:w-72 bg-transparent glass p-4 flex flex-col gap-6">
      <div class="flex items-center gap-3 px-2">
        <div class="w-10 h-10 rounded-full bg-[url('/images/logo.png')] bg-cover bg-center"></div>
        <div class="hidden md:block">
          <h1 class="text-lg font-[PlayfairDisplay]">Madame Djeli</h1>
          <p class="text-xs text-[#7a6f6e]">Admin Panel</p>
        </div>
      </div>

      <nav class="flex-1">
        <ul class="space-y-1">
          <li><a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/5 transition">
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"><path d="M3 13h8V3H3v10zM3 21h8v-6H3v6zM13 21h8V11h-8v10zM13 3v6h8V3h-8z" fill="#7a6f6e"/></svg>
            <span class="hidden md:inline text-[#3A2A29]">Dashboard</span></a></li>

          <li><a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/5 transition">
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"><path d="M3 6h18" stroke="#7a6f6e" stroke-width="2"/></svg>
            <span class="hidden md:inline text-[#3A2A29]">Orders</span></a></li>

          <li><a href="{{ route('admin.menu.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/5 transition">
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"><path d="M4 6h16M4 12h16M4 18h16" stroke="#7a6f6e" stroke-width="2"/></svg>
            <span class="hidden md:inline text-[#3A2A29]">Menu</span></a></li>

          <li><a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/5 transition">
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"><path d="M12 8v8M8 12h8" stroke="#7a6f6e" stroke-width="2"/></svg>
            <span class="hidden md:inline text-[#3A2A29]">Reports</span></a></li>
        </ul>
      </nav>

      <div class="mt-auto hidden md:block">
        <form action="{{ route('admin.logout') }}" method="GET">
          <button class="w-full py-2 rounded-lg bg-[#D4A373] text-white font-semibold">Logout</button>
        </form>
      </div>
    </aside>

    {{-- MAIN --}}
    <div class="flex-1 p-6">
      {{-- Topbar --}}
      <div class="flex items-center justify-between mb-6">
        <div>
          <h2 class="text-2xl font-semibold text-[#3A2A29]">{{ $pageTitle ?? 'Dashboard Admin' }}</h2>
          <p class="text-sm text-[#7a6f6e]">Ringkasan singkat operasional hari ini</p>
        </div>

        <div class="flex items-center gap-4">
          <div class="hidden md:flex items-center gap-3">
            <input type="text" placeholder="Search..." class="px-3 py-2 rounded-full border border-[#eee]">
          </div>
          <div class="w-10 h-10 rounded-full bg-[url('/images/admin-avatar.jpg')] bg-cover bg-center"></div>
        </div>
      </div>

      {{-- Content area --}}
      <div>
        @yield('admin-content')
      </div>

    </div>
  </div>

</body>
</html>
