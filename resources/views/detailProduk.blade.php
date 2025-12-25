<x-layoutCategories>


    {{-- PRODUCT DETAIL SECTION --}}
    <div class="relative isolate px-6 lg:px-20 py-10 min-h-screen pt-30">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                {{-- LEFT: PRODUCT IMAGE --}}
                <div class="flex items-center justify-center">
                    @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                        class="w-full h-96 object-cover rounded-lg shadow-lg">
                    @else
                    <div class="w-full h-96 flex items-center justify-center bg-gray-200 rounded-lg text-gray-400">No
                        Image</div>
                    @endif
                </div>

                {{-- RIGHT: PRODUCT INFO --}}
                <div class="flex flex-col justify-center gap-3">
                    {{-- CATEGORY --}}
                    <div class="inline-flex w-fit">
                        <span class="text-xl uppercase tracking-widest text-gray-600"
                            style="font-family: poppins, sans-serif;">
                            {{ $product->category->name ?? 'General' }}
                        </span>
                    </div>

                    {{-- PRICE --}}
                    <div>
                        <p class="text-4xl font-light tracking-wide" style="font-family: cormorant, serif !important;">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                        <p class="text-sm text-gray-600 mt-2" style="font-family: poppins, sans-serif;">
                            In Stock: {{ $product->stock }} available
                        </p>
                    </div>

                    {{-- DESCRIPTION --}}
                    @if ($product->description)
                    <p class="text-gray-700 leading-relaxed text-base" style="font-family: poppins, sans-serif;">
                        {{ $product->description }}
                    </p>
                    @else
                    <p class="text-gray-600 text-base" style="font-family: poppins, sans-serif;">
                        Premium fragrance crafted with the finest ingredients.
                    </p>
                    @endif

                    {{-- QUANTITY + ADD TO CART --}}
                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf

                        {{-- 🔥 WAJIB ADA INI: Biar Controller tau produk mana yang dibeli 🔥 --}}
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="flex items-center gap-4 py-6 border-t border-b">
                            <div class="flex border rounded-md overflow-hidden">
                                <button type="button" onclick="decrementQty()" class="px-4 py-2 hover:bg-gray-100">−</button>

                                {{-- Pastikan name="quantity" ada --}}
                                <input id="quantityInput" type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                                    class="w-16 text-center border-x focus:outline-none" readonly>

                                <button type="button" onclick="incrementQty()" class="px-4 py-2 hover:bg-gray-100">+</button>
                            </div>

                            <button type="submit"
                                class="flex-1 bg-black text-white py-3 uppercase tracking-widest text-sm font-semibold hover:bg-gray-800 transition">
                                Add to Cart
                            </button>
                        </div>
                    </form>

                    {{-- FEATURES --}}
                    <ul class="space-y-3 text-sm text-gray-700" style="font-family: poppins, sans-serif;">
                        <li class="flex items-center gap-2">✓ <span>Premium Quality</span></li>
                        <li class="flex items-center gap-2">✓ <span>Free Shipping on Orders Over Rp 500,000</span></li>
                        <li class="flex items-center gap-2">✓ <span>30-Day Money Back Guarantee</span></li>
                        <li class="flex items-center gap-2">✓ <span>Secure Payment</span></li>
                    </ul>
                </div>
            </div>

            {{-- DETAILED DESCRIPTION SECTION --}}
            <div class="mt-16 pt-12 border-t">
                <div class="max-w-3xl">
                    <h3 class="text-2xl font-light tracking-wide mb-6"
                        style="font-family: cormorant, serif !important;">
                        About This Fragrance
                    </h3>
                    <div class="space-y-4 text-gray-700 leading-relaxed" style="font-family: poppins, sans-serif;">
                        @if ($product->description)
                        <p>{{ $product->description }}</p>
                        @endif
                        <p>
                            Discover the perfect scent for your personality. Our premium fragrance collection is crafted
                            with the finest ingredients sourced from around the world.
                            Each perfume tells a unique story and evokes a special memory or emotion.
                        </p>
                        <p>
                            Whether you're looking for something fresh and light, warm and woody, or floral and elegant,
                            we have the perfect aroma to match your style.
                            Our expert blenders have created these fragrances to last all day with just a few spritzes.
                        </p>
                    </div>


                </div>
            </div>

            {{-- RELATED PRODUCTS SECTION --}}
            <div class="mt-20 pt-12 border-t">
                <h2 class="text-3xl font-light tracking-wide mb-8" style="font-family: cormorant, serif !important;">You
                    May Also Like</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @php
                    $related = \App\Models\Product::where('id', '!=', $product->id)
                    ->with('category')
                    ->limit(4)
                    ->get();
                    @endphp
                    @forelse($related as $item)
                    <a href="/detailProduk/{{ $item->id }}"
                        class="bg-white rounded-lg shadow-md hover:shadow-lg transition overflow-hidden group">
                        <div class="relative h-56 overflow-hidden">
                            @if ($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition">
                            @else
                            <div
                                class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                                No Image</div>
                            @endif
                        </div>
                        <div class="p-4">
                            <p class="text-xs text-gray-500 mb-1" style="font-family: poppins, sans-serif;">
                                {{ $item->category->name ?? 'General' }}
                            </p>
                            <h3 class="font-semibold text-gray-900 mb-2 truncate"
                                style="font-family: cormorant, serif !important;">{{ $item->name }}</h3>
                            <p class="text-sm font-medium text-gray-800" style="font-family: poppins, sans-serif;">
                                Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                    </a>
                    @empty
                    <p class="col-span-4 text-center text-gray-500">No related products available.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- FLOATING BACK BUTTON --}}
    <div class="fixed bottom-8 right-8 z-40">
        <a href="/buy" class="flex items-center justify-center w-14 h-14 rounded-full bg-black text-white shadow-lg hover:bg-gray-800 transition-all duration-300 hover:scale-110" title="Back to Products">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
    </div>

    <script>
        const maxStock = {
            {
                $product - > stock
            }
        };

        function incrementQty() {
            const input = document.getElementById('quantityInput');
            let currentValue = parseInt(input.value);
            if (currentValue < maxStock) {
                input.value = currentValue + 1;
            }
        }

        function decrementQty() {
            const input = document.getElementById('quantityInput');
            let currentValue = parseInt(input.value);
            if (currentValue > 1) {
                input.value = currentValue - 1;
            }
        }
    </script>
</x-layoutCategories>