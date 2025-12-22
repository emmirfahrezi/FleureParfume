<x-layoutCategories>
    {{-- HERO SECTION --}}
    <style>
        .hero-bg {
            background-image: linear-gradient(135deg, rgba(60, 60, 60, 0.7) 0%, rgba(0, 0, 0, 0.5) 100%),
            url("{{ asset('images/products/thumbnail.jpg') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>

    <div class="relative isolate px-6 pt-20 lg:px-20 h-[400px] hero-bg">
        <div class="w-full py-6 sm:py-8 lg:py-16 flex flex-col gap-4 text-black">
            <div class="flex items-center gap-2 text-sm sm:text-base text-gray-600" style="font-family: poppins, sans-serif;">
                <a href="/" class="hover:underline text-gray-300">Home</a>
                <span class="text-gray-400">/</span>
                <span class="text-white">Unisex</span>
            </div>

            <h1 class="text-5xl sm:text-6xl lg:text-7xl font-light tracking-wide text-white" style="font-family: cormorant, serif !important;">
                UNISEX
            </h1>
        </div>
    </div>

    {{-- PRODUCT LIST --}}
    <div class="relative isolate px-6 pt-14 lg:px-20 min-h-screen py-10">
        <div class="w-full flex items-center justify-between py-4 border-b border-gray-200">
            <div class="flex items-center gap-3 text-black cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M6 12h12M10 18h4" />
                </svg>
                <button onclick="openFilter()" class="flex items-center gap-2 font-medium hover:text-gray-600">Filter Products</button>
            </div>

            <div class="flex items-center gap-6 text-gray-700">
                <div class="relative">
                    <button onclick="toggleSortDropdown()" class="flex items-center gap-2 cursor-pointer hover:text-black">
                        <span id="sortLabel" class="text-base">Default sorting</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="sortDropdown" class="hidden absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                        <ul class="py-2">
                            <li onclick="selectSort('Default sorting')" class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Default sorting</li>
                            <li onclick="selectSort('Sort by latest')" class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Sort by latest</li>
                            <li onclick="selectSort('Sort by price: low to high')" class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Price: low to high</li>
                        </ul>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <svg id="gridView" onclick="toggleView('grid')" class="w-5 h-5 cursor-pointer text-black" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 3h8v8H3V3zm10 0h8v8h-8V3zM3 13h8v8H3v-8zm10 0h8v8h-8v-8z" />
                    </svg>
                    <svg id="listView" onclick="toggleView('list')" class="w-5 h-5 cursor-pointer text-gray-400 hover:text-black" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4 6h16v2H4V6zm0 5h16v2H4v-2zm0 5h16v2H4v-2z" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- PRODUCTS CONTAINER --}}
        <div class="max-w-7xl mx-auto mt-12">
            @if(isset($products) && $products->count() > 0)
            {{-- Grid View --}}
            <div id="productsGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($products as $product)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transition hover:shadow-xl group">
                    <div class="w-full h-64 overflow-hidden relative">
                        @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                        @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">No Image</div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h4 class="text-sm text-gray-500 mb-1" style="font-family: cormorant, serif !important;">{{ $product->category->name ?? 'Unisex' }}</h4>
                        <h3 class="text-xl font-semibold text-gray-900 truncate" style="font-family: cormorant, serif !important;">{{ $product->name }}</h3>
                        <p class="text-gray-600 mt-2" style="font-family: poppins, sans-serif !important;">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- List View --}}
            <div id="productsList" class="hidden space-y-4">
                @foreach ($products as $product)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transition hover:shadow-xl flex flex-col sm:flex-row group">
                    <div class="w-full sm:w-48 h-48 overflow-hidden flex-shrink-0">
                        @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                        @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">No Image</div>
                        @endif
                    </div>
                    <div class="p-4 sm:p-6 flex flex-col justify-center flex-grow">
                        <h4 class="text-xs sm:text-sm text-gray-500 mb-1 sm:mb-2" style="font-family: cormorant, serif !important;">{{ $product->category->name ?? 'Unisex' }}</h4>
                        <h3 class="text-xl sm:text-2xl font-semibold text-gray-900 mb-2 sm:mb-3" style="font-family: cormorant, serif !important;">{{ $product->name }}</h3>
                        <p class="text-base sm:text-lg text-gray-600" style="font-family: poppins, sans-serif !important;">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-20">
                <p class="text-gray-500 text-lg">Belum ada produk untuk kategori Unisex.</p>
            </div>
            @endif
        </div>
    </div>

    {{-- Sidebar & Overlay --}}
    <div id="overlay" class="fixed inset-0 bg-black/40 opacity-0 pointer-events-none transition-opacity duration-300 z-40"></div>
    <div id="filterSidebar" class="fixed top-0 left-0 h-full w-[360px] bg-white -translate-x-full transition-transform duration-300 ease-in-out z-50 overflow-y-auto">
        <div class="flex justify-end p-4"><button onclick="closeFilter()" class="text-2xl hover:text-red-500">&times;</button></div>
        <div class="px-6 mt-14">
            <h3 class="text-xl mb-6 tracking-widest">FILTER BY CATEGORY</h3>
            <ul class="space-y-3 font-semibold text-gray-700">
                <li class="cursor-pointer hover:text-black">Exclusive</li>
                <li class="cursor-pointer hover:text-black">Men</li>
                <li class="cursor-pointer hover:text-black">Women</li>
                <li class="cursor-pointer text-black font-bold">Unisex</li>
            </ul>
        </div>
    </div>
</x-layoutCategories>