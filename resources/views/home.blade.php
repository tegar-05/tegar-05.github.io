@extends('layouts.app')

@section('content')

{{-- ============================
     HERO SECTION PREMIUM
============================= --}}
<section class="relative w-full min-h-[90vh] flex items-center justify-center overflow-hidden">

    <!-- Hero Background Image -->
    <div class="absolute inset-0">
        <img src="/images/interior/interior-hero.jpg" alt="Madame Djeli Interior"
             class="w-full h-full object-cover parallax-bg" loading="lazy">
    </div>

    <!-- Warm Color Overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-[#BFA58A]/80 via-[#D98C8C]/60 to-[#7AA374]/80"></div>

    <!-- Floral Shadow Decoration -->
    <div class="absolute top-0 right-0 w-[380px] opacity-40 blur-sm animate-float-slow">
        <img src="/images/hero-brush.jpeg" alt="" loading="lazy">
    </div>

    <div class="absolute bottom-0 left-0 w-[300px] opacity-40 blur-sm animate-float-medium">
        <img src="/images/floral/floral-decor2.png" alt="" loading="lazy">
    </div>

    <!-- Content -->
    <div class="relative text-center px-6 max-w-4xl animate-fadein-slow">

        <h1 class="text-5xl md:text-7xl font-[PlayfairDisplay] font-bold text-white leading-tight drop-shadow-lg">
            Welcome to<br>
            <span class="text-[#F6F1EA]">Madame Djeli</span><br>
            <span class="text-[#D98C8C]">Caffe & Florest</span>
        </h1>

        <p class="mt-6 text-xl text-[#F6F1EA] opacity-90 font-light tracking-wide max-w-2xl mx-auto">
            Where the aroma of curated coffee blends with the elegance of handcrafted floral art.
            A premium space designed for comfort, beauty, and unforgettable taste.
        </p>

        <!-- CTA Buttons -->
        <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="{{ route('reservation') }}"
               class="px-8 py-4 bg-[#7AA374] text-white rounded-full text-lg shadow-lg
                      hover:bg-[#D98C8C] transition-all duration-300 hover:scale-105
                      tracking-wide font-semibold focus:ring-2 focus:ring-[#7AA374] focus:ring-offset-2"
               aria-label="Reserve a table at Madame Djeli">
                Reserve Now
            </a>
            <a href="{{ route('menu') }}"
               class="px-8 py-4 bg-transparent border-2 border-[#F6F1EA] text-[#F6F1EA] rounded-full text-lg
                      hover:bg-[#F6F1EA] hover:text-[#402A1E] transition-all duration-300 hover:scale-105
                      tracking-wide font-semibold focus:ring-2 focus:ring-[#F6F1EA] focus:ring-offset-2"
               aria-label="View our menu">
                See Menu
            </a>
        </div>

    </div>

</section>

<!-- Hero Parallax Script -->
<script>
document.addEventListener("DOMContentLoaded", () => {
    const parallaxBg = document.querySelector('.parallax-bg');
    let lastScrollY = window.scrollY;

    function updateParallax() {
        const scrollY = window.scrollY;
        const speed = 0.5;
        const yPos = -(scrollY * speed);
        parallaxBg.style.transform = `translateY(${yPos}px)`;
        lastScrollY = scrollY;
        requestAnimationFrame(updateParallax);
    }

    updateParallax();
});
</script>

{{-- ============================
     SECTION 2 — Signature & Flores Highlights
=============================== --}}
<section class="py-28 bg-[#F6F1EA] relative overflow-hidden">

    {{-- Soft floral shadows --}}
    <img src="/images/floral/floral-soft1.png"
         class="absolute top-0 left-0 w-72 opacity-[12%] blur-sm pointer-events-none">
    <img src="/images/floral/floral-soft2.png"
         class="absolute bottom-0 right-0 w-80 opacity-[12%] blur-sm pointer-events-none">

    <div class="max-w-7xl mx-auto px-6 relative">

        {{-- TITLE --}}
        <div class="text-center mb-20">
            <h2 class="text-5xl md:text-6xl font-[PlayfairDisplay] font-semibold text-[#402A1E] drop-shadow-sm">
                Signature & Flores Collection
            </h2>
            <p class="mt-4 text-[#7AA374] text-lg tracking-wide">
                Our most beloved creations • Premium quality • Handcrafted excellence
            </p>

            <div class="mt-6 w-24 h-[3px] bg-gradient-to-r from-[#BFA58A] to-[#D98C8C] mx-auto rounded-full"></div>
        </div>

        {{-- Signature & Flores Products --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($signatureProducts as $product)
                <div class="group relative bg-white rounded-3xl overflow-hidden shadow-lg
                            hover:shadow-2xl hover:-translate-y-2 transition-all duration-700
                            focus-within:ring-2 focus-within:ring-[#7AA374] focus-within:ring-offset-2 rounded-3xl">

                    {{-- Image --}}
                    <div class="overflow-hidden relative">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/placeholder.jpg') }}"
                             alt="{{ $product->name }} - {{ $product->is_signature ? 'Signature' : 'Flores' }} product at Madame Djeli"
                             class="w-full h-80 object-cover rounded-b-none
                                    group-hover:scale-110 transition duration-[1200ms] ease-out" loading="lazy">

                        {{-- Soft gradient overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0
                                    group-hover:opacity-60 transition duration-700"></div>

                        {{-- Badge --}}
                        <div class="absolute top-4 left-4">
                            @if($product->is_signature)
                                <span class="bg-[#D98C8C] text-white px-3 py-1 rounded-full text-xs font-semibold">Signature</span>
                            @elseif($product->is_flores)
                                <span class="bg-[#D98C8C] text-white px-3 py-1 rounded-full text-xs font-semibold">Flores</span>
                            @endif
                        </div>
                    </div>

                    {{-- Text --}}
                    <div class="p-7">
                        <h3 class="text-2xl font-[PlayfairDisplay] text-[#402A1E]">
                            {{ $product->name }}
                        </h3>
                        <p class="text-[#7AA374] font-semibold text-lg mt-2">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                        @if($product->description)
                            <p class="text-[#402A1E] text-sm mt-3 leading-relaxed line-clamp-2">
                                {{ $product->description }}
                            </p>
                        @endif
                        <a href="{{ route('menu') }}?category={{ $product->category }}"
                           class="inline-block mt-4 px-6 py-2 bg-[#7AA374] text-white rounded-full text-sm font-semibold
                                  hover:bg-[#D98C8C] hover:scale-105 transition-all duration-300
                                  focus:ring-2 focus:ring-[#7AA374] focus:ring-offset-2"
                           aria-label="View details for {{ $product->name }}">
                            View Details
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-[#402A1E] text-lg">Signature and Flores products coming soon...</p>
                </div>
            @endforelse
        </div>

        {{-- CTA Button --}}
        <div class="text-center mt-16">
            <a href="{{ route('menu') }}"
               class="px-10 py-4 bg-[#7AA374] text-white rounded-full text-lg shadow-lg
                      hover:bg-[#D98C8C] transition-all duration-300 hover:scale-105
                      font-semibold">
                Explore Full Menu
            </a>
        </div>

    </div>
</section>
{{-- ============================
     SECTION 3 — CINEMATIC VIDEO + PLAY BUTTON
============================= --}}
<section class="py-24 bg-[#FBF7F4] relative overflow-hidden">

    <!-- Soft Floral Decoration -->
    <div class="absolute top-10 left-0 w-[260px] opacity-30 pointer-events-none">
        <img src="/images/floral/floral-soft1.png" alt="">
    </div>

    <div class="absolute bottom-10 right-0 w-[280px] opacity-30 pointer-events-none">
        <img src="/images/floral/floral-soft2.png" alt="">
    </div>

    <div class="relative max-w-6xl mx-auto px-6">

        <!-- Title -->
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-[PlayfairDisplay] text-[#3A2A29] font-bold leading-tight">
                A Cinematic Glimpse of Our Space
            </h2>
            <p class="mt-4 text-[#4A3B3A] text-lg opacity-80">
                Step into a world where modern luxury meets floral artistry.
            </p>
        </div>


        <!-- CINEMATIC VIDEO WRAPPER -->
        <div class="relative mb-20">

            <!-- Video -->
            <video id="caffeVideo"
                   class="w-full h-[380px] md:h-[500px] object-cover rounded-3xl shadow-2xl transition duration-700"
                   poster="/images/interior/interior-cover.jpg">
                <source src="/videos/caffe-tour.mp4" type="video/mp4">
            </video>

            <!-- Cinematic Overlay Before Play -->
            <div id="videoOverlay"
                 class="absolute inset-0 backdrop-blur-md bg-black/40 rounded-3xl flex items-center justify-center
                        transition duration-700">

            <!-- Play Button Premium Gold -->
                <button id="playBtn"
                        class="w-24 h-24 rounded-full bg-white/20 backdrop-blur-xl border border-white/50
                               flex items-center justify-center shadow-2xl hover:scale-110 transition duration-300
                               hover:bg-white/30 focus:ring-2 focus:ring-white focus:ring-offset-2"
                        aria-label="Play promotional video of Madame Djeli cafe">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="#E7C08A"
                         viewBox="0 0 24 24"
                         class="w-12 h-12 drop-shadow-lg"
                         aria-hidden="true">
                        <path d="M8 5v14l11-7z"/>
                    </svg>

                </button>

            </div>
        </div>


        <!-- 3 Grid Interior -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <div class="group relative overflow-hidden rounded-2xl shadow-lg">
                <img src="/images/interior/interior1.jpg"
                     class="w-full h-[320px] object-cover transition duration-700 group-hover:scale-110" loading="lazy">
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-6">
                    <h3 class="text-white text-xl font-[PlayfairDisplay]">
                        Premium Coffee Corner
                    </h3>
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-2xl shadow-lg">
                <img src="/images/interior/interior2.jpg"
                     class="w-full h-[320px] object-cover transition duration-700 group-hover:scale-110" loading="lazy">
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-6">
                    <h3 class="text-white text-xl font-[PlayfairDisplay]">
                        Botanical Aesthetic Room
                    </h3>
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-2xl shadow-lg">
                <img src="/images/interior/interior3.jpg"
                     class="w-full h-[320px] object-cover transition duration-700 group-hover:scale-110" loading="lazy">
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-6">
                    <h3 class="text-white text-xl font-[PlayfairDisplay]">
                        Elegant Florist Gallery
                    </h3>
                </div>
            </div>

        </div>

    </div>
</section>


{{-- Script Play Video --}}
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const video = document.getElementById("caffeVideo");
        const overlay = document.getElementById("videoOverlay");
        const btn = document.getElementById("playBtn");

        btn.addEventListener("click", () => {
            overlay.classList.add("opacity-0", "pointer-events-none");
            video.play();
        });
    });
</script>
{{-- ===========================================
     SECTION 4 — ULTRA PREMIUM FLORIST SHOWCASE
============================================== --}}
<section class="relative py-28 bg-[#FAF7F2] overflow-hidden" id="floral-showcase">

    <!-- Floating Petals / Premium Particle Effect -->
    <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="animate-float-slow absolute w-16 opacity-30 top-10 left-20">
            <img src="/images/floral/petal1.png" alt="">
        </div>
        <div class="animate-float-medium absolute w-20 opacity-25 bottom-10 right-32">
            <img src="/images/floral/petal2.png" alt="">
        </div>
        <div class="animate-float-fast absolute w-14 opacity-40 top-40 right-10">
            <img src="/images/floral/petal3.png" alt="">
        </div>
    </div>


    <div class="relative max-w-7xl mx-auto px-6">

        <!-- Glassmorphism Title Panel -->
        <div class="backdrop-blur-xl bg-white/20 border border-white/30 shadow-xl
                    rounded-3xl py-10 px-10 mx-auto text-center mb-20
                    animate-fade-slide">

            <h2 class="text-5xl font-[PlayfairDisplay] text-[#3A2A29] font-bold drop-shadow-sm">
                Floral Artistry Collection
            </h2>

            <p class="mt-4 text-[#4A3B3A] text-lg opacity-85 max-w-xl mx-auto leading-relaxed">
                Curated floral arrangements crafted with elegance, precision, and a modern romantic touch.
            </p>
        </div>


        <!-- 3D Parallax Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-14 perspective-1000">

            <!-- Item -->
            @foreach([
                ['img'=>'bouquet1.jpg','title'=>'Signature Pink Bouquet'],
                ['img'=>'bouquet2.jpg','title'=>'Cream Rose Harmony'],
                ['img'=>'bouquet3.jpg','title'=>'Blush Seasonal Collection'],
            ] as $flower)

            <div class="group relative rounded-3xl overflow-hidden shadow-2xl
                        transform-gpu transition-all duration-700 hover:rotate-[-2deg] hover:scale-[1.04]
                        parallax-card focus-within:ring-2 focus-within:ring-[#D4A373] focus-within:ring-offset-2">

                <img src="/images/flowers/{{ $flower['img'] }}"
                     alt="{{ $flower['title'] }} - Beautiful floral arrangement at Madame Djeli"
                     class="w-full h-[420px] object-cover transition duration-700
                            group-hover:scale-110 group-hover:brightness-90" loading="lazy">

                <!-- Cinematic Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent
                            opacity-0 group-hover:opacity-100 transition duration-500"></div>

                <!-- Text -->
                <div class="absolute bottom-6 left-6 text-white">
                    <h3 class="text-2xl font-[PlayfairDisplay] font-semibold drop-shadow-xl">
                        {{ $flower['title'] }}
                    </h3>
                </div>
            </div>

            @endforeach

        </div>


        <!-- CTA -->
        <div class="text-center mt-16 animate-fadein-slow">
            <a href="{{ route('florist') }}"
               class="px-12 py-4 bg-[#D4A373] text-white rounded-full text-lg font-semibold shadow-xl
                      hover:bg-[#c08d60] hover:shadow-2xl hover:scale-110 transition-all duration-500">
                Explore Full Florist Collection
            </a>
        </div>

    </div>
</section>


<!-- Custom Animations -->
<style>
    .perspective-1000 { perspective: 1000px; }

    /* Floating petals */
    @keyframes float-slow { 0%{transform:translateY(0)} 100%{transform:translateY(-60px)} }
    @keyframes float-medium { 0%{transform:translateY(0)} 100%{transform:translateY(-80px)} }
    @keyframes float-fast { 0%{transform:translateY(0)} 100%{transform:translateY(-120px)} }
    .animate-float-slow { animation: float-slow 9s linear infinite alternate; }
    .animate-float-medium { animation: float-medium 7s linear infinite alternate; }
    .animate-float-fast { animation: float-fast 5s linear infinite alternate; }

    /* Fade + slide for title panel */
    @keyframes fade-slide {
        0% { opacity: 0; transform: translateY(40px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-slide { animation: fade-slide 1.2s ease-out forwards; }

    @keyframes fadein-slow {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }
    .animate-fadein-slow { animation: fadein-slow 1.8s ease-out; }
</style>
{{-- ===========================================
     SECTION 5 — THE MADAME DJELI EXPERIENCE
============================================== --}}
<section class="relative py-32 bg-[#F3EEE8] overflow-hidden">

    <!-- Floral Soft Shadows -->
    <img src="/images/floral/floral-soft1.png"
         class="absolute top-0 left-0 w-[340px] opacity-25 blur-sm pointer-events-none">
    <img src="/images/floral/floral-soft2.png"
         class="absolute bottom-0 right-0 w-[380px] opacity-25 blur-sm pointer-events-none">

    <!-- Decorative Parallax Background -->
    <div class="absolute inset-0 bg-[url('/images/paper-texture.png')]
                bg-cover bg-center opacity-10"></div>

    <div class="max-w-7xl mx-auto px-8 relative">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">

            <!-- LEFT SIDE: IMAGE WITH PARALLAX -->
            <div class="relative group overflow-hidden rounded-3xl shadow-2xl">

                <img src="/images/about/djeli-experience.jpg"
                     class="w-full h-[480px] object-cover transform transition duration-[1500ms]
                            group-hover:scale-110 parallax-image" loading="lazy">

                <!-- Gold cinematic overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-[#5a4631]/70 to-transparent
                            opacity-0 group-hover:opacity-100 transition duration-700"></div>
            </div>

            <!-- RIGHT SIDE: TEXT -->
            <div class="animate-fadein-slow">
                <h2 class="text-5xl font-[PlayfairDisplay] text-[#3A2A29] font-bold leading-tight mb-6">
                    The Madame Djeli<br>
                    <span class="text-[#D4A373]">Experience</span>
                </h2>

                <p class="text-lg text-[#4A3B3A] leading-relaxed opacity-80 mb-6">
                    Menggabungkan aroma kopi pilihan dengan keindahan seni floral,
                    Madame Djeli menghadirkan sebuah ruang yang memadukan
                    <span class="font-semibold">kehangatan, estetika, dan rasa premium</span>.
                </p>

                <p class="text-lg text-[#4A3B3A] leading-relaxed opacity-80 mb-8">
                    Setiap kunjungan bukan sekadar menikmati hidangan,
                    tetapi sebuah perjalanan merasakan kenyamanan, keindahan,
                    dan kreativitas dalam suasana yang elegan.
                </p>

                <a href="{{ route('about') }}"
                   class="px-10 py-4 bg-[#D4A373] text-white text-lg rounded-full shadow-lg
                          hover:bg-[#c08d60] hover:scale-105 hover:shadow-2xl transition-all duration-500">
                    Learn More About Us
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Parallax Scroll Script -->
<script>
document.addEventListener("mousemove", function(e) {
    const parallax = document.querySelector(".parallax-image");
    if (parallax) {
        let x = (window.innerWidth - e.pageX * 2) / 100;
        let y = (window.innerHeight - e.pageY * 2) / 100;
        parallax.style.transform = `scale(1.15) translate(${x}px, ${y}px)`;
    }
});
</script>
{{-- ============================
     SECTION 6 — RESERVATION PREMIUM
=============================== --}}
<section class="relative py-28 overflow-hidden">

    <!-- Background floral texture -->
    <div class="absolute inset-0 bg-[url('/images/bg-texture-gold.jpg')] bg-cover bg-center opacity-20"></div>

    <!-- Soft gold gradient -->
    <div class="absolute inset-0 bg-gradient-to-b from-[#f3e8db]/60 to-[#fff]"></div>

    <!-- Floating floral decorations -->
    <img src="/images/floral/floral-soft1.png"
         class="absolute top-0 right-0 w-[320px] opacity-40 blur-[1px] animate-fadeFloat" />

    <img src="/images/floral/floral-soft2.png"
         class="absolute bottom-0 left-0 w-[260px] opacity-40 blur-[2px] animate-fadeFloat2" />

    <!-- Content -->
    <div class="relative max-w-4xl mx-auto text-center px-6">

        <!-- Title -->
        <h2 class="text-4xl md:text-5xl font-[PlayfairDisplay] font-bold text-[#3A2A29] mb-6 leading-tight">
            Reserve Your Elegant
            <span class="text-[#D4A373]">Caffe & Florest</span> Experience
        </h2>

        <p class="text-[#5a4b49] text-lg opacity-80 mb-10 max-w-2xl mx-auto leading-relaxed">
            Pilih waktu terbaik Anda dan biarkan kami menyiapkan suasana paling nyaman,
            kopi terbaik, serta keindahan rangkaian bunga khas Madame Djeli.
        </p>

        <!-- Reservation Glass Card -->
        <div class="backdrop-blur-xl bg-white/40 border border-white/60 shadow-xl rounded-3xl p-10 max-w-xl mx-auto
                    hover:shadow-2xl transition-all duration-300 hover:scale-[1.02]">

            <form action="{{ route('reservation.submit') }}" method="POST" class="grid grid-cols-1 gap-6">
                @csrf

                <div class="text-left">
                    <label class="text-[#3A2A29] font-semibold">Nama</label>
                    <input type="text"
                           class="w-full mt-2 px-4 py-3 rounded-xl border border-[#d9c7b8] focus:ring-2 focus:ring-[#D4A373]
                                  bg-white/70 shadow-inner text-[#3A2A29]"
                           placeholder="Nama lengkap Anda">
                </div>

                <div class="text-left">
                    <label class="text-[#3A2A29] font-semibold">Tanggal Reservasi</label>
                    <input type="date"
                           class="w-full mt-2 px-4 py-3 rounded-xl border border-[#d9c7b8] focus:ring-2 focus:ring-[#D4A373]
                                  bg-white/70 shadow-inner text-[#3A2A29]">
                </div>

                <div class="text-left">
                    <label class="text-[#3A2A29] font-semibold">Jumlah Tamu</label>
                    <input type="number"
                           class="w-full mt-2 px-4 py-3 rounded-xl border border-[#d9c7b8] focus:ring-2 focus:ring-[#D4A373]
                                  bg-white/70 shadow-inner text-[#3A2A29]"
                           placeholder="1 - 10 orang">
                </div>

                <!-- Button -->
                <button
                    class="mt-4 w-full py-4 rounded-full bg-gradient-to-r from-[#D4A373] to-[#e1b689]
                           text-white font-semibold text-lg shadow-lg hover:shadow-2xl
                           hover:-translate-y-1 transition-all duration-300">
                    Book Reservation
                </button>

            </form>

        </div>

    </div>

</section>
{{-- ============================
     SECTION 8 — CINEMATIC GALLERY
=============================== --}}
<section class="relative py-28 bg-[#faf6ef] overflow-hidden">

    <!-- Soft floral decorations -->
    <img src="/images/floral/floral-soft3.png"
         class="absolute top-0 left-0 w-[260px] opacity-30 blur-sm animate-slowFloat">

    <img src="/images/floral/floral-soft4.png"
         class="absolute bottom-0 right-0 w-[300px] opacity-30 blur-sm animate-slowFloat2">

    <div class="relative max-w-6xl mx-auto px-6 text-center">

        <!-- Title -->
        <h2 class="text-4xl md:text-5xl font-[PlayfairDisplay] font-bold text-[#3A2A29] mb-4">
            Our <span class="text-[#D4A373]">Cinematic</span> Gallery
        </h2>

        <p class="text-[#6f5b58] max-w-xl mx-auto mb-16 leading-relaxed">
            Explore a curated gallery that captures the soul of Madame Djeli —
            elegance, aroma, floral beauty, and timeless cafe artistry.
        </p>

        <!-- Masonry Grid Gallery -->
        <div class="columns-1 sm:columns-2 md:columns-3 gap-5 space-y-5">

            @foreach ([
                '/images/gallery/g1.jpg',
                '/images/gallery/g2.jpg',
                '/images/gallery/g3.jpg',
                '/images/gallery/g4.jpg',
                '/images/gallery/g5.jpg',
                '/images/gallery/g6.jpg',
                '/images/gallery/g7.jpg',
                '/images/gallery/g8.jpg',
            ] as $img)
                <div class="break-inside-avoid overflow-hidden rounded-2xl shadow-lg border border-[#f0e6d8]
                            hover:scale-[1.01] hover:shadow-2xl transition-all duration-500 group">

                    <!-- Image -->
                    <img src="{{ $img }}"
                         class="w-full object-cover rounded-2xl group-hover:scale-110
                                transition-transform duration-700 ease-out" loading="lazy">

                </div>
            @endforeach

        </div>

    </div>

</section>
{{-- ============================
     SECTION 9 – LOCATION MAP
=============================== --}}
<section id="location"
         class="relative py-24 bg-[#faf6ef] overflow-hidden">

    <!-- Floral Overlay Kiri -->
    <img src="/images/floral/floral-decor2.png"
         class="absolute left-0 top-0 w-[260px] opacity-20 blur-sm -z-10">

    <!-- Floral Overlay Kanan -->
    <img src="/images/floral/floral-decor1.png"
         class="absolute right-0 bottom-0 w-[300px] opacity-20 blur-sm -z-10">

    <div class="max-w-6xl mx-auto px-6">

        <!-- Title -->
        <div class="text-center mb-14">
            <h2 class="text-4xl font-[PlayfairDisplay] text-[#3A2A29] font-bold">
                Visit Madame Djeli
            </h2>
            <p class="text-[#6a5b58] mt-3 text-lg tracking-wide">
                Temukan tempat kami — ruang elegan untuk menikmati kopi & bunga dalam satu tempat.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

            <!-- MAP -->
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-tr
                        from-[#e4b8c9]/20 via-[#d4a373]/20 to-transparent
                        rounded-3xl blur-2xl"></div>

                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.01450979872!2d110.363!3d-7.824!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwNDknMjYuNCJTIDExMMKwMjEnNDYuOCJF!5e0!3m2!1sen!2sid!4v1700000000000"
                    class="w-full h-[380px] rounded-3xl shadow-xl
                           border-[6px] border-white/70
                           hover:scale-[1.01] transition-all duration-500"
                    allowfullscreen=""
                    loading="lazy">
                </iframe>
            </div>

            <!-- ADDRESS CARD -->
            <div class="bg-white shadow-xl rounded-3xl p-10 border border-[#e8ddd7]">

                <h3 class="text-3xl font-[PlayfairDisplay] text-[#3A2A29] mb-4">
                    Our Location
                </h3>

                <p class="text-[#5c4a48] leading-relaxed">
                    Jl. Melati Indah No. 21,<br>
                    Bandung, Jawa Barat, Indonesia<br>
                    (Sebelah Boutique Gardenia)
                </p>

                <div class="mt-6">
                    <p class="font-semibold text-[#3A2A29]">
                        Opening Hours:
                    </p>
                    <p class="text-[#6a5b58] mt-1">
                        Mon – Sun • 09.00 – 22.00 WIB
                    </p>
                </div>

                <a href="https://maps.google.com/?q=madame+djeli"
                   target="_blank"
                   class="inline-block mt-8 px-8 py-4 rounded-full
                          bg-[#D4A373] text-white shadow-lg
                          hover:bg-[#c08d60] hover:shadow-2xl
                          transition-all duration-300 hover:-translate-y-1
                          font-semibold tracking-wide">
                    Open in Google Maps
                </a>

            </div>

        </div>

    </div>
</section>


@endsection
