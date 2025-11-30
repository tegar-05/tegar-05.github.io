@extends('layouts.app')

@section('content')

{{-- NAVBAR --}}
@include('layouts.navbar')

{{-- ===============================================================
      HERO SECTION — PREMIUM LUXURY EDITION
================================================================ --}}
<section class="relative min-h-screen flex items-center justify-center overflow-hidden select-none">

    {{-- Background Image --}}
    <div class="absolute inset-0">
        <img 
            src="/img/hero-main.jpeg"
            alt="Madame Djeli Background"
            loading="lazy" decoding="async"
            class="w-full h-full object-cover brightness-[0.40] scale-105 animate-slow-zoom"
        >
    </div>

    {{-- Gold Gradient Overlay --}}
    <div class="absolute inset-0 bg-gradient-to-b 
                from-black/80 via-black/40 to-black/10">
    </div>

    {{-- Floating Gold Particles --}}
    <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    {{-- MAIN TEXT BLOCK --}}
    <div 
        x-data
        x-init="
            $el.classList.add('opacity-0','translate-y-6'); 
            setTimeout(() => {
                $el.classList.remove('opacity-0','translate-y-6');
            }, 200);
        "
        class="relative z-[5] text-center max-w-2xl px-6 transition-all duration-700"
    >

        {{-- Title --}}
        <h1 class="title-gold text-center fade-gold">
            Welcome to  
            <span class="text-gold shadow-goldglow">Madame Djeli</span>
        </h1>

        {{-- Subtitle --}}
        <p class="p-md tracking-soft text-gray-700 fade-gold">
            A luxury café experience where artisan desserts, premium coffee,  
            and a warm ambience blend into a memorable taste journey.
        </p>

        {{-- CTA Buttons --}}
        <div class="mt-8 flex justify-center gap-4">
            <a 
                href="#menu"
                class="px-8 py-3 bg-gold text-charcoal rounded-full text-lg font-semibold shadow-gold hover:bg-amber-300 transition-all"
            >
                View Menu
            </a>

            <a 
                href="#reservation"
                class="px-8 py-3 border border-white/40 text-white rounded-full text-lg hover:bg-white/10 transition"
            >
                Reserve Table
            </a>
        </div>

        {{-- Category Pills --}}
        <div class="flex justify-center gap-3 mt-8">
            <span class="pill">Desserts</span>
            <span class="pill">Coffee</span>
            <span class="pill">Pastries</span>
        </div>
    </div>

</section>


{{-- ===============================================================
      PREMIUM MENU SECTION — HORIZONTAL SCROLL
================================================================ --}}
<section id="menu" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">

        {{-- Section Title --}}
        <h2 class="text-4xl font-semibold text-center text-gold mb-12 tracking-wide">
            Premium Desserts
        </h2>

        {{-- Horizontal Scroll Wrapper --}}
        <div class="flex gap-8 overflow-x-auto no-scrollbar pb-4">

            {{-- Item 1 --}}
            <div class="min-w-[280px] bg-white rounded-2xl shadow-lg border border-gold/30 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                <img src="/images/dessert1.jpg"
                loading="lazy" decoding="async"    
                class="w-full h-48 object-cover rounded-t-2xl" alt="Dessert 1">
                <div class="p-5">
                    <h3 class="text-xl font-semibold text-gray-900">Chocolate Velvet</h3>
                    <p class="text-gray-600 mt-2">Premium dark chocolate dessert.</p>
                </div>
            </div>

            {{-- Item 2 --}}
            <div class="min-w-[280px] bg-white rounded-2xl shadow-lg border border-gold/30 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                <img src="/images/dessert2.jpg"
                loading="lazy" decoding="async"
                     class="w-full h-48 object-cover rounded-t-2xl" alt="Dessert 2">
                <div class="p-5">
                    <h3 class="text-xl font-semibold text-gray-900">Royal Strawberry</h3>
                    <p class="text-gray-600 mt-2">Fresh strawberry with luxury look.</p>
                </div>
            </div>

            {{-- Item 3 --}}
            <div class="min-w-[280px] bg-white rounded-2xl shadow-lg border border-gold/30 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                <img src="/images/dessert3.jpg"
                loading="lazy" decoding="async"
                     class="w-full h-48 object-cover rounded-t-2xl" alt="Dessert 3">
                <div class="p-5">
                    <h3 class="text-xl font-semibold text-gray-900">Golden Caramel Pie</h3>
                    <p class="text-gray-600 mt-2">Soft pie with gold caramel essence.</p>
                </div>
            </div>

        </div>

    </div>
