<div class="max-w-6xl mx-auto">
        <h2 class="text-4xl font-bold text-center text-[#d5a556] drop-shadow">
            Testimonial
        </h2>
        <p class="mt-4 text-center text-gray-300 max-w-2xl mx-auto text-lg">
            Pendapat pelanggan tentang pengalaman mereka di Madja Café & Flores
        </p>

        <div class="grid md:grid-cols-3 gap-10 mt-14">
            @foreach ($testimonials as $t)
            <div class="bg-[#151515] border border-[#d5a556]/30 p-8 rounded-2xl shadow-xl">
                <p class="text-gray-300 leading-relaxed">"{{ $t['message'] }}"</p>
                <h4 class="mt-4 text-[#d5a556] font-semibold">{{ $t['name'] }}</h4>
                <span class="text-gray-400 text-sm">{{ $t['role'] }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>
=======
<section id="testimonial" class="py-24 bg-[#111] text-white px-6">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-4xl font-bold text-center text-[#d5a556] drop-shadow">
            Testimonial
        </h2>
        <p class="mt-4 text-center text-gray-300 max-w-2xl mx-auto text-lg">
            Pendapat pelanggan tentang pengalaman mereka di Madja Café & Flores
        </p>

        <div class="relative overflow-hidden mt-14">
            <div class="flex transition-transform duration-500 ease-in-out" id="testimonial-slider">
                @foreach ($testimonials as $index => $t)
                <div class="flex-shrink-0 w-full md:w-1/3 px-4">
                    <div class="bg-[#151515] border border-[#d5a556]/30 p-8 rounded-2xl shadow-xl hover:scale-105 transition">
                        <p class="text-gray-300 leading-relaxed">"{{ $t['message'] }}"</p>
                        <h4 class="mt-4 text-[#d5a556] font-semibold">{{ $t['name'] }}</h4>
                        <span class="text-gray-400 text-sm">{{ $t['role'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>
            <button class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-[#d5a556] text-black p-2 rounded-full shadow-lg" onclick="prevSlide()">‹</button>
            <button class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-[#d5a556] text-black p-2 rounded-full shadow-lg" onclick="nextSlide()">›</button>
        </div>
    </div>
</section>

<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('#testimonial-slider > div');
    const totalSlides = slides.length;

    function showSlide(index) {
        const slider = document.getElementById('testimonial-slider');
        slider.style.transform = `translateX(-${index * 100}%)`;
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        showSlide(currentSlide);
    }

    // Auto slide
    setInterval(nextSlide, 5000);
</script>
