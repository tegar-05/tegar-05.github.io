@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto py-12 px-4">

    <h1 class="text-3xl font-bold mb-6">Checkout</h1>

    {{-- RINGKASAN KERANJANG --}}
    <div class="bg-white shadow rounded-xl p-6 mb-8">
        <h2 class="text-xl font-semibold mb-4">Ringkasan Pesanan</h2>

        @if(count($cart) > 0)
            <table class="w-full">
                <thead>
                    <tr class="border-b">
                        <th class="py-2 text-left">Menu</th>
                        <th class="py-2">Qty</th>
                        <th class="py-2">Harga</th>
                        <th class="py-2">Total</th>
                    </tr>
                </thead>

                <tbody>
                    @php $subtotal = 0; @endphp

                    @foreach($cart as $item)
                        @php $subtotal += $item['price'] * $item['qty']; @endphp

                        <tr class="border-b">
                            <td class="py-2">{{ $item['name'] }}</td>
                            <td class="py-2 text-center">{{ $item['qty'] }}</td>
                            <td class="py-2 text-center">Rp {{ number_format($item['price']) }}</td>
                            <td class="py-2 text-center">Rp {{ number_format($item['price'] * $item['qty']) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-right mt-4 text-lg font-bold">
                Subtotal: Rp {{ number_format($subtotal) }}
            </div>
        @else
            <p class="text-gray-600">Keranjang kosong.</p>
        @endif
    </div>

    {{-- FORM CHECKOUT --}}
    <div class="bg-white shadow rounded-xl p-6">
        <h2 class="text-xl font-semibold mb-4">Informasi Pembeli</h2>

        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block font-semibold">Nama Lengkap</label>
                <input required name="name" class="w-full border rounded-lg p-3" placeholder="Nama lengkap">
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Nomor Telepon</label>
                <input required name="phone" class="w-full border rounded-lg p-3" placeholder="08xxxxxxxx">
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Alamat Lengkap</label>
                <textarea required name="address" rows="3" class="w-full border rounded-lg p-3" placeholder="Alamat rumah / kantor"></textarea>
            </div>

            <div class="mt-6">
                <button class="w-full bg-yellow-600 text-white py-3 rounded-xl text-lg font-semibold hover:bg-yellow-700">
                    Proses Pembayaran
                </button>
            </div>

        </form>
    </div>

</div>

@endsection
