@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
  <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard</h1>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white shadow-lg rounded-lg p-6">
      <div class="text-sm text-gray-500 uppercase tracking-wide">Orders Today</div>
      <div class="text-3xl font-bold text-blue-600">{{ $ordersToday }}</div>
    </div>

    <div class="bg-white shadow-lg rounded-lg p-6">
      <div class="text-sm text-gray-500 uppercase tracking-wide">Revenue Today</div>
      <div class="text-3xl font-bold text-green-600">Rp {{ number_format($revenueToday, 0, ',', '.') }}</div>
    </div>

    <div class="bg-white shadow-lg rounded-lg p-6">
      <div class="text-sm text-gray-500 uppercase tracking-wide">Top Product</div>
      <div class="text-3xl font-bold text-purple-600">{{ $topProductName ?? '-' }}</div>
    </div>

    <div class="bg-white shadow-lg rounded-lg p-6">
      <div class="text-sm text-gray-500 uppercase tracking-wide">Total Products</div>
      <div class="text-3xl font-bold text-indigo-600">{{ $totalProducts }}</div>
    </div>

    <div class="bg-white shadow-lg rounded-lg p-6">
      <div class="text-sm text-gray-500 uppercase tracking-wide">Total Florists</div>
      <div class="text-3xl font-bold text-pink-600">{{ $totalFlorists }}</div>
    </div>

    <div class="bg-white shadow-lg rounded-lg p-6">
      <div class="text-sm text-gray-500 uppercase tracking-wide">Total Menus</div>
      <div class="text-3xl font-bold text-orange-600">{{ $totalMenus }}</div>
    </div>

    <div class="bg-white shadow-lg rounded-lg p-6">
      <div class="text-sm text-gray-500 uppercase tracking-wide">Total Categories</div>
      <div class="text-3xl font-bold text-teal-600">{{ $totalCategories }}</div>
    </div>

    <div class="bg-white shadow-lg rounded-lg p-6">
      <div class="text-sm text-gray-500 uppercase tracking-wide">Total Sliders</div>
      <div class="text-3xl font-bold text-red-600">{{ $totalSliders }}</div>
    </div>
  </div>

  <div class="bg-white shadow rounded-lg p-4 mb-4">
    <div class="flex items-center justify-between mb-3">
      <h2 class="text-lg font-medium">Recent Orders</h2>
      <div class="flex items-center space-x-2">
        <a href="{{ route('admin.dashboard.exportOrders') }}" class="inline-block px-3 py-1 bg-green-600 text-white rounded text-sm">Export CSV</a>
      </div>
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead>
          <tr>
            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">ID</th>
            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Customer</th>
            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Total</th>
            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Status</th>
            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Date</th>
            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Action</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
          @foreach($recentOrders as $order)
            <tr>
              <td class="px-4 py-3 text-sm">{{ $order->id }}</td>
              <td class="px-4 py-3 text-sm">{{ $order->user?->name ?? $order->customer_name ?? 'Guest' }}</td>
              <td class="px-4 py-3 text-sm">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
              <td class="px-4 py-3 text-sm">
                <span class="px-2 py-1 text-xs rounded {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : ($order->status == 'completed' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800') }}">
                  {{ ucfirst($order->status) }}
                </span>
              </td>
              <td class="px-4 py-3 text-sm">{{ $order->created_at->format('Y-m-d H:i') }}</td>
              <td class="px-4 py-3 text-sm">
                <a href="{{ route('admin.orders.show', $order->id) }}" class="text-blue-600 hover:underline">View</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="mt-3">
      {{ $recentOrders->links() }}
    </div>
  </div>
</div>
@endsection