</section>


{{-- ===============================================================
      FEATURE CARDS — ELEGANT 4 ICON GRID
================================================================ --}}
<section class="py-24 bg-warm">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-8">

        @foreach ([
            'Artisan Dessert Crafting',
            'Finest Natural Ingredients',
            'Fresh Daily Baked Pastries',
            'Signature Coffee Blends'
        ] as $index => $title)

            <div class="bg-ivory p-8 rounded-2xl text-center shadow-lg border border-gold/20
                        hover:shadow-2xl hover:-translate-y-2 transition-all duration-300"
                 data-aos="fade-up" data-aos-delay="{{ ($index+1)*140 }}">

                <img src="/img/card{{ $index+1 }}.jpg"
                loading="lazy" decoding="async"
                     class="w-20 h-20 mx-auto mb-4 rounded-full object-cover shadow-md border border-gold/50">

                <h3 class="text-lg font-semibold text-charcoal">{{ $title }}</h3>

                <p class="text-sm text-slateSoft mt-2">
                    Experience elegance in every touch.
                </p>

            </div>

        @endforeach

    </div>
</section>



{{-- ===============================================================
      LUXURY TESTIMONIAL SECTION — PREMIUM GOLD
================================================================ --}}
<section class="py-24 bg-white relative overflow-hidden">

    <!-- Gold Glow -->
    <div class="absolute top-0 left-1/2 w-[600px] h-[600px] bg-gold/10 blur-[120px] rounded-full -translate-x-1/2"></div>

    <div class="container mx-auto px-6 lg:px-12 text-center relative z-10">
        
        <!-- Title -->
        <h2 class="text-4xl md:text-5xl font-bold text-charcoal mb-6">
            What Our Guests Say
        </h2>
        <div class="w-24 h-1 bg-gradient-to-r from-gold to-gold-light mx-auto mb-12 rounded-full"></div>

        <!-- Swiper -->
        <div class="swiper testimonialSlider">

            <div class="swiper-wrapper">

                <!-- Card 1 -->
                <div class="swiper-slide">
                    <div class="bg-white p-8 rounded-2xl shadow-lg border border-gold/20">
                        <p class="text-gray-700 italic leading-relaxed">
                            “Madame Djeli memberikan pengalaman makan yang luar biasa.
                            Dessert-nya sangat lembut, aromanya wangi, dan plating-nya seperti fine dining.”
                        </p>
                        <div class="mt-6 font-semibold text-gold">— Amanda S.</div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="swiper-slide">
                    <div class="bg-white p-8 rounded-2xl shadow-lg border border-gold/20">
                        <p class="text-gray-700 italic leading-relaxed">
                            “Tempatnya nyaman, estetik, cocok buat foto! 
                            Tapi yang paling penting makanannya enak banget dan premium.”
                        </p>
                        <div class="mt-6 font-semibold text-gold">— Kevin L.</div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="swiper-slide">
                    <div class="bg-white p-8 rounded-2xl shadow-lg border border-gold/20">
                        <p class="text-gray-700 italic leading-relaxed">
                            “Saya suka vibe-nya. Elegan, mahal, pelayanan ramah. 
                            Feels like restoran luar negeri!”
                        </p>
                        <div class="mt-6 font-semibold text-gold">— Natasha M.</div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

