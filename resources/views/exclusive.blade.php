<x-layoutCategories>
    {{-- CUSTOM CSS (Luxury Theme) --}}
    <style>
        .exclusive-hero {
            background-image: linear-gradient(135deg, rgba(23, 16, 7, 0.85) 0%, rgba(112, 85, 38, 0.65) 100%),
                url("{{ asset('images/products/thumbnail.jpg') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .card-luxe {
            border: 1px solid rgba(212, 175, 55, 0.35);
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.15);
            transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
        }

        .card-luxe:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.22);
            border-color: rgba(212, 175, 55, 0.65);
        }

        .pill-gold {
            background: linear-gradient(90deg, #f1d08a 0%, #d4af37 50%, #b5852b 100%);
            color: #2c1a0c;
        }

        .btn-gold {
            background: linear-gradient(90deg, #d4af37, #b07a2a);
            transition: opacity 0.3s;
        }

        .btn-gold:hover {
            opacity: 0.9;
        }
    </style>

    {{-- HERO SECTION --}}
    <div class="relative isolate px-6 pt-20 lg:px-20 h-[450px] exclusive-hero">
        <div class="w-full py-10 sm:py-12 lg:py-16 flex flex-col gap-5 text-white max-w-4xl">
            <div class="flex items-center gap-2 text-sm sm:text-base text-white/80"
                style="font-family: poppins, sans-serif;">
                <a href="/" class="hover:underline text-gray-300">Home</a>
                <span>/</span>
                <span>Exclusive</span>
            </div>

            <div class="space-y-3">
                <div class="inline-flex items-center gap-2 pill-gold px-4 py-1 rounded-full text-sm uppercase tracking-[0.25em]"
                    style="font-family: poppins, sans-serif;">
                    Signature Collection
                </div>
                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-light tracking-wide leading-tight"
                    style="font-family: cormorant, serif !important;">
                    EXCLUSIVE PERFUMES
                </h1>
                <p class="text-base sm:text-lg text-white/80 max-w-2xl" style="font-family: poppins, sans-serif;">
                    Kurasi parfum premium dengan sentuhan artisan, komposisi langka, dan finishing mewah untuk momen
                    paling istimewa.
                </p>
            </div>
        </div>
    </div>

    {{-- PRODUCT LIST SECTION --}}
    <div class="relative isolate px-6 pt-14 lg:px-20 min-h-screen py-10">
        <div class="w-full flex items-center justify-between py-4 border-b border-gray-200">
            <div class="flex items-center gap-3 text-black cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M6 12h12M10 18h4" />
                </svg>
                <button onclick="openFilter()" class="flex items-center gap-2 font-medium hover:text-gray-600">Filter
                    Products</button>
            </div>

            <div class="flex items-center gap-6 text-gray-700">
                <div class="relative">
                    <button onclick="toggleSortDropdown()" class="flex items-center gap-2 cursor-pointer">
                        <span id="sortLabel" class="text-base">Default sorting</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="sortDropdown"
                        class="hidden absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                        <ul class="py-2">
                            <li onclick="selectSort('Default sorting')"
                                class="px-4 py-2 hover:bg-gray-100 cursor-pointer transition">Default sorting</li>
                            <li onclick="selectSort('Sort by popularity')"
                                class="px-4 py-2 hover:bg-gray-100 cursor-pointer transition">Sort by popularity</li>
                            <li onclick="selectSort('Sort by latest')"
                                class="px-4 py-2 hover:bg-gray-100 cursor-pointer transition">Sort by latest</li>
                            <li onclick="selectSort('Sort by price: low to high')"
                                class="px-4 py-2 hover:bg-gray-100 cursor-pointer transition">Sort by price: low to high
                            </li>
                            <li onclick="selectSort('Sort by price: high to low')"
                                class="px-4 py-2 hover:bg-gray-100 cursor-pointer transition">Sort by price: high to low
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <svg id="gridView" onclick="toggleView('grid')" xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 cursor-pointer text-black" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 3h8v8H3V3zm10 0h8v8h-8V3zM3 13h8v8H3v-8zm10 0h8v8h-8v-8z" />
                    </svg>
                    <svg id="listView" onclick="toggleView('list')" xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 cursor-pointer text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4 6h16v2H4V6zm0 5h16v2H4v-2zm0 5h16v2H4v-2z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto mt-12">
            @if (isset($products) && $products->count() > 0)
                <div id="productsGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($products as $product)
                        <a href="/detailProduk/{{ $product->id }}" class="card-luxe bg-white rounded-xl overflow-hidden group block">
                            <div class="relative w-full h-64 overflow-hidden">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                        No Image
                                    </div>
                                @endif
                                <span
                                    class="absolute top-3 left-3 px-3 py-1 rounded-full text-xs uppercase tracking-wide pill-gold"
                                    style="font-family: poppins, sans-serif;">Exclusive</span>
                            </div>
                            <div class="p-5 space-y-2">
                                <h4 class="text-sm text-gray-500" style="font-family: cormorant, serif !important;">
                                    {{ $product->category->name ?? 'Exclusive' }}</h4>
                                <h3 class="text-2xl font-semibold text-gray-900 truncate"
                                    style="font-family: cormorant, serif !important;">{{ $product->name }}</h3>
                                <p class="text-gray-700 text-lg" style="font-family: poppins, sans-serif !important;">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</p>
                                <div class="flex items-center justify-between pt-2">
                                    <span class="text-sm text-gray-500 italic">Limited release</span>
                                    <button class="px-4 py-2 rounded-full text-sm font-semibold text-white btn-gold">
                                        View details
                                    </button>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div id="productsList" class="hidden space-y-4">
                    @foreach ($products as $product)
                        <a href="/detailProduk/{{ $product->id }}" class="card-luxe bg-white rounded-xl overflow-hidden flex flex-col sm:flex-row group block">
                            <div class="relative w-full sm:w-48 h-48 overflow-hidden flex-shrink-0">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                        No Image
                                    </div>
                                @endif
                            </div>

                            <div class="p-4 sm:p-6 flex flex-col justify-center flex-grow gap-2">
                                <div class="flex items-center gap-3">
                                    <span class="px-3 py-1 rounded-full text-xs uppercase tracking-wide pill-gold"
                                        style="font-family: poppins, sans-serif;">Exclusive</span>
                                    <span class="text-xs sm:text-sm text-gray-500"
                                        style="font-family: poppins, sans-serif;">{{ $product->category->name ?? 'Exclusive' }}</span>
                                </div>
                                <h3 class="text-2xl font-semibold text-gray-900"
                                    style="font-family: cormorant, serif !important;">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-base sm:text-lg text-gray-700"
                                    style="font-family: poppins, sans-serif !important;">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                                <div class="flex items-center justify-between pt-1">
                                    <span class="text-sm text-gray-500 italic">Limited release</span>
                                    <button class="px-4 py-2 rounded-full text-sm font-semibold text-white btn-gold">
                                        View details
                                    </button>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20">
                    <p class="text-gray-500 text-lg">Belum ada produk Exclusive.</p>
                </div>
            @endif
        </div>
    </div>

    <div id="overlay"
        class="fixed inset-0 bg-black/40 opacity-0 pointer-events-none transition-opacity duration-300 z-40"></div>

    <div id="filterSidebar"
        class="fixed top-0 left-0 h-full w-[360px] bg-white -translate-x-full transition-transform duration-300 ease-in-out z-50 overflow-y-auto">
        <div class="flex justify-end p-4"><button onclick="closeFilter()" class="text-2xl">&times;</button></div>
        <div class="px-6">
            <div class="flex border">
                <input type="text" placeholder="Search products..." class="w-full px-4 py-2 outline-none">
                <button class="bg-black text-white px-4">&gt;</button>
            </div>
        </div>

        <div class="px-6 mt-10">
            <h2 class="text-4xl font-light mb-6" style="font-family: 'Playfair Display', serif;">Filter by<br>price
            </h2>
            <div class="relative h-2 bg-gray-200 rounded-full mb-6">
                <div id="priceRangeFill" class="absolute inset-y-0 bg-black rounded-full"></div>
                <div id="priceMinHandle"
                    class="absolute -top-2 w-6 h-6 bg-black rounded-full -translate-x-1/2 cursor-pointer"></div>
                <div id="priceMaxHandle"
                    class="absolute -top-2 w-6 h-6 bg-black rounded-full -translate-x-1/2 cursor-pointer"></div>
                <input id="priceMinRange" type="range" min="0" max="500" value="199"
                    step="1" class="absolute inset-0 w-full h-6 opacity-0 cursor-pointer z-30">
                <input id="priceMaxRange" type="range" min="0" max="500" value="375"
                    step="1" class="absolute inset-0 w-full h-6 opacity-0 cursor-pointer z-20">
            </div>
            <div class="flex gap-4">
                <div class="border px-4 py-2" id="priceMinLabel">Rp 199.000</div>
                <div class="border px-4 py-2" id="priceMaxLabel">Rp 375.000</div>
            </div>
            <div class="flex justify-between text-sm mt-2 text-gray-500">
                <span>Min. Price</span>
                <span>Max. Price</span>
            </div>
        </div>

        <div class="px-6 mt-14">
            <h3 class="text-xl mb-6 tracking-widest">FILTER BY CATEGORY</h3>
            <ul class="space-y-3 font-semibold">
                <li class="cursor-pointer">Exclusive</li>
                <li class="cursor-pointer">Men</li>
                <li class="cursor-pointer">Women</li>
                <li class="cursor-pointer">Unisex</li>
            </ul>
        </div>
    </div>
</x-layoutCategories>
