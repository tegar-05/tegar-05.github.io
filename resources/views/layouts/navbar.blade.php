<nav
    x-data="{ scrolled: false, mobileMenuOpen: false }"
    x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 10 })"
    :class="scrolled
        ? 'backdrop-blur-xl bg-white/80 shadow-lg h-16'
        : 'backdrop-blur-xl bg-white/60 h-20'"
    class="fixed top-0 left-0 w-full z-50 border-b border-[#d9c48c]/40 transition-all duration-500 ease-[cubic-bezier(.4,0,.2,1)] animate-fadeDown"
>
    <div class="max-w-7xl mx-auto px-6 h-full flex items-center justify-between">

        <!-- Logo -->
        <a href="/" class="flex items-center gap-3 group">
            <img src="/images/logo-djeli.png" alt="Madame Djeli" class="h-8 md:h-10 transition duration-500 group-hover:scale-[1.05]">

            <span class="font-serif text-xl md:text-2xl text-[#0c4740] tracking-wide group-hover:text-[#b59a54] transition duration-500">
                Madame Djeli
                <span class="block -mt-2 text-[8px] md:text-[10px] uppercase tracking-[3px] text-[#b59a54]">
                    Caffe & Florest
                </span>
            </span>
        </a>

        <!-- Desktop Menu -->
        <ul class="hidden md:flex items-center gap-10 font-serif text-[17px] text-[#0c4740]">
            @foreach (['Home'=>'/', 'Menu'=>'/menu', 'Florist'=>'/florist', 'Reservation'=>'/reservation', 'About'=>'/about'] as $name => $url)
                <li>
                    <a href="{{ $url }}"
                       class="relative hover:text-[#b59a54] transition duration-300
                       after:absolute after:left-0 after:-bottom-1 after:w-0 after:h-[2px] after:bg-[#b59a54]
                       hover:after:w-full after:transition-all after:duration-500 after:ease-out
                       hover:after:shadow-[0_0_6px_#b59a54]"
                    >
                        {{ $name }}
                    </a>
                </li>
            @endforeach
        </ul>

        <!-- Icons and Mobile Menu Button -->
        <div class="flex items-center gap-5">
            <button class="text-[#0c4740] hover:text-[#b59a54] transition duration-300 min-h-[44px] min-w-[44px] flex items-center justify-center">
                <i class="fa-solid fa-magnifying-glass text-xl"></i>
            </button>
            <button class="text-[#0c4740] hover:text-[#b59a54] transition duration-300 relative min-h-[44px] min-w-[44px] flex items-center justify-center">
                <i class="fa-regular fa-heart text-xl"></i>
            </button>
            <a href="/reservation"
               class="hidden md:block bg-[#0c4740] text-white px-8 py-4 rounded-full text-sm font-serif border border-[#b59a54]/40
               hover:bg-[#145c53] hover:shadow-[0_0_8px_#b59a54] transition-all duration-500 min-h-[44px] flex items-center">
                Book Table
            </a>
            <!-- Hamburger Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-[#0c4740] hover:text-[#b59a54] transition duration-300 min-h-[44px] min-w-[44px] flex items-center justify-center">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform -translate-y-2" class="bg-white/95 backdrop-blur-xl border-t border-[#d9c48c]/40">
        <ul class="flex flex-col items-center gap-6 py-6 font-serif text-lg text-[#0c4740]">
            @foreach (['Home'=>'/', 'Menu'=>'/menu', 'Florist'=>'/florist', 'Reservation'=>'/reservation', 'About'=>'/about'] as $name => $url)
                <li>
                    <a href="{{ $url }}" @click="mobileMenuOpen = false" class="hover:text-[#b59a54] transition duration-300 min-h-[44px] flex items-center">
                        {{ $name }}
                    </a>
                </li>
            @endforeach
            <li>
                <a href="/reservation" @click="mobileMenuOpen = false" class="bg-[#0c4740] text-white px-6 py-3 rounded-full text-sm font-serif border border-[#b59a54]/40 hover:bg-[#145c53] hover:shadow-[0_0_8px_#b59a54] transition-all duration-500 min-h-[44px] flex items-center">
                    Book Table
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- Tailwind Motion Animations -->
<style>
@keyframes fadeDown {
    0% { opacity: 0; transform: translateY(-20px); }
    100% { opacity: 1; transform: translateY(0); }
}
.animate-fadeDown {
    animation: fadeDown 1s ease forwards;
}
</style>
