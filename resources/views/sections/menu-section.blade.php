<section id="menu" class="py-24 bg-[#0f0f0f] text-white px-6">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-4xl font-bold text-center text-[#d5a556] drop-shadow">
            Menu Spesial
        </h2>
        <p class="mt-4 text-center text-gray-300 max-w-2xl mx-auto text-lg">
            Pilihan menu terbaik dengan cita rasa khas Madja Café.
        </p>

        <div class="grid md:grid-cols-3 gap-10 mt-14">
            @foreach ($menus as $menu)
            <div class="bg-[#151515] border border-[#d5a556]/30 p-8 rounded-2xl shadow-xl
                        hover:scale-[1.03] hover:border-[#d5a556] transition duration-300">
                <img src="{{ $menu['image'] }}" alt="{{ $menu['name'] }}" class="w-full h-48 object-cover rounded-xl mb-4">
                <h3 class="text-2xl font-semibold text-[#d5a556]">{{ $menu['name'] }}</h3>
                <p class="mt-2 text-gray-300 leading-relaxed">{{ $menu['description'] }}</p>
                <p class="mt-2 text-[#d5a556] font-bold">Rp {{ number_format($menu['price'],0,',','.') }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
