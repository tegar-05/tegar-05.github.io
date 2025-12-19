@extends('layouts.app')

@section('title', 'Shopping Cart - Madame Djeli')

@section('content')
<section class="py-24 bg-[#F6F1EA] min-h-screen">
    <div class="max-w-6xl mx-auto px-6">

        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-[PlayfairDisplay] font-bold text-[#402A1E] mb-4">Shopping Cart</h1>
            <p class="text-[#7AA374] text-lg">Review your items and proceed to checkout</p>
        </div>

        @if(empty(session('cart', [])))
            <!-- Empty Cart -->
            <div class="text-center py-16">
                <div class="w-24 h-24 mx-auto mb-6 bg-[#F6F1EA] rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-[#BFA58A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-[PlayfairDisplay] font-bold text-[#402A1E] mb-4">Your cart is empty</h2>
                <p class="text-[#7AA374] mb-8">Add some delicious items to get started!</p>
                <a href="{{ route('menu') }}"
                   class="inline-block px-8 py-3 bg-[#7AA374] text-white rounded-full font-semibold hover:bg-[#D98C8C] hover:shadow-xl transition-all duration-300">
                    Browse Menu
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Cart Items -->
                <div class="lg:col-span-2 space-y-6">
                    @foreach(session('cart', []) as $key => $item)
                        <div class="bg-white rounded-2xl shadow-lg p-6">
                            <div class="flex items-center space-x-4">
                                <!-- Product Image -->
                                <div class="w-20 h-20 bg-[#F6F1EA] rounded-lg flex items-center justify-center">
                                    <span class="text-[#BFA58A] font-semibold">{{ substr($item['name'], 0, 2) }}</span>
                                </div>

                                <!-- Product Details -->
                                <div class="flex-1">
                                    <h3 class="text-lg font-[PlayfairDisplay] font-bold text-[#402A1E]">{{ $item['name'] }}</h3>
                                    <p class="text-[#7AA374] font-semibold">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                                </div>

                                <!-- Quantity Controls -->
                                <div class="flex items-center space-x-3">
                                    <form method="POST" action="{{ route('cart.update', $key) }}" class="flex items-center space-x-2">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" name="action" value="decrease"
                                                class="w-8 h-8 bg-[#F6F1EA] rounded-full flex items-center justify-center hover:bg-[#7AA374] hover:text-white transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                            </svg>
                                        </button>
                                        <span class="w-8 text-center font-semibold text-[#402A1E]">{{ $item['qty'] }}</span>
                                        <button type="submit" name="action" value="increase"
                                                class="w-8 h-8 bg-[#F6F1EA] rounded-full flex items-center justify-center hover:bg-[#7AA374] hover:text-white transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>

                                <!-- Subtotal -->
                                <div class="text-right">
                                    <p class="text-lg font-bold text-[#7AA374]">Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</p>
                                </div>

                                <!-- Remove Button -->
                                <form method="POST" action="{{ route('cart.remove', $key) }}" class="ml-4">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center hover:bg-red-200 focus:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors"
                                            onclick="return confirm('Remove this item from cart?')">
                                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-6">
                        <h2 class="text-xl font-[PlayfairDisplay] font-bold text-[#402A1E] mb-6">Order Summary</h2>

                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-[#402A1E]">
                                <span>Subtotal ({{ count(session('cart', [])) }} items)</span>
                                <span>Rp {{ number_format(array_sum(array_map(fn($i) => $i['price'] * $i['qty'], session('cart', []))), 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-[#402A1E]">
                                <span>Delivery Fee</span>
                                <span>Free</span>
                            </div>
                        </div>

                        <div class="border-t border-[#F6F1EA] pt-4 mb-6">
                            <div class="flex justify-between text-xl font-bold text-[#402A1E]">
                                <span>Total</span>
                                <span>Rp {{ number_format(array_sum(array_map(fn($i) => $i['price'] * $i['qty'], session('cart', []))), 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <a href="{{ route('checkout') }}"
                           class="w-full block text-center py-4 bg-[#7AA374] text-white rounded-full font-semibold hover:bg-[#D98C8C] hover:shadow-xl transition-all duration-300">
                            Proceed to Checkout
                        </a>

                        <a href="{{ route('menu') }}"
                           class="w-full block text-center py-3 mt-3 bg-[#F6F1EA] text-[#402A1E] rounded-full font-semibold hover:bg-[#BFA58A] hover:text-white transition-all duration-300">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
