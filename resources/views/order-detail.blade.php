<x-layouts.main>

{{-- Order Header --}}
<section class="py-16 bg-[#FFF7F1]">
    <div class="max-w-5xl mx-auto px-6">
        <h1 class="text-4xl font-extrabold text-gray-900">
            Order Detail #{{ $id }}
        </h1>
        <p class="text-gray-600 mt-2">Rincian pesanan pelanggan</p>
    </div>
</section>

{{-- Order Content --}}
<section class="py-16">
    <div class="max-w-5xl mx-auto px-6 grid md:grid-cols-3 gap-10">

        {{-- Left: Customer Info --}}
        <div class="md:col-span-2 bg-white p-8 rounded-2xl shadow-lg">
            <h2 class="text-2xl font-bold mb-6">Customer Information</h2>

            <div class="space-y-5">
                <p><span class="font-semibold">Name:</span> John Doe</p>
                <p><span class="font-semibold">Phone:</span> +62 812-3456-7890</p>
                <p><span class="font-semibold">Address:</span> JL. Melati No. 12, Bogor</p>
                <p><span class="font-semibold">Note:</span> Extra sambal, jangan pedas</p>
            </div>

            <hr class="my-8">

            {{-- Order Items --}}
            <h2 class="text-2xl font-bold mb-6">Order Items</h2>

            <div class="space-y-8">

                {{-- Item 1 --}}
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <img src="/images/dish1.png" class="w-20 h-20 rounded-lg">
                        <div>
                            <h3 class="font-semibold text-lg">Beef Steak Premium</h3>
                            <p class="text-gray-600 text-sm">Qty: 1</p>
                        </div>
                    </div>
                    <p class="font-bold text-orange-600 text-lg">Rp 72.000</p>
                </div>

                {{-- Item 2 --}}
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <img src="/images/dish1.png" class="w-20 h-20 rounded-lg">
                        <div>
                            <h3 class="font-semibold text-lg">Milkshake Strawberry</h3>
                            <p class="text-gray-600 text-sm">Qty: 2</p>
                        </div>
                    </div>
                    <p class="font-bold text-orange-600 text-lg">Rp 36.000</p>
                </div>

            </div>

            <hr class="my-8">

            {{-- Total --}}
            <div class="text-right">
                <p class="text-lg">Subtotal: <span class="font-bold">Rp 108.000</span></p>
                <p class="text-lg">Delivery: <span class="font-bold">Rp 10.000</span></p>
                <p class="text-2xl font-extrabold mt-3 text-orange-600">Total: Rp 118.000</p>
            </div>
        </div>

        {{-- Right: Order Status --}}
        <div class="bg-white p-8 rounded-2xl shadow-lg h-fit">
            <h2 class="text-2xl font-bold mb-6">Order Status</h2>

            <div class="space-y-4">
                <p><span class="font-semibold">Status:</span> <span class="text-orange-600">Processing</span></p>
                <p><span class="font-semibold">Payment:</span> Paid</p>
                <p><span class="font-semibold">Method:</span> Cashless</p>
                <p><span class="font-semibold">Estimated Time:</span> 20–30 minutes</p>
            </div>

            <button
                class="w-full mt-6 bg-orange-600 text-white py-3 rounded-xl hover:bg-orange-700 transition">
                Mark as Completed
            </button>
        </div>

    </div>
</section>

</x-layouts.main>
