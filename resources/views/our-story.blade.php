@extends('layouts.app')

@section('content')
{{-- ============================
     OUR STORY PAGE
============================= --}}
<section class="relative py-32 bg-[#F6F1EA] min-h-screen">

    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-[url('/images/paper-texture.png')] bg-cover bg-center opacity-5"></div>

    <!-- Floral Decorations -->
    <img src="/images/floral/floral-soft1.png"
         class="absolute top-10 left-10 w-[200px] opacity-20 blur-sm pointer-events-none">
    <img src="/images/floral/floral-soft2.png"
         class="absolute bottom-10 right-10 w-[250px] opacity-20 blur-sm pointer-events-none">

    <div class="relative max-w-6xl mx-auto px-6">

        <!-- Page Title -->
        <div class="text-center mb-16">
            <h1 class="text-5xl md:text-6xl font-[PlayfairDisplay] font-bold text-[#402A1E] mb-6">
                Our Story
            </h1>
            <p class="text-xl text-[#7AA374] max-w-2xl mx-auto leading-relaxed">
                A journey of passion, creativity, and the perfect blend of coffee and flowers.
            </p>
        </div>

        <!-- Founder Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-20">

            <!-- Founder Image -->
            <div class="relative group">
                <img src="/images/founder/founder.jpg"
                     alt="Madame Djeli, Founder of Madame Djeli Caffe & Flores"
                     class="w-full h-[500px] object-cover rounded-3xl shadow-2xl
                            group-hover:scale-105 transition-transform duration-700">

                <!-- Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent
                            rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            </div>

            <!-- Founder Bio -->
            <div class="animate-fadein-slow">
                <h2 class="text-4xl font-[PlayfairDisplay] text-[#402A1E] font-bold mb-6">
                    Meet Madame Djeli
                </h2>

                <p class="text-lg text-[#5a4b49] leading-relaxed mb-6">
                    Born from a deep love for the artistry of coffee and the beauty of flowers,
                    Madame Djeli began as a dream in a small garden in Bandung. What started as
                    weekend gatherings with friends evolved into a sanctuary where every cup
                    tells a story and every arrangement whispers poetry.
                </p>

                <p class="text-lg text-[#5a4b49] leading-relaxed mb-6">
                    With over a decade of experience in both culinary arts and floral design,
                    Madame Djeli believes that true hospitality comes from understanding the
                    delicate balance between nature's gifts and human creativity. Each space
                    we create is a canvas, each moment a masterpiece.
                </p>

                <blockquote class="text-xl font-[PlayfairDisplay] text-[#7AA374] italic border-l-4 border-[#D4A373] pl-6">
                    "In every petal and every bean lies the potential for magic.
                    Our mission is to awaken that magic in every guest who walks through our doors."
                </blockquote>
            </div>
        </div>

        <!-- Philosophy Section -->
        <div class="bg-white/60 backdrop-blur-sm rounded-3xl p-10 md:p-16 shadow-xl">

            <h2 class="text-4xl font-[PlayfairDisplay] text-[#402A1E] font-bold text-center mb-12">
                Our Philosophy
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

                <!-- Philosophy 1 -->
                <div class="text-center group">
                    <div class="w-20 h-20 bg-[#D4A373] rounded-full flex items-center justify-center mx-auto mb-6
                                group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-[PlayfairDisplay] text-[#402A1E] font-semibold mb-4">
                        Authentic Experience
                    </h3>
                    <p class="text-[#5a4b49] leading-relaxed">
                        Every element in our space is chosen with intention, creating genuine
                        moments of connection between our guests and the world around them.
                    </p>
                </div>

                <!-- Philosophy 2 -->
                <div class="text-center group">
                    <div class="w-20 h-20 bg-[#7AA374] rounded-full flex items-center justify-center mx-auto mb-6
                                group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2L3 7v11a1 1 0 001 1h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a1 1 0 001-1V7l-7-5z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-[PlayfairDisplay] text-[#402A1E] font-semibold mb-4">
                        Sustainable Luxury
                    </h3>
                    <p class="text-[#5a4b49] leading-relaxed">
                        We believe luxury should never come at the expense of our planet.
                        From locally sourced ingredients to eco-friendly practices, sustainability is at our core.
                    </p>
                </div>

                <!-- Philosophy 3 -->
                <div class="text-center group">
                    <div class="w-20 h-20 bg-[#D98C8C] rounded-full flex items-center justify-center mx-auto mb-6
                                group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-[PlayfairDisplay] text-[#402A1E] font-semibold mb-4">
                        Community First
                    </h3>
                    <p class="text-[#5a4b49] leading-relaxed">
                        Madame Djeli is more than a cafe—it's a gathering place where stories
                        are shared, connections are made, and memories are created together.
                    </p>
                </div>

            </div>
        </div>

        <!-- CTA Section -->
        <div class="text-center mt-16">
            <a href="{{ route('menu') }}"
               class="inline-block px-10 py-4 bg-[#7AA374] text-white rounded-full text-lg font-semibold
                      hover:bg-[#D4A373] hover:scale-105 transition-all duration-300 shadow-lg
                      focus:ring-2 focus:ring-[#7AA374] focus:ring-offset-2"
               aria-label="Explore our menu">
                Experience Our World
            </a>
        </div>

    </div>
</section>
@endsection
