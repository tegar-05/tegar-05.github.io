@extends('admin.layouts.main')

@section('content')

<div class="p-6">

    <a href="{{ route('admin.orders.index') }}"
       class="text-purple-600 hover:underline">&larr; Back</a>

    <div class="bg-white shadow-xl rounded-xl p-6 mt-4">
        <h2 class="text-2xl font-bold mb-4">Order Detail</h2>

        <p><b>Order ID:</b> #{{ $order->id }}</p>
        <p><b>Customer:</b> {{ $order->customer_name }}</p>
        <p><b>Total:</b> Rp {{ number_format($order->total, 0) }}</p>
        <p><b>Status:</b> {{ ucfirst($order->status) }}</p>

        <hr class="my-4">

        <h3 class="text-xl font-semibold">Items:</h3>

        @foreach ($order->items as $item)
            <div class="mt-2">
                • {{ $item->product_name }} ({{ $item->qty }} × Rp {{ number_format($item->price) }})
            </div>
        @endforeach
    </div>

</div>

@endsection
