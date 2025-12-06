<section id="reservation" class="bg-[#0f0f0f] py-24 px-6 text-white">
    <div class="max-w-3xl mx-auto bg-[#151515] p-12 rounded-3xl shadow-2xl border border-[#d5a556]/40">
        <h2 class="text-4xl font-bold text-center text-[#d5a556] drop-shadow">
            Reservation
        </h2>
        <p class="text-center text-gray-400 mt-3">
            Silakan isi formulir untuk melakukan reservasi.
        </p>

        <form id="waReservationForm" class="space-y-6 mt-12">
            @foreach (['Nama'=>'text','Nomor WhatsApp'=>'text','Tanggal'=>'date','Jumlah Orang'=>'number'] as $label=>$type)
            <div>
                <label class="block mb-2 font-medium text-gray-300">{{ $label }}</label>
                <input type="{{ $type }}" id="{{ Str::slug($label,'-') }}"
                    class="w-full px-5 py-3 bg-[#111] border border-[#d5a556]/40 rounded-lg 
                    focus:border-[#d5a556] focus:ring-[#d5a556]/50 focus:ring-2 transition" required>
            </div>
            @endforeach

            <button type="submit"
                class="w-full mt-4 bg-[#d5a556] text-black font-semibold py-4 rounded-xl
                hover:bg-[#e7b866] shadow-lg shadow-black/30 transition duration-300">
                Kirim ke WhatsApp
            </button>
        </form>
    </div>
</section>
