<x-layoutCategories>
    {{--
        =======================================================
        BAGIAN 1: CUSTOM CSS & HERO (LUXURY THEME)
        =======================================================
    --}}
    <style>
        .exclusive-hero {
            background-image: linear-gradient(135deg, rgba(23, 16, 7, 0.85) 0%, rgba(112, 85, 38, 0.65) 100%),
            url("{{ asset('images/products/thumbnail.jpg') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        /* Card Mewah */
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

        /* Aksen Emas */
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

        /*  FIX SLIDER UI BIAR DUA-DUANYA BISA DIGESER  */

        /* 1. Inputnya sendiri kita bikin tembus klik (pointer-events: none) */
        input[type=range] {
            pointer-events: none;
            -webkit-appearance: none;
            /* Wajib buat Chrome/Safari */
            background: transparent;
        }

        /* 2. Tapi PENTOLAN-nya (Thumb) kita bikin BISA diklik (pointer-events: auto) */
        input[type=range]::-webkit-slider-thumb {
            pointer-events: auto;
            width: 20px;
            height: 20px;
            -webkit-appearance: none;
            background: #d4af37;
            border: 2px solid white;
            border-radius: 50%;
            cursor: pointer;
            position: relative;
            z-index: 50;
            /* Biar pentolannya selalu di atas */
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }
    </style>

    {{-- HERO SECTION --}}
    <div class="relative isolate px-6 pt-20 lg:px-20 h-[450px] exclusive-hero">
        <div class="w-full py-10 sm:py-12 lg:py-16 flex flex-col gap-5 text-white max-w-4xl">
            <div class="flex items-center gap-2 text-sm sm:text-base text-white/80" style="font-family: poppins, sans-serif;">
                <a href="/" class="hover:underline text-gray-300">Home</a>
                <span>/</span>
                <span>Exclusive</span>
            </div>

            <div class="space-y-3">
                <div class="inline-flex items-center gap-2 pill-gold px-4 py-1 rounded-full text-sm uppercase tracking-[0.25em]" style="font-family: poppins, sans-serif;">
                    Signature Collection
                </div>
                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-light tracking-wide leading-tight" style="font-family: cormorant, serif !important;">
                    EXCLUSIVE PERFUMES
                </h1>
                <p class="text-base sm:text-lg text-white/80 max-w-2xl" style="font-family: poppins, sans-serif;">
                    Kurasi parfum premium dengan sentuhan artisan, komposisi langka, dan finishing mewah untuk momen paling istimewa.
                </p>
            </div>
        </div>
    </div>

    {{--
        =======================================================
        BAGIAN 2: LIST PRODUK & TOOLBAR
        =======================================================
    --}}
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
                    <button onclick="toggleSortDropdown()" class="flex items-center gap-2 cursor-pointer">
                        @php
                        $sortLabel = 'Default sorting';
                        $sort = request('sort');
                        if ($sort === 'price_asc') $sortLabel = 'Sort by price: low to high';
                        elseif ($sort === 'price_desc') $sortLabel = 'Sort by price: high to low';
                        elseif ($sort === 'name_asc') $sortLabel = 'Sort by name: A-Z';
                        elseif ($sort === 'name_desc') $sortLabel = 'Sort by name: Z-A';
                        elseif ($sort === 'latest') $sortLabel = 'Sort by latest';
                        @endphp
                        <span id="sortLabel" class="text-base">{{ $sortLabel }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="sortDropdown" class="hidden absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                        <ul class="py-2 text-sm">
                            <li onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort' => null]) }}'" class="px-4 py-2 hover:bg-gray-100 cursor-pointer border-b">Default sorting</li>
                            <li onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}'" class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Sort by price: low to high</li>
                            <li onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}'" class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Sort by price: high to low</li>
                        </ul>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <svg id="gridView" onclick="toggleView('grid')" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 cursor-pointer text-black" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 3h8v8H3V3zm10 0h8v8h-8V3zM3 13h8v8H3v-8zm10 0h8v8h-8v-8z" />
                    </svg>
                    <svg id="listView" onclick="toggleView('list')" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 cursor-pointer text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4 6h16v2H4V6zm0 5h16v2H4v-2zm0 5h16v2H4v-2z" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- PRODUCTS CONTAINER --}}
        <div class="max-w-7xl mx-auto mt-12">
            @if (isset($products) && $products->count() > 0)
            {{-- GRID VIEW (Mewah Style) --}}
            <div id="productsGrid" class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($products as $product)
                <a href="/detailProduk/{{ $product->id }}" class="card-luxe bg-white rounded-lg overflow-hidden block group p-2">
                    <div class="relative w-full h-64 overflow-hidden">
                        @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400 text-xs">No Image</div>
                        @endif
                        <span class="absolute top-2 left-2 px-2 py-1 rounded-full text-[10px] uppercase tracking-wide pill-gold" style="font-family: poppins, sans-serif;">
                            {{ $product->category->name ?? 'Exclusive' }}
                        </span>
                    </div>
                    <div class="pt-3 px-1">
                        <h3 class="text-base font-semibold text-gray-900 truncate" style="font-family: cormorant, serif !important;">{{ $product->name }}</h3>
                        <p class="text-xs text-gray-600 mt-1" style="font-family: poppins, sans-serif !important;">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                </a>
                @endforeach
            </div>

            {{-- LIST VIEW (Mewah Style) --}}
            <div id="productsList" class="hidden space-y-4">
                @foreach ($products as $product)
                <a href="/detailProduk/{{ $product->id }}" class="card-luxe bg-white rounded-xl overflow-hidden flex flex-col sm:flex-row group block">
                    <div class="relative w-full sm:w-48 h-48 overflow-hidden flex-shrink-0">
                        @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">No Image</div>
                        @endif
                    </div>
                    <div class="p-4 sm:p-6 flex flex-col justify-center flex-grow gap-2">
                        <div class="flex items-center gap-3">
                            <span class="px-3 py-1 rounded-full text-xs uppercase tracking-wide pill-gold" style="font-family: poppins, sans-serif;">{{ $product->category->name ?? 'Exclusive' }}</span>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900" style="font-family: cormorant, serif !important;">{{ $product->name }}</h3>
                        <p class="text-lg text-gray-700 font-medium">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <div class="flex items-center justify-between pt-1">
                            <span class="text-sm text-gray-500 italic">Limited release</span>
                            <button class="px-4 py-2 rounded-full text-sm font-semibold text-white btn-gold">View Details</button>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-8 flex justify-center">
                {{ $products->links() }}
            </div>
            @else
            <div class="text-center py-20">
                <p class="text-gray-500 text-lg">Belum ada produk Exclusive.</p>
                <a href="{{ request()->url() }}" class="text-amber-700 underline mt-4">Reset Filter</a>
            </div>
            @endif
        </div>
    </div>

    <div id="overlay" class="fixed inset-0 bg-black/40 opacity-0 pointer-events-none transition-opacity duration-300 z-40"></div>

    {{--
        =======================================================
        BAGIAN 3: SIDEBAR FILTER
        =======================================================
    --}}
    <div id="filterSidebar" class="fixed top-0 left-0 h-full w-[360px] bg-white -translate-x-full transition-transform duration-300 ease-in-out z-50 overflow-y-auto shadow-2xl">
        <div class="flex justify-between items-center p-6 border-b border-gray-100">
            <h2 class="text-xl font-semibold">Filters</h2>
            <button onclick="closeFilter()" class="text-3xl">&times;</button>
        </div>

        <form action="{{ request()->url() }}" method="GET">
            @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif

            {{-- 1. Search --}}
            <div class="px-6 mt-6">
                <div class="flex border rounded-md overflow-hidden hover:border-amber-600 transition">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search exclusive..." class="w-full px-4 py-2 outline-none text-sm">
                    <button type="submit" class="bg-black text-white px-4 hover:bg-gray-800 transition">&gt;</button>
                </div>
            </div>

            {{-- 2. Price Filter (SUDAH FIX) --}}
            <div class="px-6 mt-10">
                <h2 class="text-3xl font-light mb-6" style="font-family: 'Playfair Display', serif;">Filter by<br>Price</h2>

                <div class="range-slider mb-8 relative w-full h-1 bg-gray-200 rounded-full mt-2">
                    <div id="rangeFill" class="absolute h-full bg-black rounded-full z-10"></div>
                    {{-- Handle UI (Visual doang) --}}
                    <div id="minHandle" class="absolute -top-1.5 w-4 h-4 bg-black rounded-full -translate-x-1/2 pointer-events-none z-20 shadow"></div>
                    <div id="maxHandle" class="absolute -top-1.5 w-4 h-4 bg-black rounded-full -translate-x-1/2 pointer-events-none z-20 shadow"></div>

                    {{-- INPUT RANGE  --}}
                    <input type="range" name="min_price" id="inputMin" min="0" max="500" value="{{ request('min_price', 0) }}" step="1" oninput="updateRangeUI()"
                        class="absolute inset-0 w-full h-full opacity-0 z-30 appearance-none pointer-events-none">

                    <input type="range" name="max_price" id="inputMax" min="0" max="500" value="{{ request('max_price', 500) }}" step="1" oninput="updateRangeUI()"
                        class="absolute inset-0 w-full h-full opacity-0 z-30 appearance-none pointer-events-none">
                </div>

                <div class="flex justify-between items-center gap-4 mb-6">
                    <div class="border px-3 py-2 text-xs w-24 text-center rounded bg-gray-50" id="minDisplay">Rp 0</div>
                    <div class="border px-3 py-2 text-xs w-24 text-center rounded bg-gray-50" id="maxDisplay">Rp 500.000</div>
                </div>

                <button type="submit" class="w-full btn-gold text-white py-3 rounded text-xs font-bold transition tracking-widest uppercase shadow-md">Apply Filter</button>
            </div>
        </form>

        {{-- 3. Category Links --}}
        <div class="px-6 mt-14 mb-10">
            <h3 class="text-xs mb-6 tracking-widest text-gray-400 uppercase font-bold">Category</h3>
            <ul class="space-y-4 font-semibold text-lg">
                <li>
                    <a href="{{ route('exclusive.index', request()->only(['q', 'min_price', 'max_price', 'sort'])) }}"
                        class="{{ request()->routeIs('exclusive.index') ? 'text-amber-700 underline font-bold' : 'hover:text-amber-700' }}">Exclusive</a>
                </li>
                <li>
                    <a href="{{ route('man.index', request()->only(['q', 'min_price', 'max_price', 'sort'])) }}"
                        class="{{ request()->routeIs('man.index') ? 'text-amber-700 underline font-bold' : 'hover:text-amber-700' }}">Pria</a>
                </li>
                <li>
                    <a href="{{ route('woman.index', request()->only(['q', 'min_price', 'max_price', 'sort'])) }}"
                        class="{{ request()->routeIs('woman.index') ? 'text-amber-700 underline font-bold' : 'hover:text-amber-700' }}">Wanita</a>
                </li>
                <li>
                    <a href="{{ route('unisex.index', request()->only(['q', 'min_price', 'max_price', 'sort'])) }}"
                        class="{{ request()->routeIs('unisex.index') ? 'text-amber-700 underline font-bold' : 'hover:text-amber-700' }}">Unisex</a>
                </li>
                <li class="pt-4">
                    <a href="{{ request()->url() }}" class="text-red-500 text-sm font-normal underline hover:text-red-700">Clear All Filters</a>
                </li>
            </ul>
        </div>
    </div>

    {{-- SCRIPT --}}
    <script>
        const filterSidebar = document.getElementById('filterSidebar');
        const overlay = document.getElementById('overlay');

        function openFilter() {
            filterSidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('opacity-0', 'pointer-events-none');
            document.body.style.overflow = 'hidden';
        }

        function closeFilter() {
            filterSidebar.classList.add('-translate-x-full');
            overlay.classList.add('opacity-0', 'pointer-events-none');
            document.body.style.overflow = 'auto';
        }
        overlay.addEventListener('click', closeFilter);

        function toggleView(view) {
            const grid = document.getElementById('productsGrid');
            const list = document.getElementById('productsList');
            const gridIcon = document.getElementById('gridView');
            const listIcon = document.getElementById('listView');

            if (view === 'grid') {
                grid.classList.remove('hidden');
                list.classList.add('hidden');
                gridIcon.classList.add('text-black');
                gridIcon.classList.remove('text-gray-400');
                listIcon.classList.remove('text-black');
                listIcon.classList.add('text-gray-400');
            } else {
                grid.classList.add('hidden');
                list.classList.remove('hidden');
                listIcon.classList.add('text-black');
                listIcon.classList.remove('text-gray-400');
                gridIcon.classList.remove('text-black');
                gridIcon.classList.add('text-gray-400');
            }
        }

        function toggleSortDropdown() {
            document.getElementById('sortDropdown').classList.toggle('hidden');
        }
        window.onclick = function(event) {
            if (!event.target.closest('button[onclick="toggleSortDropdown()"]')) {
                document.getElementById('sortDropdown').classList.add('hidden');
            }
        }

        function updateRangeUI() {
            const minInput = document.getElementById('inputMin');
            const maxInput = document.getElementById('inputMax');
            const rangeFill = document.getElementById('rangeFill');
            const minHandle = document.getElementById('minHandle');
            const maxHandle = document.getElementById('maxHandle');
            const minDisplay = document.getElementById('minDisplay');
            const maxDisplay = document.getElementById('maxDisplay');

            let minVal = parseInt(minInput.value);
            let maxVal = parseInt(maxInput.value);
            const maxLimit = 500;

            // Logic biar ga tabrakan (jarak minimal 10)
            if (minVal > maxVal - 10) {
                if (document.activeElement === minInput) {
                    minInput.value = maxVal - 10;
                    minVal = maxVal - 10;
                } else {
                    maxInput.value = minVal + 10;
                    maxVal = minVal + 10;
                }
            }

            const minPercent = (minVal / maxLimit) * 100;
            const maxPercent = (maxVal / maxLimit) * 100;

            rangeFill.style.left = minPercent + '%';
            rangeFill.style.width = (maxPercent - minPercent) + '%';
            minHandle.style.left = minPercent + '%';
            maxHandle.style.left = maxPercent + '%';
            minDisplay.innerText = 'Rp ' + (minVal * 1000).toLocaleString('id-ID');
            maxDisplay.innerText = 'Rp ' + (maxVal * 1000).toLocaleString('id-ID');
        }
        document.addEventListener('DOMContentLoaded', updateRangeUI);
    </script>
</x-layoutCategories>