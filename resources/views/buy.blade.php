<x-layoutCategories>
    {{-- Hero: general catalog --}}
    <div class="relative isolate px-6 pt-20 lg:px-20 min-h-[420px]"
        style="background: linear-gradient(135deg, #f4ede1 0%, #e9dcc3 45%, #f7f1e7 100%);">
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute top-10 right-10 w-40 h-40 rounded-full bg-white/40 blur-3xl"></div>
            <div class="absolute bottom-0 left-10 w-52 h-52 rounded-full bg-amber-100/50 blur-3xl"></div>
        </div>

        <div class="relative max-w-5xl w-full py-8 sm:py-12 lg:py-16 flex flex-col gap-5 text-gray-900">
            <div class="flex items-center gap-2 text-sm sm:text-base text-gray-600"
                style="font-family: poppins, sans-serif;">
                <a href="/" class="hover:underline">Home</a>
                <span>/</span>
                <span>Buy</span>
            </div>

            <div class="space-y-4">
                <p class="inline-flex items-center gap-2 px-4 py-1 rounded-full text-xs uppercase tracking-[0.25em] bg-black text-white"
                    style="font-family: poppins, sans-serif;">All Collections</p>
                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-light leading-tight"
                    style="font-family: cormorant, serif !important;">
                    Discover Every Aroma
                </h1>
                <p class="text-base sm:text-lg text-gray-700 max-w-3xl" style="font-family: poppins, sans-serif;">
                    Satu halaman untuk semua koleksi parfum kami: kategori pria, wanita, unisex, hingga exclusive.
                    Temukan aroma favorit Anda dengan filter harga, kategori, dan tampilan grid atau list.
                </p>
            </div>
        </div>
    </div>

    {{-- Toolbar + products --}}
    <div class="relative isolate px-6 pt-14 lg:px-20 min-h-screen py-10">
        <div class="w-full flex items-center justify-between py-4 border-b border-gray-200">
            <div class="flex items-center gap-3 text-black cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M6 12h12M10 18h4" />
                </svg>
                <button onclick="openFilter()" class="flex items-center gap-2">Filter Products</button>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="sortDropdown"
                        class="hidden absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                        <ul class="py-2">
                            <li onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort' => null]) }}'"
                                class="px-4 py-2 hover:bg-gray-100 cursor-pointer transition border-b border-gray-50">
                                Default sorting</li> 
                            <li onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}'"
                                class="px-4 py-2 hover:bg-gray-100 cursor-pointer transition">Sort by price: low to high</li>
                            <li onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}'"
                                class="px-4 py-2 hover:bg-gray-100 cursor-pointer transition">Sort by price: high to low</li>
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
                {{-- Bagian Grid View --}}
                <div id="productsGrid" class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach ($products as $product)
                        <a href="/detailProduk/{{ $product->id }}"
                            class="bg-white rounded-lg shadow-md overflow-hidden transition hover:shadow-xl block border border-gray-100 p-2">
                            <div class="relative w-full h-30 sm:h-48 lg:h-60 overflow-hidden">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400 text-xs">
                                        No Image</div>
                                @endif
                                <span
                                    class="absolute top-2 left-2 px-2 py-1 rounded-full text-[10px] uppercase tracking-wide bg-white/90 text-gray-900"
                                    style="font-family: poppins, sans-serif;">
                                    {{ $product->category->name ?? 'General' }}
                                </span>
                            </div>
                            <div class="pt-2">
                                <h3 class="text-base font-semibold text-gray-900 truncate"
                                    style="font-family: cormorant, serif !important;">{{ $product->name }}</h3>
                                <p class="text-xs text-gray-700 mt-1"
                                    style="font-family: poppins, sans-serif !important;">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{-- Bagian List View --}}
                <div id="productsList" class="hidden space-y-4">
                    @foreach ($products as $product)
                        <a href="/detailProduk/{{ $product->id }}"
                            class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col sm:flex-row transition hover:shadow-2xl block border border-gray-100">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="w-full sm:w-48 h-48 object-cover flex-shrink-0">
                            @else
                                <div
                                    class="w-full sm:w-48 h-48 flex items-center justify-center bg-gray-200 text-gray-400 flex-shrink-0">
                                    No Image</div>
                            @endif
                            <div class="p-4 sm:p-6 flex flex-col justify-center gap-2 flex-grow">
                                <div class="text-xs sm:text-sm text-gray-500">
                                    {{ $product->category->name ?? 'General' }}</div>
                                <h3 class="text-2xl font-semibold text-gray-900"
                                    style="font-family: cormorant, serif !important;">{{ $product->name }}</h3>
                                <p class="text-base sm:text-lg text-gray-700">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20">
                    <p class="text-gray-500 text-lg">Belum ada produk tersedia.</p>
                    <a href="{{ request()->url() }}" class="text-black underline mt-4 inline-block">Reset Filter</a>
                </div>
            @endif
            {{--  PAGINATION --}}
            <div class="mt-16 flex justify-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>

    <div id="overlay"
        class="fixed inset-0 bg-black/40 opacity-0 pointer-events-none transition-opacity duration-300 z-40"></div>

    {{-- SIDEBAR FILTER --}}
    <div id="filterSidebar"
        class="fixed top-0 left-0 h-full w-[360px] bg-white -translate-x-full transition-transform duration-300 ease-in-out z-50 overflow-y-auto">

        <div class="flex justify-between items-center p-6 border-b border-gray-100">
            <h2 class="text-xl font-semibold">Filters</h2>
            <button onclick="closeFilter()" class="text-3xl">&times;</button>
        </div>

        {{-- FORM FILTER UTAMA --}}
        <form action="{{ request()->url() }}" method="GET">
            {{-- Pastikan filter sort & category yang lama tetap terbawa saat filter harga/search diubah --}}
            @if (request('sort'))
                <input type="hidden" name="sort" value="{{ request('sort') }}">
            @endif
            @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif

            {{-- Filter 1: Search --}}
            <div class="px-6 mt-6">
                <div class="flex border border-gray-300 rounded overflow-hidden">
                    <input type="text" name="q" value="{{ request('q') }}"
                        placeholder="Search products..." class="w-full px-4 py-2 outline-none text-sm">
                    <button type="submit" class="bg-black text-white px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Filter 2: Price --}}
            <div class="px-6 mt-10">
                <h2 class="text-3xl font-light mb-6" style="font-family: 'Playfair Display', serif;">Filter
                    by<br>price</h2>
                <div class="relative h-2 bg-gray-200 rounded-full mb-6">
                    <div id="priceRangeFill" class="absolute inset-y-0 bg-black rounded-full"></div>
                    <div id="priceMinHandle"
                        class="absolute -top-2 w-6 h-6 bg-black rounded-full -translate-x-1/2 cursor-pointer"></div>
                    <div id="priceMaxHandle"
                        class="absolute -top-2 w-6 h-6 bg-black rounded-full -translate-x-1/2 cursor-pointer"></div>

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

        {{-- Filter 3: Category (Link langsung ganti URL) --}}
        <div class="px-6 mt-14 mb-10">
            <h3 class="text-xs mb-6 tracking-widest text-gray-400 uppercase font-bold">Filter by Category</h3>
            <ul class="space-y-4 font-semibold text-lg">
                <li>
                    <a href="{{ route('exclusive.index', request()->only(['q', 'min_price', 'max_price', 'sort'])) }}"
                        class="{{ request()->routeIs('exclusive.index') ? 'text-amber-700 underline' : 'hover:text-amber-700' }}">Exclusive</a>
                </li>
                <li>
                    <a href="{{ route('man.index', request()->only(['q', 'min_price', 'max_price', 'sort'])) }}"
                        class="{{ request()->routeIs('man.index') ? 'text-amber-700 underline' : 'hover:text-amber-700' }}">Pria</a>
                </li>
                <li>
                    <a href="{{ route('woman.index', request()->only(['q', 'min_price', 'max_price', 'sort'])) }}"
                        class="{{ request()->routeIs('woman.index') ? 'text-amber-700 underline' : 'hover:text-amber-700' }}">Wanita</a>
                </li>
                <li>
                    <a href="{{ route('unisex.index', request()->only(['q', 'min_price', 'max_price', 'sort'])) }}"
                        class="{{ request()->routeIs('unisex.index') ? 'text-amber-700 underline' : 'hover:text-amber-700' }}">Unisex</a>
                </li>
                <li class="pt-4">
                    <a href="{{ request()->url() }}" class="text-red-500 text-sm font-normal underline">Clear All
                        Filters</a>
                </li>
            </ul>
        </div>
    </div>

</x-layoutCategories>
