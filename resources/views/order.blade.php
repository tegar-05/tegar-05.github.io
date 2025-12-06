@extends('layouts.app')

@section('content')

<section class="py-24 bg-gray-50">
    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg p-10">

        {{-- TITLE --}}
        <h2 class="text-3xl font-bold mb-6 text-gray-900 text-center">
            Form Pemesanan
        </h2>

        {{-- FORM --}}
        <form action="/checkout" method="GET" class="space-y-6">

            {{-- NAMA --}}
            <div>
                <label class="block mb-1 font-semibold">Nama Lengkap</label>
                <input type="text" name="name" required
                       class="w-full border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-yellow-600 focus:border-yellow-600">
            </div>

            {{-- NOMOR WA --}}
            <div>
                <label class="block mb-1 font-semibold">Nomor WhatsApp</label>
                <input type="text" name="whatsapp" required
                       class="w-full border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-yellow-600 focus:border-yellow-600">
            </div>

            {{-- PILIH MENU --}}
            <div>
                <label class="block mb-1 font-semibold">Pilih Menu</label>

                <select name="menu" required
                        class="w-full border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-yellow-600 focus:border-yellow-600">

                    <option value="">-- pilih menu --</option>
                    <option>Wagyu Steak Premium - 145.000</option>
                    <option>Grilled Salmon Lemon - 98.000</option>
                    <option>Chicken Butter Rice - 42.000</option>
                    <option>Spaghetti Creamy Alfredo - 39.000</option>
                    <option>Crispy Beef Bowl - 57.000</option>
                    <option>Mix Vegetable Salad - 28.000</option>

                </select>
            </div>

            {{-- JUMLAH --}}
            <div>
                <label class="block mb-1 font-semibold">Jumlah</label>
                <input type="number" name="qty" required min="1" value="1"
                       class="w-full border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-yellow-600 focus:border-yellow-600">
            </div>

            {{-- CATATAN OPSIONAL --}}
            <div>
                <label class="block mb-1 font-semibold">Catatan (opsional)</label>
                <textarea name="notes" rows="4"
                          class="w-full border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-yellow-600 focus:border-yellow-600"
                          placeholder="Contoh: tidak pedas, saus dipisah, dll..."></textarea>
            </div>

            {{-- BUTTON --}}
            <div class="pt-4">
                <button type="submit"
                        class="w-full bg-yellow-600 text-white py-3 rounded-xl text-lg font-semibold
                        hover:bg-yellow-700 transition shadow-lg">
                    Lanjut ke Checkout
                </button>
            </div>

        </form>

    </div>
</section>

@endsection
