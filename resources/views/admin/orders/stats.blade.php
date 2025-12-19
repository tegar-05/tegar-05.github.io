@extends('admin.layout')

@section('content')
<section class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-6xl mx-auto px-6">
        <h1 class="text-3xl font-bold mb-8">Statistik Pesanan</h1>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white rounded-xl shadow p-6 text-center">
                <h2 class="text-lg font-semibold text-gray-600">Total Pesanan</h2>
                <p class="text-3xl font-bold mt-2">{{ $totalOrders }}</p>
            </div>
            <div class="bg-white rounded-xl shadow p-6 text-center">
                <h2 class="text-lg font-semibold text-gray-600">Pending</h2>
                <p class="text-3xl font-bold mt-2">{{ $pendingOrders }}</p>
            </div>
            <div class="bg-white rounded-xl shadow p-6 text-center">
                <h2 class="text-lg font-semibold text-gray-600">Completed</h2>
                <p class="text-3xl font-bold mt-2">{{ $completedOrders }}</p>
            </div>
            <div class="bg-white rounded-xl shadow p-6 text-center">
                <h2 class="text-lg font-semibold text-gray-600">Canceled</h2>
                <p class="text-3xl font-bold mt-2">{{ $canceledOrders }}</p>
            </div>
        </div>

        {{-- Optional: bisa tambah chart dengan chart.js atau apexcharts --}}
    </div>
</section>
@endsection
