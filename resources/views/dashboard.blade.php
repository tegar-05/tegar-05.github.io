@extends('layouts.app')

@section('content')
<section class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="text-3xl font-bold mb-8">Admin Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-xl shadow flex flex-col items-center">
                <h2 class="text-lg font-semibold text-gray-600">Total Menu</h2>
                <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $totalMenus }}</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow flex flex-col items-center">
                <h2 class="text-lg font-semibold text-gray-600">Total Orders</h2>
                <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $totalOrders }}</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow flex flex-col items-center">
                <h2 class="text-lg font-semibold text-gray-600">Pending Orders</h2>
                <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $pendingOrders }}</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow flex flex-col items-center">
                <h2 class="text-lg font-semibold text-gray-600">Completed Orders</h2>
                <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $completedOrders }}</p>
            </div>
        </div>
    </div>
</section>
@endsection
