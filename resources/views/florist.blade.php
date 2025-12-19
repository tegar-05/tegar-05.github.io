@extends('layouts.app')

@section('content')

<section class="py-24 bg-[#F6F1EA]">
    <div class="max-w-7xl mx-auto px-6">

        <!-- Header -->
        <div class="text-center mb-16">
            <h1 class="text-5xl font-[PlayfairDisplay] font-bold text-[#402A1E] mb-4">Floral Artistry Collection</h1>
            <p class="text-[#7AA374] text-lg">Curated floral arrangements crafted with elegance, precision, and a modern romantic touch</p>
        </div>

        <!-- Florist Items Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse($florists as $florist)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl hover:-translate-y-2 transform transition-all duration-300 relative">
                    <!-- Florist Image -->
                    <div class="relative overflow-hidden">
                        <img src="{{ $florist->image ? asset('storage/' . $florist->image) : asset('images/placeholder.jpg') }}"
                             class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500"
                             alt="{{ $florist->name }}" loading="lazy">

                        <!-- Hover Overlay with Add to Cart -->
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                            <button class="bg-[#7AA374] text-white px-8 py-4 rounded-full opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:bg-[#D98C8C] hover:shadow-xl focus:ring-2 focus:ring-[#7AA374] focus:ring-offset-2"
                                    aria-label="Add {{ $florist->name }} to cart">
                                Add to Cart
                            </button>
                        </div>
                    </div>

                    <!-- Florist Info -->
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-[PlayfairDisplay] font-bold text-[#402A1E]">{{ $florist->name }}</h3>
                            <span class="text-[#7AA374] font-bold text-lg">Rp {{ number_format($florist->price, 0, ',', '.') }}</span>
                        </div>

                        @if($florist->description)
                            <p class="text-[#402A1E] text-sm mb-4 line-clamp-2">{{ $florist->description }}</p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <div class="max-w-md mx-auto">
                        <div class="w-24 h-24 mx-auto mb-4 bg-[#F6F1EA] rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-[#BFA58A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-[PlayfairDisplay] font-bold text-[#402A1E] mb-2">Coming Soon</h3>
                        <p class="text-[#7AA374] text-sm">Our floral collection is being prepared with care. Check back soon for beautiful arrangements.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- CTA Section -->
        @if($florists->count() > 0)
        <div class="text-center mt-16">
            <div class="bg-white rounded-2xl shadow-lg p-8 max-w-2xl mx-auto">
                <h3 class="text-2xl font-[PlayfairDisplay] font-bold text-[#402A1E] mb-4">Custom Arrangements Available</h3>
                <p class="text-[#7AA374] mb-6">Need something special? Contact us for custom floral designs tailored to your occasion.</p>
                <a href="{{ route('contact') }}"
                   class="inline-block px-8 py-4 bg-[#7AA374] text-white rounded-full font-semibold hover:bg-[#D98C8C] hover:shadow-xl transition-all duration-300 hover:scale-105">
                    Contact Us
                </a>
            </div>
        </div>
        @endif
    </div>
</section>

@endsection
