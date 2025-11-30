<nav id="navbar"
     class="fixed top-0 left-0 w-full z-50 flex items-center justify-between px-6 py-4 transition-all duration-500 backdrop-blur-xl bg-black/20 border-b border-white/10 shadow-[0_5px_30px_rgba(0,0,0,0.25)]">

    <!-- Logo -->
    <a href="/" @click="fade = true" class="flex items-center gap-3 group">
        <img src="/img/logo.png" class="h-10 drop-shadow-lg" alt="Madame Djeli Logo">
        <span class="text-white font-semibold text-xl tracking-wider transition group-hover:text-gold">
            Madame Djeli
        </span>
    </a>

    <!-- Desktop Menu -->
    <ul class="hidden md:flex items-center gap-10 text-white text-sm font-medium">

        <li>
            <a href="/" @click="fade = true"
               class="nav-link {{ request()->is('/') ? 'text-gold' : '' }}">
                Home
            </a>
        </li>

        <li>
            <a href="/menu" @click="fade = true"
               class="nav-link {{ request()->is('menu') ? 'text-gold' : '' }}">
                Menu
            </a>
        </li>

        <li>
            <a href="/about" @click="fade = true"
               class="nav-link {{ request()->is('about') ? 'text-gold' : '' }}">
                About
            </a>
        </li>

        <li>
            <a href="/contact" @click="fade = true"
               class="nav-link {{ request()->is('contact') ? 'text-gold' : '' }}">
                Contact
            </a>
        </li>

    </ul>

    <!-- Mobile Button -->
    <button id="mobileBtn"
            class="md:hidden text-white text-3xl transition hover:text-gold">
        ☰
    </button>
</nav>

<!-- Mobile Menu -->
<div id="mobileMenu"
     class="hidden md:hidden fixed top-[70px] left-0 w-full bg-black/90 backdrop-blur-xl text-white py-6 text-center space-y-4 shadow-lg border-t border-white/10 transition-all duration-500">

    <a href="/" @click="fade = true" class="mobile-link">Home</a>
    <a href="/menu" @click="fade = true" class="mobile-link">Menu</a>
    <a href="/about" @click="fade = true" class="mobile-link">About</a>
    <a href="/contact" @click="fade = true" class="mobile-link">Contact</a>

</div>

<style>
    .nav-link {
        position: relative;
        transition: 0.3s;
    }
    .nav-link:hover {
        color: #d5a556;
    }
    .nav-link::after {
        content: "";
        position: absolute;
        width: 0;
        height: 2px;
        left: 0;
        bottom: -4px;
        background: #d5a556;
        transition: 0.3s;
    }
    .nav-link:hover::after {
        width: 100%;
    }

    /* mobile link effect */
    .mobile-link {
        display: block;
        font-size: 1.1rem;
        padding: 8px 0;
        transition: 0.3s;
    }
    .mobile-link:hover {
        color: #d5a556;
        transform: translateY(-3px);
    }
</style>
