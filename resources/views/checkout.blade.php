@extends('layouts.app')

@section('content')
<section class="py-24 bg-[#F6F1EA]">
    <div class="max-w-4xl mx-auto px-6">

        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-[PlayfairDisplay] font-bold text-[#402A1E] mb-4">Checkout</h1>
            <p class="text-[#7AA374] text-lg">Complete your order and choose your preferred payment method</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            <!-- Order Summary -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-2xl font-[PlayfairDisplay] font-bold text-[#402A1E] mb-6">Order Summary</h2>

                <div class="space-y-4 mb-6">
                    @foreach(session('cart', []) as $item)
                    <div class="flex justify-between items-center py-3 border-b border-[#F6F1EA]">
                        <div>
                            <h3 class="font-semibold text-[#402A1E]">{{ $item['name'] }}</h3>
                            <p class="text-[#BFA58A] text-sm">Qty: {{ $item['qty'] }}</p>
                        </div>
                        <p class="font-semibold text-[#7AA374]">Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</p>
                    </div>
                    @endforeach
                </div>

                <div class="border-t border-[#BFA58A] pt-4">
                    <div class="flex justify-between font-bold text-xl text-[#402A1E]">
                        <span>Total</span>
                        <span>Rp {{ number_format(array_sum(array_map(fn($i) => $i['price'] * $i['qty'], session('cart', []))), 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Payment Form -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-2xl font-[PlayfairDisplay] font-bold text-[#402A1E] mb-6">Customer Information</h2>

                <form action="{{ route('checkout.process') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Customer Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[#402A1E] font-semibold mb-2">Full Name</label>
                            <input type="text" name="customer_name" required
                                   class="w-full px-4 py-3 rounded-lg border border-[#BFA58A] focus:ring-2 focus:ring-[#7AA374] focus:border-transparent"
                                   placeholder="Enter your full name">
                        </div>

                        <div>
                            <label class="block text-[#402A1E] font-semibold mb-2">Phone Number</label>
                            <input type="tel" name="customer_phone" required
                                   class="w-full px-4 py-3 rounded-lg border border-[#BFA58A] focus:ring-2 focus:ring-[#7AA374] focus:border-transparent"
                                   placeholder="Enter your phone number">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[#402A1E] font-semibold mb-2">Delivery Address</label>
                        <textarea name="customer_address" required rows="3"
                                  class="w-full px-4 py-3 rounded-lg border border-[#BFA58A] focus:ring-2 focus:ring-[#7AA374] focus:border-transparent"
                                  placeholder="Enter your delivery address"></textarea>
                    </div>

                    <!-- Payment Method -->
                    <div>
                        <label class="block text-[#402A1E] font-semibold mb-4">Payment Method</label>

                        <div class="space-y-3">
                            <!-- COD -->
                            <label class="flex items-center p-4 border border-[#BFA58A] rounded-lg cursor-pointer hover:bg-[#F6F1EA] transition-colors">
                                <input type="radio" name="payment_method" value="cod" class="mr-3" checked>
                                <div>
                                    <div class="font-semibold text-[#402A1E]">Cash on Delivery (COD)</div>
                                    <div class="text-sm text-[#BFA58A]">Pay when your order arrives</div>
                                </div>
                            </label>

                            <!-- Bank Transfer -->
                            <label class="flex items-center p-4 border border-[#BFA58A] rounded-lg cursor-pointer hover:bg-[#F6F1EA] transition-colors">
                                <input type="radio" name="payment_method" value="bank_transfer" class="mr-3">
                                <div>
                                    <div class="font-semibold text-[#402A1E]">Bank Transfer</div>
                                    <div class="text-sm text-[#BFA58A]">Transfer to our bank account</div>
                                </div>
                            </label>

                            <!-- Midtrans (Online Payment) -->
                            <label class="flex items-center p-4 border border-[#7AA374] rounded-lg cursor-pointer hover:bg-[#F6F1EA] transition-colors bg-[#F6F1EA]/50">
                                <input type="radio" name="payment_method" value="midtrans" class="mr-3">
                                <div>
                                    <div class="font-semibold text-[#402A1E]">Online Payment (Midtrans)</div>
                                    <div class="text-sm text-[#BFA58A]">Secure online payment with various options</div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                            class="w-full bg-[#7AA374] text-white py-4 px-6 rounded-lg font-semibold text-lg
                                   hover:bg-[#D98C8C] transition-all duration-300 hover:scale-105
                                   focus:ring-2 focus:ring-[#7AA374] focus:ring-offset-2 shadow-lg">
                        Place Order
                    </button>
                </form>
            </div>

        </div>

    </div>
</section>
@endsection
