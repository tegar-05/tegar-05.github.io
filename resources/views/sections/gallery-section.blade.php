<section id="gallery" class="py-24 bg-[#111] text-white px-6">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-4xl font-bold text-center text-[#d5a556] drop-shadow">
            Gallery
        </h2>
        <p class="mt-4 text-center text-gray-300 max-w-2xl mx-auto text-lg">
            Momen spesial dan suasana Madja Café & Flores
        </p>

        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6 mt-12">
            @foreach ($gallery as $item)
            <div class="overflow-hidden rounded-xl shadow-lg hover:scale-105 transition">
                <img src="{{ $item['image'] }}" alt="Gallery" class="w-full h-64 object-cover">
            </div>
            @endforeach
        </div>
    </div>
</section>
