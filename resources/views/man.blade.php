<x-layoutCategories>
    {{-- HERO SECTION --}}
    <style>
        .hero-bg-man {
            background-image: linear-gradient(135deg, rgba(43, 50, 90, 0.7) 0%, rgba(0, 0, 0, 0.5) 100%),
                url("{{ asset('images/products/thumbnail.jpg') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
    <div class="relative isolate px-6 pt-20 lg:px-20 h-[400px] hero-bg-man">
        <div class="w-full py-6 sm:py-8 lg:py-16 flex flex-col gap-4 text-white">
            <div class="flex items-center gap-2 text-sm sm:text-base text-gray-200"
                style="font-family: poppins, sans-serif;">
                <a href="/" class="hover:underline text-gray-300">Home</a>
                <span class="text-gray-400">/</span>
                <span class="text-white">Men</span>
            </div>

            <h1 class="text-5xl sm:text-6xl lg:text-7xl font-light tracking-wide text-white"
                style="font-family: cormorant, serif !important;">
                MEN
            </h1>
        </div>
    </div>

    {{-- PRODUCT LIST --}}
    <div class="relative isolate px-6 pt-14 lg:px-20 min-h-screen py-10">
        {{-- Toolbar sama seperti kodingan asli --}}
        <div class="w-full flex items-center justify-between py-4 border-b border-gray-200">
            <div class="flex items-center gap-3 text-black cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M6 12h12M10 18h4" />
                </svg>
                <button onclick="openFilter()" class="flex items-center gap-2 font-medium hover:text-gray-600">Filter
                    Products</button>
            </div>
            {{-- Bagian Sort (Hanya UI) --}}
            <div class="flex items-center gap-6 text-gray-700">
                <div class="relative">
                    <button onclick="toggleSortDropdown()" class="flex items-center gap-2 cursor-pointer text-base">
                        @php
                            $sortLabel = 'Default sorting';
                            $sort = request('sort');
                            if ($sort === 'price_asc') {
                                $sortLabel = 'Sort by price: low to high';
                            } elseif ($sort === 'price_desc') {
                                $sortLabel = 'Sort by price: high to low';
                            } elseif ($sort === 'name_asc') {
                                $sortLabel = 'Sort by name: A-Z';
                            } elseif ($sort === 'name_desc') {
                                $sortLabel = 'Sort by name: Z-A';
                            } elseif ($sort === 'latest') {
                                $sortLabel = 'Sort by latest';
                            }
                        @endphp
                        <span id="sortLabel">{{ $sortLabel }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="sortDropdown"
                        class="hidden absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                        <ul class="py-2">
                            {{-- Modifikasi Sorting: Value harus sesuai dengan controller --}}
                            <li onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort' => null]) }}'"
                                class="px-4 py-2 hover:bg-gray-100 cursor-pointer transition border-b border-gray-50">
                                Default sorting</li>
                            <li onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}'"
                                class="px-4 py-2 hover:bg-gray-100 cursor-pointer transition">Sort by price: low to high
                            </li>
                            <li onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}'"
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
                <div id="productsGrid" class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach ($products as $product)
                        <a href="/detailProduk/{{ $product->id }}"
                            class="bg-white rounded-lg shadow-xl ring-1 ring-black/5 overflow-hidden transition hover:shadow-2xl block group p-2">
                            <div class="relative w-full h-64 overflow-hidden">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                @else
                                    <div
                                        class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400 text-xs">
                                        No Image</div>
                                @endif
                            </div>
                            <div class="pt-2">
                                <h4 class="text-xs text-gray-500 mb-1">{{ $product->category->name ?? 'Men' }}</h4>
                                <h3 class="text-base font-semibold text-gray-900 truncate">{{ $product->name }}</h3>
                                <p class="text-xs text-gray-600 mt-1">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div id="productsList" class="hidden space-y-4">
                    @foreach ($products as $product)
                        <a href="/detailProduk/{{ $product->id }}"
                            class="card-luxe bg-white rounded-xl shadow-xl ring-1 ring-black/5 overflow-hidden flex flex-col sm:flex-row group block hover:shadow-2xl transition">
                            <div class="relative w-full sm:w-48 h-48 overflow-hidden flex-shrink-0">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                        No Image</div>
                                @endif
                            </div>
                            <div class="p-4 sm:p-6 flex flex-col justify-center flex-grow gap-2">
                                <div class="flex items-center gap-3">
                                    <span class="px-3 py-1 rounded-full text-xs uppercase tracking-wide pill-gold"
                                        style="font-family: poppins, sans-serif;">Exclusive</span>
                                    <span
                                        class="text-xs sm:text-sm text-gray-500">{{ $product->category->name ?? 'Exclusive' }}</span>
                                </div>
                                <h3 class="text-2xl font-semibold text-gray-900"
                                    style="font-family: cormorant, serif !important;">{{ $product->name }}</h3>
                                <p class="text-base sm:text-lg text-gray-700">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                                <div class="flex items-center justify-between pt-1">
                                    <span class="text-sm text-gray-500 italic">Limited release</span>
                                    <button
                                        class="px-4 py-2 rounded-full text-sm font-semibold text-white btn-gold">View
                                        details</button>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <!-- Pagination -->
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @else
                <div class="text-center py-20 text-gray-500">Belum ada produk untuk kategori ini. <br> <a
                        href="{{ request()->url() }}" class="underline text-black">Reset Filter</a></div>
            @endif
        </div>
    </div>



    {{-- PRODUCT LIST SECTION --}}
    <div class="relative isolate px-6 pt-14 lg:px-20 min-h-screen py-10">
        <div class="w-full flex items-center justify-between py-4 border-b border-gray-200">
            <div class="flex items-center gap-3 text-black cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M6 12h12M10 18h4" />
                </svg>
                <button onclick="openFilter()" class="flex items-center gap-2 font-medium hover:text-gray-600">Filter
                    Products</button>
            </div>
            <div class="flex items-center gap-6 text-gray-700">
                <div class="relative">
                    <button onclick="toggleSortDropdown()" class="flex items-center gap-2 cursor-pointer">
                        @php
                            $sortLabel = 'Default sorting';
                            $sort = request('sort');
                            if ($sort === 'price_asc') {
                                $sortLabel = 'Sort by price: low to high';
                            } elseif ($sort === 'price_desc') {
                                $sortLabel = 'Sort by price: high to low';
                            } elseif ($sort === 'name_asc') {
                                $sortLabel = 'Sort by name: A-Z';
                            } elseif ($sort === 'name_desc') {
                                $sortLabel = 'Sort by name: Z-A';
                            } elseif ($sort === 'latest') {
                                $sortLabel = 'Sort by latest';
                            }
                        @endphp
                        <span id="sortLabel" class="text-base">{{ $sortLabel }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="sortDropdown"
                        class="hidden absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                        <ul class="py-2">
                            {{-- Modifikasi Sorting: Value harus sesuai dengan controller --}}
                            <li onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort' => null]) }}'"
                                class="px-4 py-2 hover:bg-gray-100 cursor-pointer transition border-b border-gray-50">
                                Default sorting</li>
                            <li onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}'"
                                class="px-4 py-2 hover:bg-gray-100 cursor-pointer transition">Sort by price: low to
                                high
                            </li>
                            <li onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}'"
                                class="px-4 py-2 hover:bg-gray-100 cursor-pointer transition">Sort by price: high to
                                low
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




        {{-- PRODUCTS CONTAINER --}}
        <div class="max-w-7xl mx-auto mt-12">
            @if (isset($products) && $products->count() > 0)
                <div id="productsGrid" class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach ($products as $product)
                        <a href="/detailProduk/{{ $product->id }}"
                            class="bg-white rounded-lg shadow-md overflow-hidden transition hover:shadow-xl group block p-2">
                            <div class="w-full h-64 overflow-hidden relative">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400 text-xs">
                                        No Image</div>
                                @endif
                            </div>
                            <div class="pt-2">
                                <h4 class="text-xs text-gray-500 mb-1"
                                    style="font-family: cormorant, serif !important;">
                                    {{ $product->category->name ?? 'Women' }}</h4>
                                <h3 class="text-base font-semibold text-gray-900 truncate"
                                    style="font-family: cormorant, serif !important;">{{ $product->name }}</h3>
                                <p class="text-xs text-gray-600 mt-1"
                                    style="font-family: poppins, sans-serif !important;">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Pagination -->


                <div id="productsList" class="hidden space-y-4">
                    @foreach ($products as $product)
                        <a href="/detailProduk/{{ $product->id }}"
                            class="bg-white rounded-lg shadow-lg overflow-hidden transition hover:shadow-xl flex flex-col sm:flex-row group block">
                            <div class="w-full sm:w-48 h-48 overflow-hidden flex-shrink-0">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                        No Image</div>
                                @endif
                            </div>
                            <div class="p-4 sm:p-6 flex flex-col justify-center flex-grow">
                                <h4 class="text-xs sm:text-sm text-gray-500 mb-1 sm:mb-2"
                                    style="font-family: cormorant, serif !important;">
                                    {{ $product->category->name ?? 'Women' }}</h4>
                                <h3 class="text-xl sm:text-2xl font-semibold text-gray-900 mb-2 sm:mb-3"
                                    style="font-family: cormorant, serif !important;">{{ $product->name }}</h3>
                                <p class="text-base sm:text-lg text-gray-600"
                                    style="font-family: poppins, sans-serif !important;">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div id="productsList" class="hidden space-y-4">
                    @foreach ($products as $product)
                        <a href="/detailProduk/{{ $product->id }}"
                            class="card-luxe bg-white rounded-xl overflow-hidden flex flex-col sm:flex-row group block">
                            <div class="relative w-full sm:w-48 h-48 overflow-hidden flex-shrink-0">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                        No Image</div>
                                @endif
                            </div>
                            <div class="p-4 sm:p-6 flex flex-col justify-center flex-grow gap-2">
                                <div class="flex items-center gap-3">
                                    <span class="px-3 py-1 rounded-full text-xs uppercase tracking-wide pill-gold"
                                        style="font-family: poppins, sans-serif;">Exclusive</span>
                                    <span
                                        class="text-xs sm:text-sm text-gray-500">{{ $product->category->name ?? 'Exclusive' }}</span>
                                </div>
                                <h3 class="text-2xl font-semibold text-gray-900"
                                    style="font-family: cormorant, serif !important;">{{ $product->name }}</h3>
                                <p class="text-base sm:text-lg text-gray-700">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</p>
                                <div class="flex items-center justify-between pt-1">
                                    <span class="text-sm text-gray-500 italic">Limited release</span>
                                    <button
                                        class="px-4 py-2 rounded-full text-sm font-semibold text-white btn-gold">View
                                        details</button>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div id="productsList" class="hidden space-y-4">
                    @foreach ($products as $product)
                        <a href="/detailProduk/{{ $product->id }}"
                            class="card-luxe bg-white rounded-xl overflow-hidden flex flex-col sm:flex-row group block">
                            <div class="relative w-full sm:w-48 h-48 overflow-hidden flex-shrink-0">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                        No Image</div>
                                @endif
                            </div>

                            <div class="p-4 sm:p-6 flex flex-col justify-center flex-grow gap-2">
                                <div class="flex items-center gap-3">
                                    <span class="px-3 py-1 rounded-full text-xs uppercase tracking-wide pill-gold"
                                        style="font-family: poppins, sans-serif;">Exclusive</span>
                                    <span
                                        class="text-xs sm:text-sm text-gray-500">{{ $product->category->name ?? 'Exclusive' }}</span>
                                </div>
                                <h3 class="text-2xl font-semibold text-gray-900"
                                    style="font-family: cormorant, serif !important;">{{ $product->name }}</h3>
                                <p class="text-base sm:text-lg text-gray-700">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</p>
                                <div class="flex items-center justify-between pt-1">
                                    <span class="text-sm text-gray-500 italic">Limited release</span>
                                    <button
                                        class="px-4 py-2 rounded-full text-sm font-semibold text-white btn-gold">View
                                        details</button>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <p class="text-gray-500 text-lg">Produk tidak ditemukan.</p>
                    <a href="{{ request()->url() }}" class="text-black underline">Reset Filter</a>
                </div>
            @endif
        </div>
    </div>

    <div id="overlay"
        class="fixed inset-0 bg-black/40 opacity-0 pointer-events-none transition-opacity duration-300 z-40"></div>

    {{-- SIDEBAR FILTER --}}
    <div id="filterSidebar"
        class="fixed top-0 left-0 h-full w-[360px] bg-white -translate-x-full transition-transform duration-300 ease-in-out z-50 overflow-y-auto">
        <div class="flex justify-between items-center p-6 border-b">
            <h2 class="font-bold uppercase tracking-widest">Filters</h2>
            <button onclick="closeFilter()" class="text-2xl hover:text-red-500">&times;</button>
        </div>

        {{-- FORM FILTER UTAMA --}}
        <form action="{{ request()->url() }}" method="GET">
            {{-- Filter 1: Search --}}
            <div class="px-6 mt-6">
                <div class="flex border rounded-md overflow-hidden">
                    <input type="text" name="q" value="{{ request('q') }}"
                        placeholder="Search products..." class="w-full px-4 py-2 outline-none">
                    <button type="submit" class="bg-black text-white px-4 hover:bg-gray-800 transition">&gt;</button>
                </div>
            </div>


            {{-- Filter 2: Price (Backend Implemented) --}}
            <div class="px-6 mt-10">
                <h2 class="text-3xl font-light mb-6" style="font-family: 'Playfair Display', serif;">Filter
                    by<br>price</h2>
                <div class="relative h-2 bg-gray-200 rounded-full mb-6">
                    <div id="priceRangeFill" class="absolute inset-y-0 bg-black rounded-full"></div>
                    <div id="priceMinHandle"
                        class="absolute -top-2 w-6 h-6 bg-black rounded-full -translate-x-1/2 cursor-pointer">
                    </div>
                    <div id="priceMaxHandle"
                        class="absolute -top-2 w-6 h-6 bg-black rounded-full -translate-x-1/2 cursor-pointer">
                    </div>

                    {{-- Tambahkan ATRIBUT NAME pada range input --}}
                    <input id="priceMinRange" name="min_price" type="range" min="0" max="500"
                        value="{{ request('min_price', 0) }}" step="1"
                        class="absolute inset-0 w-full h-6 opacity-0 cursor-pointer z-30">
                    <input id="priceMaxRange" name="max_price" type="range" min="0" max="500"
                        value="{{ request('max_price', 500) }}" step="1"
                        class="absolute inset-0 w-full h-6 opacity-0 cursor-pointer z-20">
                </div>
                <div class="flex gap-4">
                    <div class="border px-4 py-2 text-sm" id="priceMinLabel">Rp
                        {{ number_format(request('min_price', 0) * 1000, 0, ',', '.') }}</div>
                    <div class="border px-4 py-2 text-sm" id="priceMaxLabel">Rp
                        {{ number_format(request('max_price', 500) * 1000, 0, ',', '.') }}</div>
                </div>
                <button type="submit"
                    class="w-full mt-4 bg-black text-white py-2 rounded text-sm hover:bg-gray-800 transition">Apply
                    Price Filter</button>
            </div>
        </form>

        {{-- Filter 3: Category --}}
        <div class="px-6 mt-14 mb-10">
            <h3 class="text-xs mb-6 tracking-widest text-gray-400 uppercase font-bold">Filter by Category</h3>
            <ul class="space-y-4 font-semibold text-gray-700">
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['category' => 'Exclusive']) }}"
                        class="{{ request('category') == 'Exclusive' ? 'text-black underline' : 'hover:text-black' }}">Exclusive</a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['category' => 'Pria']) }}"
                        class="{{ request('category') == 'Pria' ? 'text-black underline' : 'hover:text-black' }}">Pria</a>
                </li>
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['category' => 'Wanita']) }}"
                        class="{{ request('category') == 'Wanita' || !request('category') ? 'text-black underline font-bold' : 'hover:text-black' }}">Wanita</a>
                </li>
                <li class="pt-4 border-t">
                    <a href="{{ request()->url() }}"
                        class="text-red-500 text-xs font-normal underline hover:text-red-700">Clear All Filters</a>
                </li>
            </ul>
        </div>
    </div>


</x-layoutCategories>
