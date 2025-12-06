@extends('admin.layouts.main')

@section('content')

<div class="p-6">

    <h2 class="text-3xl font-bold mb-6 text-gray-800">Orders</h2>

    <div class="bg-white shadow-xl rounded-xl p-6">

        <table class="w-full">
            <thead>
                <tr class="text-left border-b">
                    <th class="p-3">Order ID</th>
                    <th class="p-3">Customer</th>
                    <th class="p-3">Total</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Date</th>
                    <th class="p-3 text-right">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($orders as $o)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-3 font-semibold">#{{ $o->id }}</td>
                    <td class="p-3">{{ $o->user ? $o->user->name : 'Guest' }}</td>
                    <td class="p-3">Rp {{ number_format($o->total,0,',','.') }}</td>
                    <td class="p-3">
                        <span class="px-3 py-1 text-sm rounded-full {{ $o->status_badge_color }}">
                            {{ ucfirst($o->status) }}
                        </span>
                    </td>
                    <td class="p-3">{{ $o->created_at->format('d M Y') }}</td>

                    <td class="p-3 text-right">
                        <form method="POST" action="{{ route('admin.orders.updateStatus', $o) }}" class="inline-block">
                            @csrf
                            <select name="status" class="px-3 py-1 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" aria-label="Update order status">
                                <option value="pending" {{ $o->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $o->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="delivering" {{ $o->status == 'delivering' ? 'selected' : '' }}>Delivering</option>
                                <option value="completed" {{ $o->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $o->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <button type="submit" class="ml-2 px-4 py-1 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500" aria-label="Update status">
                                Update
                            </button>
                        </form>
                        <a href="{{ route('admin.orders.show', $o->id) }}"
                           class="ml-2 px-4 py-1 bg-purple-600 text-white text-sm rounded-md shadow hover:bg-purple-700 inline-block">
                           Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>

@endsection