<!-- ===================== -->
<!--    PREMIUM GALLERY    -->
<!-- ===================== -->
<section class="py-20 bg-[#0e0d0c]">
    <div class="text-center mb-12" data-aos="fade-up">
        <h2 class="text-4xl font-serif font-bold text-white tracking-wide">
            Our Signature Ambience
        </h2>
        <p class="text-gray-300 mt-2 text-lg">
            Experience the elegant atmosphere of Madame Djeli Restaurant & Café
        </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 px-6 lg:px-20">

        <!-- Image 1 -->
        <div class="relative group overflow-hidden rounded-xl shadow-lg" data-aos="fade-up" data-aos-delay="100">
            <img src="/images/gallery1.jpg" class="w-full h-72 object-cover transition-all duration-700 group-hover:scale-110">
            <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition duration-500"></div>
            <div class="absolute bottom-4 left-4 text-white opacity-0 group-hover:opacity-100 transition duration-500">
                <p class="text-xl font-semibold">Dining Area</p>
            </div>
        </div>

        <!-- Image 2 -->
        <div class="relative group overflow-hidden rounded-xl shadow-lg" data-aos="fade-up" data-aos-delay="200">
            <img src="/images/gallery2.jpg" class="w-full h-72 object-cover transition-all duration-700 group-hover:scale-110">
            <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition duration-500"></div>
            <div class="absolute bottom-4 left-4 text-white opacity-0 group-hover:opacity-100 transition duration-500">
                <p class="text-xl font-semibold">Coffee & Pastry Bar</p>
            </div>
        </div>

        <!-- Image 3 -->
        <div class="relative group overflow-hidden rounded-xl shadow-lg" data-aos="fade-up" data-aos-delay="300">
            <img src="/images/gallery3.jpg" class="w-full h-72 object-cover transition-all duration-700 group-hover:scale-110">
            <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition duration-500"></div>
            <div class="absolute bottom-4 left-4 text-white opacity-0 group-hover:opacity-100 transition duration-500">
                <p class="text-xl font-semibold">Luxury Interior</p>
            </div>
        </div>

        <!-- Image 4 -->
        <div class="relative group overflow-hidden rounded-xl shadow-lg" data-aos="fade-up" data-aos-delay="400">
            <img src="/images/gallery4.jpg" class="w-full h-72 object-cover transition-all duration-700 group-hover:scale-110">
            <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition duration-500"></div>
            <div class="absolute bottom-4 left-4 text-white opacity-0 group-hover:opacity-100 transition duration-500">
                <p class="text-xl font-semibold">Private Table</p>
            </div>
        </div>

        <!-- Image 5 -->
        <div class="relative group overflow-hidden rounded-xl shadow-lg" data-aos="fade-up" data-aos-delay="500">
            <img src="/images/gallery5.jpg" class="w-full h-72 object-cover transition-all duration-700 group-hover:scale-110">
            <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition duration-500"></div>
            <div class="absolute bottom-4 left-4 text-white opacity-0 group-hover:opacity-100 transition duration-500">
                <p class="text-xl font-semibold">Café Corner</p>
            </div>
        </div>

        <!-- Image 6 -->
        <div class="relative group overflow-hidden rounded-xl shadow-lg" data-aos="fade-up" data-aos-delay="600">
            <img src="/images/gallery6.jpg" class="w-full h-72 object-cover transition-all duration-700 group-hover:scale-110">
            <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition duration-500"></div>
            <div class="absolute bottom-4 left-4 text-white opacity-0 group-hover:opacity-100 transition duration-500">
                <p class="text-xl font-semibold">Outdoor Seating</p>
            </div>
        </div>

    </div>
</section>


{{-- ===============================================================
      FEATURED PRODUCTS — 3 LUXURY CARDS
================================================================ --}}
<section id="featured" class="py-24 bg-warm">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-3 gap-10">

        @php
            $items = [
                ['name' => 'Velvet Cake Slice', 'img' => '/img/d1.jpg'],
                ['name' => 'Mocha Cream Cup', 'img' => '/img/d2.jpg'],
                ['name' => 'Classic Tiramisu', 'img' => '/img/d3.jpg'],
            ];
        @endphp

        @foreach($items as $i => $item)

        <div data-aos="fade-up" data-aos-delay="{{ $i * 180 }}"
             class="bg-white p-8 rounded-3xl shadow-xl border border-gold/30
                    hover:shadow-2xl hover:-translate-y-2 hover:scale-[1.03]
                    transition-all duration-300 cursor-pointer">

            <img src="{{ $item['img'] }}"
            loading="lazy" decoding="async"
                 class="rounded-2xl shadow-xl mb-6 h-56 w-full object-cover">

            <h3 class="text-2xl font-semibold mb-2 text-charcoal">
                {{ $item['name'] }}
            </h3>

            <p class="text-sm text-gray-600 mb-5">
                Our signature dessert, crafted daily with premium ingredients.
            </p>

            <a href="#menu"
               class="inline-block px-6 py-2 border border-gold/60 text-gold 
                      rounded-full font-medium hover:bg-gold hover:text-charcoal 
                      transition-all">
                Order Now
            </a>

        </div>

        @endforeach

    </div>
</section>



