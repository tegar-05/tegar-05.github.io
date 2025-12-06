<section id="wedding" class="py-24 bg-[#0f0f0f] text-white px-6">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-4xl font-bold text-center text-[#d5a556] drop-shadow">
            Wedding & Private Event
        </h2>
        <p class="mt-4 text-center text-gray-300 max-w-2xl mx-auto text-lg">
            Reservasi untuk acara spesial Anda dengan ambience rustic tropical terbaik.
        </p>

        <div class="grid md:grid-cols-3 gap-10 mt-14">
            @foreach ([
                ['Wedding Package', 'Paket lengkap dekorasi, catering, dan venue eksklusif.'],
                ['Engagement', 'Acara tunangan dengan ambience warm & elegant.'],
                ['Birthday & Event', 'Private event dengan menu pilihan premium.']
            ] as $item)
            <div class="bg-[#151515] border border-[#d5a556]/30 p-8 rounded-2xl shadow-xl
                        hover:scale-[1.03] hover:border-[#d5a556] transition duration-300">
                <h3 class="text-2xl font-semibold text-[#d5a556]">{{ $item[0] }}</h3>
                <p class="mt-4 text-gray-300 leading-relaxed">{{ $item[1] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
