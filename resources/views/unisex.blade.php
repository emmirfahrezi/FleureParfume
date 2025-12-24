<x-layoutCategories>
    {{-- HERO SECTION --}}
    <style>
        .hero-bg {
            background-image: linear-gradient(135deg, rgba(43, 50, 90, 0.7) 0%, rgba(0, 0, 0, 0.5) 100%),
                url("{{ asset('images/products/thumbnail.jpg') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        /* Styling Slider Harga Double Handle */
        .range-slider {
            position: relative;
            width: 100%;
            height: 5px;
            background: #e5e7eb;
            border-radius: 5px;
            margin-top: 30px;
        }
        .range-slider input[type="range"] {
            position: absolute;
            width: 100%;
            height: 5px;
            -webkit-appearance: none;
            background: none;
            pointer-events: none;
            top: 0; left: 0;
        }
        .range-slider input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            height: 24px; width: 24px;
            border-radius: 50%;
            background: transparent;
            pointer-events: auto;
            cursor: pointer;
        }
    </style>

    <div class="relative isolate px-6 pt-20 lg:px-20 h-[400px] hero-bg">
        <div class="w-full py-6 sm:py-8 lg:py-16 flex flex-col gap-4 text-black">
            <div class="flex items-center gap-2 text-sm sm:text-base text-gray-600" style="font-family: poppins, sans-serif;">
                <a href="/" class="hover:underline text-gray-300">Home</a>
                <span class="text-gray-400">/</span>
                <span class="text-white">Unisex</span>
            </div>
            <h1 class="text-5xl sm:text-6xl lg:text-7xl font-light tracking-wide text-white" style="font-family: cormorant, serif !important;">UNISEX</h1>
        </div>
    </div>

    {{-- PRODUCT LIST --}}
    <div class="relative isolate px-6 pt-14 lg:px-20 min-h-screen py-10">
        {{-- Toolbar sama seperti kodingan asli --}}
        <div class="w-full flex items-center justify-between py-4 border-b border-gray-200">
            <div class="flex items-center gap-3 text-black cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M6 12h12M10 18h4" />
                </svg>
                <button onclick="openFilter()" class="flex items-center gap-2 font-medium hover:text-gray-600">Filter Products</button>
            </div>
            {{-- Bagian Sort (Hanya UI) --}}
            <div class="flex items-center gap-6 text-gray-700">
                <div class="relative">
                    <button onclick="toggleSortDropdown()" class="flex items-center gap-2 cursor-pointer text-base">
                        <span id="sortLabel">Default sorting</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div id="sortDropdown" class="hidden absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                        <ul class="py-2 text-sm">
                            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer transition">Default sorting</li>
                            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer transition">Sort by latest</li>
                            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer transition">Sort by price: low to high</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto mt-12">
            @if (isset($products) && $products->count() > 0)
                <div id="productsGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($products as $product)
                        <a href="/detailProduk/{{ $product->id }}" class="bg-white rounded-xl shadow-lg overflow-hidden transition hover:shadow-2xl block group">
                            <div class="relative w-full h-64 overflow-hidden">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">No Image</div>
                                @endif
                            </div>
                            <div class="p-4">
                                <h4 class="text-sm text-gray-500 mb-1">{{ $product->category->name ?? 'Men' }}</h4>
                                <h3 class="text-xl font-semibold text-gray-900 truncate">{{ $product->name }}</h3>
                                <p class="text-gray-600 mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 text-gray-500">Belum ada produk untuk kategori ini. <br> <a href="{{ request()->url() }}" class="underline text-black">Reset Filter</a></div>
            @endif
        </div>
    </div>

    {{-- SIDEBAR FILTER --}}
    <div id="overlay" class="fixed inset-0 bg-black/40 opacity-0 pointer-events-none transition-opacity duration-300 z-40"></div>
    <div id="filterSidebar" class="fixed top-0 left-0 h-full w-[360px] bg-white -translate-x-full transition-transform duration-300 z-50 overflow-y-auto">
        <div class="flex justify-end p-4"><button onclick="closeFilter()" class="text-2xl">&times;</button></div>
        
        <form action="{{ request()->url() }}" method="GET">
            <div class="px-6">
                <div class="flex border rounded overflow-hidden">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..." class="w-full px-4 py-2 outline-none text-sm">
                    <button type="submit" class="bg-black text-white px-4">&gt;</button>
                </div>
            </div>

            <div class="px-6 mt-10">
                <h2 class="text-4xl font-light mb-6" style="font-family: 'Playfair Display', serif;">Filter by<br>price</h2>
                <div class="range-slider mb-10">
                    <div id="rangeFill" class="absolute h-full bg-black rounded-full" style="left: 0%; right: 0%;"></div>
                    <div id="minHandle" class="absolute -top-2 w-5 h-5 bg-black rounded-full -translate-x-1/2 pointer-events-none z-10" style="left: 0%;"></div>
                    <div id="maxHandle" class="absolute -top-2 w-5 h-5 bg-black rounded-full -translate-x-1/2 pointer-events-none z-10" style="left: 100%;"></div>
                    <input type="range" name="min_price" id="inputMin" min="0" max="500" value="{{ request('min_price', 0) }}" step="1" oninput="updateRangeUI()">
                    <input type="range" name="max_price" id="inputMax" min="0" max="500" value="{{ request('max_price', 500) }}" step="1" oninput="updateRangeUI()">
                </div>
                <div class="flex gap-4 mb-4">
                    <div class="border px-4 py-2 text-[10px] w-1/2 text-center" id="minDisplay">Rp {{ number_format(request('min_price', 0) * 1000, 0, ',', '.') }}</div>
                    <div class="border px-4 py-2 text-[10px] w-1/2 text-center" id="maxDisplay">Rp {{ number_format(request('max_price', 500) * 1000, 0, ',', '.') }}</div>
                </div>
                <button type="submit" class="w-full bg-black text-white py-3 rounded font-bold text-xs hover:bg-gray-800 transition tracking-widest">APPLY PRICE FILTER</button>
            </div>
        </form>

        <div class="px-6 mt-14 mb-10">
            <h3 class="text-xs mb-6 tracking-widest text-gray-400 uppercase font-bold">Category</h3>
            <ul class="space-y-4 font-semibold text-lg">
                <li><a href="{{ request()->fullUrlWithQuery(['category' => 'Exclusive']) }}" class="{{ request('category') == 'Exclusive' ? 'text-black underline' : 'hover:text-black text-gray-600' }}">Exclusive</a></li>
                <li><a href="{{ request()->fullUrlWithQuery(['category' => 'Pria']) }}" class="{{ request('category') == 'Pria' || !request('category') ? 'text-black underline' : 'hover:text-black text-gray-600' }}">Pria</a></li>
                <li><a href="{{ request()->fullUrlWithQuery(['category' => 'Wanita']) }}" class="{{ request('category') == 'Wanita' ? 'text-black underline' : 'hover:text-black text-gray-600' }}">Wanita</a></li>
                <li><a href="{{ request()->fullUrlWithQuery(['category' => 'Unisex']) }}" class="{{ request('category') == 'Unisex' ? 'text-black underline' : 'hover:text-black text-gray-600' }}">Unisex</a></li>
                <li class="pt-4 border-t"><a href="{{ request()->url() }}" class="text-red-500 text-xs font-normal underline">Clear All Filters</a></li>
            </ul>
        </div>
    </div>

    <script>
        function updateRangeUI() {
            const minInput = document.getElementById('inputMin'), maxInput = document.getElementById('inputMax');
            const rangeFill = document.getElementById('rangeFill'), minHandle = document.getElementById('minHandle'), maxHandle = document.getElementById('maxHandle');
            const minDisplay = document.getElementById('minDisplay'), maxDisplay = document.getElementById('maxDisplay');

            if (parseInt(minInput.value) > parseInt(maxInput.value)) minInput.value = maxInput.value;
            const minPercent = (minInput.value / 500) * 100, maxPercent = (maxInput.value / 500) * 100;

            rangeFill.style.left = minPercent + '%'; rangeFill.style.right = (100 - maxPercent) + '%';
            minHandle.style.left = minPercent + '%'; maxHandle.style.left = maxPercent + '%';
            minDisplay.innerText = 'Rp ' + (minInput.value * 1000).toLocaleString('id-ID');
            maxDisplay.innerText = 'Rp ' + (maxInput.value * 1000).toLocaleString('id-ID');
        }
        window.addEventListener('DOMContentLoaded', updateRangeUI);
    </script>
</x-layoutCategories>