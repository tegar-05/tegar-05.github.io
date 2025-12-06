@section('content')

<section class="py-24 bg-white">
    <div class="max-w-6xl mx-auto text-center mb-16">
        <h2 class="text-4xl font-bold mb-4 animate-fade-in">Menu Kami</h2>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-12 max-w-6xl mx-auto px-6">
        @foreach ([
            ['name'=>'Wagyu Steak','price'=>'145.000','img'=>'/images/food1.jpg'],
            ['name'=>'Grilled Salmon','price'=>'98.000','img'=>'/images/food2.jpg'],
            ['name'=>'Chicken Rice','price'=>'42.000','img'=>'/images/food3.jpg']
        ] as $menu)
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl hover:-translate-y-1 transform transition-all duration-300 animate-fade-in">
            <img src="{{ $menu['img'] }}" class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-500">
            <div class="p-6">
                <h3 class="text-xl font-bold mb-1">{{ $menu['name'] }}</h3>
                <p class="text-yellow-700 font-semibold text-lg mb-4">Rp {{ $menu['price'] }}</p>
                <a href="/order" class="block w-full py-3 bg-yellow-600 hover:bg-yellow-700 rounded-xl text-white font-semibold transition shadow hover:shadow-2xl hover:-translate-y-1 transform">
                    Order Sekarang
                </a>
            </div>
        </div>
        @endforeach
    </div>
</section>

@endsection
=======
@extends('layouts.app')

@section('content')

<section class="py-24 bg-[#F6F1EA]">
    <div class="max-w-7xl mx-auto px-6">

        <!-- Header -->
        <div class="text-center mb-16">
            <h1 class="text-5xl font-[PlayfairDisplay] font-bold text-[#402A1E] mb-4">Our Menu</h1>
            <p class="text-[#7AA374] text-lg">Discover our curated selection of premium coffee, beverages, desserts, and floral arrangements</p>
        </div>

        <!-- Filters and Search -->
        <div class="mb-12">
            <form method="GET" action="{{ route('menu') }}" class="flex flex-col md:flex-row gap-4 justify-center items-center mb-8">
                <!-- Search -->
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..."
                           class="px-4 py-3 pl-12 rounded-full border border-[#BFA58A] bg-white focus:ring-2 focus:ring-[#7AA374] focus:border-transparent w-80">
                    <svg class="absolute left-4 top-3.5 h-5 w-5 text-[#BFA58A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>

                <!-- Category Filter -->
                <select name="category" onchange="this.form.submit()"
                        class="px-6 py-3 rounded-full border border-[#BFA58A] bg-white focus:ring-2 focus:ring-[#7AA374] focus:border-transparent">
                    <option value="all" {{ request('category') == 'all' || !request('category') ? 'selected' : '' }}>All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
            </form>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse($products as $product)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl hover:-translate-y-2 transform transition-all duration-300 relative">
                    <!-- Product Image -->
                    <div class="relative overflow-hidden">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/placeholder.jpg') }}"
                             class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500"
                             alt="{{ $product->name }}" loading="lazy">

                        <!-- Hover Overlay with Add to Cart -->
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                            <button class="bg-[#7AA374] text-white px-6 py-3 rounded-full opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:bg-[#D98C8C] focus:ring-2 focus:ring-[#7AA374] focus:ring-offset-2"
                                    aria-label="Add {{ $product->name }} to cart">
                                Add to Cart
                            </button>
                        </div>

                        <!-- Signature Badge -->
                        @if($product->is_signature)
                            <div class="absolute top-3 left-3 bg-[#D98C8C] text-white px-3 py-1 rounded-full text-xs font-semibold">
                                Signature
                            </div>
                        @endif

                        <!-- Flores Badge -->
                        @if($product->is_flores)
                            <div class="absolute top-3 right-3 bg-[#D98C8C] text-white px-3 py-1 rounded-full text-xs font-semibold">
                                Flores
                            </div>
                        @endif
                    </div>

                    <!-- Product Info -->
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-[PlayfairDisplay] font-bold text-[#402A1E]">{{ $product->name }}</h3>
                            <span class="text-[#7AA374] font-bold text-lg">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </div>

                        @if($product->description)
                            <p class="text-[#402A1E] text-sm mb-4 line-clamp-2">{{ $product->description }}</p>
                        @endif

                        <div class="flex items-center justify-between">
                            <span class="text-xs text-[#BFA58A] bg-[#F6F1EA] px-3 py-1 rounded-full">{{ $product->category }}</span>
                            <span class="text-xs text-[#BFA58A]">{{ $product->sold }} sold</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-[#402A1E] text-lg">No products found matching your criteria.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($products->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $products->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</section>

@endsection