{{-- ===================================================================
      SIGNATURE DISH — PERFECT 2-COLUMN
=================================================================== --}}
<section class="py-24 bg-warm">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">

        <div data-aos="fade-right">
            <h2 class="text-4xl font-bold text-charcoal leading-tight">Signature Dessert</h2>

            <p class="text-gray-600 mt-4 max-w-md">
                A masterpiece blending sweetness, texture, and artistry —  
                crafted with passion and loved by every guest.
            </p>

            <div class="mt-8 flex gap-4">
                <a href="#menu" 
                   class="bg-gold text-charcoal px-6 py-3 rounded-full font-semibold hover:bg-amber-300 transition">
                    Explore Dish
                </a>
                <a href="#ingredients" 
                   class="border border-gold px-6 py-3 rounded-full text-gold hover:bg-gold hover:text-charcoal transition">
                    Ingredients
                </a>
            </div>
        </div>

        <div data-aos="fade-left" class="flex justify-end">
            <img src="/img/signature-dessert.png" 
            loading="lazy" decoding="async"
                 class="w-96 rounded-3xl shadow-2xl object-cover">
        </div>

    </div>
</section>



{{-- ===================================================================
      CTA — FINAL CALL TO ACTION
=================================================================== --}}
<section class="relative py-28 overflow-hidden bg-[#0b0b0b] text-white">

    <!-- GOLD LIGHT TEXTURE -->
    <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/gold-dust.png')]"></div>

    <!-- SOFT GOLD GLOW LEFT -->
    <div class="absolute -left-40 top-0 w-96 h-96 bg-gradient-to-b from-[#d4a351] to-[#f8e4b0] rounded-full blur-3xl opacity-20"></div>

    <!-- SOFT GOLD GLOW RIGHT -->
    <div class="absolute -right-40 bottom-0 w-[470px] h-[470px] bg-gradient-to-t from-[#d4a351] to-[#f8e4b0] rounded-full blur-[180px] opacity-25"></div>


    <div class="relative max-w-4xl mx-auto text-center px-6 animate-fadeInUp">

        <!-- TITLE -->
        <h2 class="text-5xl font-extrabold tracking-wide text-gold drop-shadow-[0_0_25px_rgba(255,215,130,0.6)]">
            Reserve Your Luxury Experience
        </h2>

        <p class="mt-4 text-gray-300 text-lg opacity-90 max-w-2xl mx-auto">
            Indulge in the signature taste and ambiance of <span class="text-gold font-semibold">Madame Djeli</span>.  
            Book your exclusive moment now.
        </p>

        <!-- BUTTONS WRAPPER -->
        <div class="mt-12 flex justify-center gap-6">

            <!-- BUTTON 1 (GOLD GLOW) -->
            <a href="#booking" 
                class="px-10 py-4 text-black font-semibold rounded-full text-xl
                bg-gradient-to-r from-[#d4a351] to-[#f7e2b3] shadow-[0_0_30px_rgba(255,220,150,0.5)]
                hover:shadow-[0_0_45px_rgba(255,225,160,0.8)]
                hover:scale-105 active:scale-95 transition-all duration-300">
                Reserve Now ✨
            </a>

            <!-- BUTTON 2 (LUXURY OUTLINE) -->
            <a href="#menu" 
                class="px-10 py-4 text-xl rounded-full font-semibold
                border border-[#d4a351] text-[#f3d79b]
                hover:bg-[#d4a351] hover:text-black hover:shadow-[0_0_25px_rgba(255,215,130,0.7)]
                hover:scale-105 active:scale-95 transition-all duration-300">
                View Menu
            </a>

        </div>

    </div>

</section>

<!-- ANIMATION -->
<style>
    @keyframes fadeInUp {
        0% { opacity: 0; transform: translateY(30px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeInUp {
        animation: fadeInUp 1.2s ease-out forwards;
    }
    .text-gold {
        color: #f5d590;
    }
</style>



{{-- ===================================================================
      STYLING: Particles, Zoom, Pills, Glow
=================================================================== --}}
<style>
.particle {
    position: absolute;
    width: 7px;
    height: 7px;
    background: rgba(255, 215, 160, 0.45);
    border-radius: 999px;
    top: 100%;
    left: calc(10% + 80% * var(--i));
    animation: floatUp 10s linear infinite;
    box-shadow: 0 0 12px rgba(255, 180, 100, 0.6);
}
.particle:nth-child(1) { --i: .2; animation-delay: 0s; }
.particle:nth-child(2) { --i: .5; animation-delay: 2s; }
.particle:nth-child(3) { --i: .8; animation-delay: 4s; }

@keyframes floatUp {
    0% { transform: translateY(20px) scale(0.5); opacity: 0; }
    50% { opacity: 0.7; }
    100% { transform: translateY(-120vh) scale(1); opacity: 0; }
}

@keyframes slowZoom {
    from { transform: scale(1); }
    to { transform: scale(1.07); }
}
.animate-slow-zoom {
    animation: slowZoom 18s ease-in-out infinite alternate;
}

.pill {
    @apply text-sm bg-white/10 text-white px-4 py-2 rounded-full 
           backdrop-blur border border-white/10;
}

.shadow-goldglow {
    text-shadow: 0px 0px 15px rgba(255, 190, 80, 0.6);
}
</style>

<!-- =========================== -->
<!--   RESERVATION FORM PREMIUM  -->
<!-- =========================== -->
<section id="reservation" class="pt-20 pb-32 bg-[#0e0e0e] text-white">
    <div class="max-w-4xl mx-auto text-center mb-12">
        <h2 class="text-4xl font-bold text-[#d5a556] mb-3">Reservation</h2>
        <p class="text-gray-300 text-lg">Book your table at Madame Djeli</p>
    </div>

    <div class="max-w-3xl mx-auto bg-[#151515] p-10 pb-16 px-6 rounded-2xl shadow-2xl border border-[#d5a556] parallax-card"


        <form id="waReservationForm" class="space-y-6">

            <!-- Name -->
            <div>
                <label class="block text-[#d5a556] mb-1 font-medium">Full Name</label>
                <input id="name" type="text"
                    class="w-full p-4 bg-black/30 border border-[#d5a556]/40 rounded-xl text-white 
                    focus:border-[#d5a556] focus:ring-1 focus:ring-[#d5a556] outline-none transition">
                <p class="text-red-400 mt-1 text-sm hidden" id="errName">Nama wajib diisi.</p>
            </div>

            <!-- People -->
            <div>
                <label class="block text-[#d5a556] mb-1 font-medium">Number of Guests</label>
                <input id="people" type="number"
                    class="w-full p-4 bg-black/30 border border-[#d5a556]/40 rounded-xl text-white 
                    focus:border-[#d5a556] focus:ring-1 focus:ring-[#d5a556] outline-none transition">
                <p class="text-red-400 mt-1 text-sm hidden" id="errPeople">Jumlah tamu wajib diisi.</p>
            </div>

            <!-- Date -->
            <div>
                <label class="block text-[#d5a556] mb-1 font-medium">Reservation Date</label>
                <input id="date" type="date"
                    class="w-full p-4 bg-black/30 border border-[#d5a556]/40 rounded-xl text-white 
                    focus:border-[#d5a556] focus:ring-1 focus:ring-[#d5a556] outline-none transition">
                <p class="text-red-400 mt-1 text-sm hidden" id="errDate">Tanggal wajib diisi.</p>
            </div>

            <!-- Note -->
            <div>
                <label class="block text-[#d5a556] mb-1 font-medium">Notes</label>
                <textarea id="note" rows="3"
                    class="w-full p-4 bg-black/30 border border-[#d5a556]/40 rounded-xl text-white 
                    focus:border-[#d5a556] focus:ring-1 focus:ring-[#d5a556] outline-none transition"></textarea>
            </div>

            <!-- Button -->
            <button type="submit"
                class="w-full py-4 text-xl font-semibold rounded-xl 
                bg-gradient-to-r from-[#d5a556] to-[#f7d48e] text-black shadow-xl hover:opacity-90 transition">
                Book Now ✨
            </button>
        </form>
    </div>
</section>



@section('scripts')
<script>
document.getElementById("waReservationForm").addEventListener("submit", function(e) {
    e.preventDefault();

    let name = document.getElementById("name").value;
    let people = document.getElementById("people").value;
    let date = document.getElementById("date").value;
    let note = document.getElementById("note").value;

    let message =
`Reservation Request:
------------------------
Name: ${name}
Guests: ${people}
Date: ${date}
Notes: ${note}
------------------------
From Madame Djeli Website`;

    let phone = "62895328879093";

    let url = `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;

    window.open(url, "_blank");
});
</script>




@endsection
