<x-layoutCategories>
    {{-- hero section --}}

    <div class="relative isolate px-6 pt-20 lg:px-20 h-[400px] hero-bg">

        <!-- Container -->
        <div class="w-full py-6 sm:py-8 lg:py-16 flex flex-col gap-4 text-black">

            <!-- Breadcrumb -->
            <div class="flex items-center gap-2 text-sm sm:text-base text-gray-600"
                style="font-family: poppins, sans-serif;">
                <a href="/" class="hover:underline">Home</a>
                <span>/</span>
                <span>Men</span>
            </div>

            <!-- Title -->
            <h1 class="text-5xl sm:text-6xl lg:text-7xl font-light tracking-wide"
                style="font-family: cormorant, serif !important;">
                MEN
            </h1>

        </div>
    </div>

    {{-- sectiion 4 --}}
    <div class="relative isolate px-6 pt-14 lg:px-20 min-h-screen py-10">
        <!-- Toolbar -->
        <div class="w-full flex items-center justify-between py-4 border-b border-gray-200">

            <!-- Left: Filter -->
            <div class="flex items-center gap-3 text-black cursor-pointer">
                <!-- Filter icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M6 12h12M10 18h4" />
                </svg>

                <button onclick="openFilter()" class="flex items-center gap-2">
                    Filter Products
                </button>

            </div>

            <!-- Right: Sorting & View -->
            <div class="flex items-center gap-6 text-gray-700">

                <!-- Sorting -->
                <div class="relative">
                    <button onclick="toggleSortDropdown()" class="flex items-center gap-2 cursor-pointer">
                        <span id="sortLabel" class="text-base">Default sorting</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div id="sortDropdown" class="hidden absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                        <ul class="py-2">
                            <li onclick="selectSort('Default sorting')" class="px-4 py-2 hover:bg-gray-100 cursor-pointer transition">Default sorting</li>
                            <li onclick="selectSort('Sort by popularity')" class="px-4 py-2 hover:bg-gray-100 cursor-pointer transition">Sort by popularity</li>
                            <li onclick="selectSort('Sort by latest')" class="px-4 py-2 hover:bg-gray-100 cursor-pointer transition">Sort by latest</li>
                            <li onclick="selectSort('Sort by price: low to high')" class="px-4 py-2 hover:bg-gray-100 cursor-pointer transition">Sort by price: low to high</li>
                            <li onclick="selectSort('Sort by price: high to low')" class="px-4 py-2 hover:bg-gray-100 cursor-pointer transition">Sort by price: high to low</li>
                        </ul>
                    </div>
                </div>

                <!-- View icons -->
                <div class="flex items-center gap-3">
                    <!-- Grid -->
                    <svg id="gridView" onclick="toggleView('grid')" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 cursor-pointer text-black" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path d="M3 3h8v8H3V3zm10 0h8v8h-8V3zM3 13h8v8H3v-8zm10 0h8v8h-8v-8z" />
                    </svg>

                    <!-- List -->
                    <svg id="listView" onclick="toggleView('list')" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 cursor-pointer text-gray-400" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path d="M4 6h16v2H4V6zm0 5h16v2H4v-2zm0 5h16v2H4v-2z" />
                    </svg>
                </div>

            </div>
        </div>

        @php
            $bestSellers = \Database\Factories\ProductData::getBestSellers();
        @endphp

        <div class="max-w-7xl mx-auto mt-12">
            <!-- Grid View -->
            <div id="productsGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($bestSellers as $product)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden transition hover:shadow-xl">
                        <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}"
                            class="w-full h-64 object-cover transition-transform duration-300 hover:scale-110">
                        <div class="p-4">
                            <h4 class="text-s text-gray-500 mb-1" style="font-family: cormorant, serif !important;">
                                {{ $product['category'] }}
                            </h4>
                            <h3 class="text-xl font-semibold text-gray-900"
                                style="font-family: cormorant, serif !important;">
                                {{ $product['name'] }}</h3>
                            <p class="text-gray-600 mt-2" style="font-family: poppins, sans-serif !important;">
                                Rp {{ number_format($product['price'], 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- List View -->
            <div id="productsList" class="hidden space-y-4">
                @foreach ($bestSellers as $product)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden transition hover:shadow-xl flex flex-col sm:flex-row">
                        <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}"
                            class="w-full sm:w-48 h-48 object-cover flex-shrink-0">
                        <div class="p-4 sm:p-6 flex flex-col justify-center flex-grow">
                            <h4 class="text-xs sm:text-sm text-gray-500 mb-1 sm:mb-2" style="font-family: cormorant, serif !important;">
                                {{ $product['category'] }}
                            </h4>
                            <h3 class="text-xl sm:text-2xl font-semibold text-gray-900 mb-2 sm:mb-3"
                                style="font-family: cormorant, serif !important;">
                                {{ $product['name'] }}</h3>
                            <p class="text-base sm:text-lg text-gray-600" style="font-family: poppins, sans-serif !important;">
                                Rp {{ number_format($product['price'], 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Overlay (Smoke) -->
    <div id="overlay"
        class="fixed inset-0 bg-black/40 opacity-0 pointer-events-none transition-opacity duration-300 z-40">
    </div>

    <!-- Sidebar Filter -->
    <div id="filterSidebar"
        class="fixed top-0 left-0 h-full w-[360px] bg-white
           -translate-x-full transition-transform duration-300 ease-in-out
           z-50 overflow-y-auto">

        <!-- Header -->
        <div class="flex justify-end p-4">
            <button onclick="closeFilter()" class="text-2xl">&times;</button>
        </div>

        <!-- Search -->
        <div class="px-6">
            <div class="flex border">
                <input type="text" placeholder="Search products..." class="w-full px-4 py-2 outline-none">
                <button class="bg-black text-white px-4">&gt;</button>
            </div>
        </div>

        <!-- Filter by price -->
        <div class="px-6 mt-10">
            <h2 class="text-4xl font-light mb-6" style="font-family: 'Playfair Display', serif;">
                Filter by<br>price
            </h2>

            <div class="relative h-2 bg-gray-200 rounded-full mb-6">
                <div id="priceRangeFill" class="absolute inset-y-0 bg-black rounded-full"></div>

                <div id="priceMinHandle"
                    class="absolute -top-2 w-6 h-6 bg-black rounded-full -translate-x-1/2 cursor-pointer"></div>
                <div id="priceMaxHandle"
                    class="absolute -top-2 w-6 h-6 bg-black rounded-full -translate-x-1/2 cursor-pointer"></div>

                <input id="priceMinRange" type="range" min="0" max="500" value="199" step="1"
                    class="absolute inset-0 w-full h-6 opacity-0 cursor-pointer z-30">
                <input id="priceMaxRange" type="range" min="0" max="500" value="375" step="1"
                    class="absolute inset-0 w-full h-6 opacity-0 cursor-pointer z-20">
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

        <!-- Category -->
        <div class="px-6 mt-14">
            <h3 class="text-xl mb-6 tracking-widest">FILTER BY CATEGORY</h3>
            <ul class="space-y-3 font-semibold">
                <li class="cursor-pointer">Exclusive</li>
                <li class="cursor-pointer">Men</li>
                <li class="cursor-pointer">Women</li>
            </ul>
        </div>

    </div>


</x-layoutCategories>
