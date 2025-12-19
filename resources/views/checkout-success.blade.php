@extends('layouts.app')

@section('title', 'Order Success - Madame Djeli')

@section('content')
<section class="py-24 bg-[#F6F1EA] min-h-screen">
    <div class="max-w-4xl mx-auto px-6">

        <!-- Success Header -->
        <div class="text-center mb-12">
            <div class="w-24 h-24 mx-auto mb-6 bg-[#7AA374] rounded-full flex items-center justify-center">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-[PlayfairDisplay] font-bold text-[#402A1E] mb-4">Order Placed Successfully!</h1>
            <p class="text-[#7AA374] text-lg">Thank you for your order. We'll start preparing your delicious food right away.</p>
        </div>

        <!-- Order Details -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
            <h2 class="text-2xl font-[PlayfairDisplay] font-bold text-[#402A1E] mb-6">Order Details</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Order Info -->
                <div>
                    <h3 class="text-lg font-semibold text-[#402A1E] mb-4">Order Information</h3>
                    <div class="space-y-2">
                        <p><span class="font-medium">Order ID:</span> #{{ $order->id }}</p>
                        <p><span class="font-medium">Status:</span>
                            <span class="px-3 py-1 bg-[#7AA374] text-white text-sm rounded-full">{{ ucfirst($order->status) }}</span>
                        </p>
                        <p><span class="font-medium">Total:</span> Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                        <p><span class="font-medium">Date:</span> {{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>

                <!-- Customer Info -->
                <div>
                    <h3 class="text-lg font-semibold text-[#402A1E] mb-4">Customer Information</h3>
                    <div class="space-y-2">
                        <p><span class="font-medium">Name:</span> {{ $order->customer_name }}</p>
                        <p><span class="font-medium">Phone:</span> {{ $order->customer_phone }}</p>
                        <p><span class="font-medium">Address:</span> {{ $order->customer_address }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
            <h2 class="text-2xl font-[PlayfairDisplay] font-bold text-[#402A1E] mb-6">Order Items</h2>

            <div class="space-y-4">
                @foreach($order->orderItems as $item)
                    <div class="flex items-center justify-between py-4 border-b border-[#F6F1EA] last:border-b-0">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-[#F6F1EA] rounded-lg flex items-center justify-center">
                                <span class="text-[#BFA58A] font-semibold">{{ substr($item->product->name ?? 'Item', 0, 2) }}</span>
                            </div>
                            <div>
                                <h3 class="font-[PlayfairDisplay] font-bold text-[#402A1E]">{{ $item->product->name ?? 'Product' }}</h3>
                                <p class="text-[#7AA374]">Quantity: {{ $item->quantity }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-bold text-[#7AA374]">Rp {{ number_format($item->line_total, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Actions -->
        <div class="text-center space-y-4">
            <a href="{{ route('menu') }}"
               class="inline-block px-8 py-3 bg-[#7AA374] text-white rounded-full font-semibold hover:bg-[#D98C8C] hover:shadow-xl transition-all duration-300">
                Order More Food
            </a>
            <p class="text-[#7AA374]">We'll send you updates about your order via WhatsApp</p>
        </div>
    </div>
</section>
@endsection
