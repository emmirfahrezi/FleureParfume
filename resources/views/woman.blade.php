<x-layoutCategories>

    {{--
        =======================================================
        BAGIAN 1: HERO SECTION
        Ganti background image-nya di sini sesuai folder lu.
        =======================================================
    --}}
    <style>
        .hero-bg-woman {
            /* Pastikan path gambar bener ya Bang */
            background-image: linear-gradient(135deg, rgba(90, 62, 43, 0.7) 0%, rgba(0, 0, 0, 0.5) 100%),
            url("{{ asset('images/products/thumbnail.jpg') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        /* CSS Fix biar Slider Enak Digeser */
        input[type=range]::-webkit-slider-thumb {
            pointer-events: auto;
            width: 20px;
            height: 20px;
            -webkit-appearance: none;
        }
    </style>

    <div class="relative isolate px-6 pt-20 lg:px-20 h-[400px] hero-bg-woman">
        <div class="w-full py-6 sm:py-8 lg:py-16 flex flex-col gap-4 text-white">
            <div class="flex items-center gap-2 text-sm sm:text-base text-gray-200" style="font-family: poppins, sans-serif;">
                <a href="/" class="hover:underline text-gray-300">Home</a>
                <span class="text-gray-400">/</span>
                <span class="text-white">Women</span>
            </div>
            <h1 class="text-5xl sm:text-6xl lg:text-7xl font-light tracking-wide text-white" style="font-family: cormorant, serif !important;">
                WOMEN
            </h1>
        </div>
    </div>

    {{--
        =======================================================
        BAGIAN 2: LIST PRODUK & TOOLBAR
        =======================================================
    --}}
    <div class="relative isolate px-6 pt-14 lg:px-20 min-h-screen py-10">

        <div class="w-full flex items-center justify-between py-4 border-b border-gray-200">
            {{-- Tombol Filter --}}
            <div class="flex items-center gap-3 text-black cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M6 12h12M10 18h4" />
                </svg>
                <button onclick="openFilter()" class="flex items-center gap-2 font-medium hover:text-gray-600">Filter Products</button>
            </div>

            <div class="flex items-center gap-6 text-gray-700">
                {{-- Sort Dropdown --}}
                <div class="relative">
                    <button onclick="toggleSortDropdown()" class="flex items-center gap-2 cursor-pointer text-base">
                        <span id="sortLabel">Sort Products</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="sortDropdown" class="hidden absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                        <ul class="py-2 text-sm">
                            <li onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort' => null]) }}'" class="px-4 py-2 hover:bg-gray-100 cursor-pointer border-b">Default</li>
                            <li onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}'" class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Price: Low to High</li>
                            <li onclick="window.location.href='{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}'" class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Price: High to Low</li>
                        </ul>
                    </div>
                </div>

                {{-- View Toggle (Grid/List) --}}
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

        {{-- Loop Produk --}}
        <div class="max-w-7xl mx-auto mt-12">
            @if (isset($products) && $products->count() > 0)
            {{-- Tampilan Grid --}}
            <div id="productsGrid" class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($products as $product)
                <a href="/detailProduk/{{ $product->id }}" class="bg-white rounded-lg shadow-md hover:shadow-xl transition block group p-2 border border-gray-100">
                    <div class="relative w-full h-64 overflow-hidden rounded-md">
                        @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400 text-xs">No Image</div>
                        @endif
                    </div>
                    <div class="pt-3 px-1">
                        <h4 class="text-xs text-gray-500 mb-1">{{ $product->category->name ?? 'Women' }}</h4>
                        <h3 class="text-base font-semibold text-gray-900 truncate" style="font-family: cormorant, serif !important;">{{ $product->name }}</h3>
                        <p class="text-xs text-gray-600 mt-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                </a>
                @endforeach
            </div>

            {{-- Tampilan List (Hidden by default) --}}
            <div id="productsList" class="hidden space-y-4">
                @foreach ($products as $product)
                <a href="/detailProduk/{{ $product->id }}" class="bg-white rounded-xl shadow-md flex flex-col sm:flex-row overflow-hidden border border-gray-100 group">
                    <div class="relative w-full sm:w-48 h-48 overflow-hidden flex-shrink-0">
                        @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">No Image</div>
                        @endif
                    </div>
                    <div class="p-4 sm:p-6 flex flex-col justify-center flex-grow gap-2">
                        <h3 class="text-2xl font-semibold text-gray-900" style="font-family: cormorant, serif !important;">{{ $product->name }}</h3>
                        <p class="text-lg text-gray-700 font-medium">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <button class="mt-2 px-6 py-2 rounded-full text-sm font-semibold text-white bg-black w-fit hover:bg-gray-800 transition">View Details</button>
                    </div>
                </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-8 flex justify-center">
                {{ $products->links() }}
            </div>
            @else
            <div class="text-center py-20 text-gray-500">
                Produk tidak ditemukan.<br>
                <a href="{{ request()->url() }}" class="text-black underline">Reset Filter</a>
            </div>
            @endif
        </div>
    </div>

    {{-- Overlay Gelap --}}
    <div id="overlay" class="fixed inset-0 bg-black/40 opacity-0 pointer-events-none transition-opacity duration-300 z-40"></div>

    {{--
        =======================================================
        BAGIAN 3: SIDEBAR FILTER (INI YANG PALING KRUSIAL)
        =======================================================
    --}}
    <div id="filterSidebar" class="fixed top-0 left-0 h-full w-[360px] bg-white -translate-x-full transition-transform duration-300 ease-in-out z-50 overflow-y-auto shadow-2xl">
        <div class="flex justify-between items-center p-6 border-b">
            <h2 class="font-bold uppercase tracking-widest">Filters</h2>
            <button onclick="closeFilter()" class="text-2xl hover:text-red-500">&times;</button>
        </div>

        <form action="{{ request()->url() }}" method="GET">
            @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif

            {{--
                🔥 UPDATE SEARCH 🔥
                Di controller lu, lu pake $request->q (cek CategoryPageController baris 15).
                Jadi name di input ini HARUS 'q', bukan 'search'. Kalau 'search', gak bakal kebaca controller.
            --}}
            <div class="px-6 mt-6">
                <div class="flex border rounded-md overflow-hidden hover:border-black transition">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search products..." class="w-full px-4 py-2 outline-none text-sm">
                    <button type="submit" class="bg-black text-white px-4 hover:bg-gray-800 transition">&gt;</button>
                </div>
            </div>

            {{-- Price Slider (UI Udah Fix) --}}
            <div class="px-6 mt-10">
                <h2 class="text-3xl font-light mb-6" style="font-family: 'Playfair Display', serif;">Filter by<br>Price</h2>

                <div class="range-slider mb-8 relative w-full h-1 bg-gray-200 rounded-full mt-2">
                    <div id="rangeFill" class="absolute h-full bg-black rounded-full z-10"></div>
                    <div id="minHandle" class="absolute -top-1.5 w-4 h-4 bg-black rounded-full -translate-x-1/2 pointer-events-none z-20 shadow"></div>
                    <div id="maxHandle" class="absolute -top-1.5 w-4 h-4 bg-black rounded-full -translate-x-1/2 pointer-events-none z-20 shadow"></div>

                    {{-- Input Range (Invisible) --}}
                    <input type="range" name="min_price" id="inputMin" min="0" max="500" value="{{ request('min_price', 0) }}" step="1" oninput="updateRangeUI()" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-30 appearance-none">
                    <input type="range" name="max_price" id="inputMax" min="0" max="500" value="{{ request('max_price', 500) }}" step="1" oninput="updateRangeUI()" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-30 appearance-none">
                </div>

                <div class="flex justify-between items-center gap-4 mb-6">
                    <div class="border px-3 py-2 text-xs w-24 text-center rounded bg-gray-50" id="minDisplay">Rp 0</div>
                    <div class="border px-3 py-2 text-xs w-24 text-center rounded bg-gray-50" id="maxDisplay">Rp 500.000</div>
                </div>

                <button type="submit" class="w-full bg-black text-white py-3 rounded text-xs font-bold hover:bg-gray-800 transition tracking-widest uppercase">Apply Filter</button>
            </div>
        </form>

        {{--
            🔥 UPDATE LOGIC CATEGORY LINKS 🔥
            Jangan pake 'fullUrlWithQuery' di sini. Itu cuma nambah parameter di URL.
            Kalau lu di halaman Woman, terus klik filter Pria pake itu, hasilnya jadi:
            "Cari produk yang kategorinya Wanita DAN juga Pria". Hasilnya pasti 0 (Kosong).

            SOLUSI: Pake 'route()' biar dia pindah halaman sepenuhnya, TAPI
            pake 'request()->only(...)' biar filter harga & search tetep kebawa pas pindah.
        --}}
        <div class="px-6 mt-14 mb-10">
            <h3 class="text-xs mb-6 tracking-widest text-gray-400 uppercase font-bold">Filter by Category</h3>
            <ul class="space-y-4 font-semibold text-gray-700">
                <li>
                    <a href="{{ route('exclusive.index', request()->only(['q', 'min_price', 'max_price', 'sort'])) }}"
                        class="{{ request()->routeIs('exclusive.index') ? 'text-black underline font-bold' : 'hover:text-black' }}">Exclusive</a>
                </li>
                <li>
                    <a href="{{ route('man.index', request()->only(['q', 'min_price', 'max_price', 'sort'])) }}"
                        class="{{ request()->routeIs('man.index') ? 'text-black underline font-bold' : 'hover:text-black' }}">Pria</a>
                </li>
                <li>
                    <a href="{{ route('woman.index', request()->only(['q', 'min_price', 'max_price', 'sort'])) }}"
                        class="{{ request()->routeIs('woman.index') ? 'text-black underline font-bold' : 'hover:text-black' }}">Wanita</a>
                </li>
                <li>
                    <a href="{{ route('unisex.index', request()->only(['q', 'min_price', 'max_price', 'sort'])) }}"
                        class="{{ request()->routeIs('unisex.index') ? 'text-black underline font-bold' : 'hover:text-black' }}">Unisex</a>
                </li>
                <li class="pt-4 border-t">
                    <a href="{{ request()->url() }}" class="text-red-500 text-xs font-normal underline hover:text-red-700">Clear All Filters</a>
                </li>
            </ul>
        </div>
    </div>

    {{--
        =======================================================
        BAGIAN 4: SCRIPT UTAMA BIAR FITUR JALAN SEMUA
        Wajib ada di paling bawah body.
        =======================================================
    --}}
    <script>
        // --- 1. Script Sidebar (Open/Close) ---
        const filterSidebar = document.getElementById('filterSidebar');
        const overlay = document.getElementById('overlay');

        function openFilter() {
            filterSidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('opacity-0', 'pointer-events-none');
            document.body.style.overflow = 'hidden'; // Biar body gak bisa discroll
        }

        function closeFilter() {
            filterSidebar.classList.add('-translate-x-full');
            overlay.classList.add('opacity-0', 'pointer-events-none');
            document.body.style.overflow = 'auto';
        }
        overlay.addEventListener('click', closeFilter);

        // --- 2. View Toggle (Grid vs List) ---
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

        // --- 3. Dropdown Sort ---
        function toggleSortDropdown() {
            document.getElementById('sortDropdown').classList.toggle('hidden');
        }
        // Tutup dropdown kalau klik sembarang
        window.onclick = function(event) {
            if (!event.target.closest('button[onclick="toggleSortDropdown()"]')) {
                document.getElementById('sortDropdown').classList.add('hidden');
            }
        }

        // --- 4. Range Slider Engine (Biar pentolannya gerak) ---
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
            const maxLimit = 500; // Sesuai max di input HTML

            // Validasi: Min gak boleh nyalip Max
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

            // Update Style CSS Slider
            rangeFill.style.left = minPercent + '%';
            rangeFill.style.width = (maxPercent - minPercent) + '%';
            minHandle.style.left = minPercent + '%';
            maxHandle.style.left = maxPercent + '%';

            // Update Text Rupiah
            minDisplay.innerText = 'Rp ' + (minVal * 1000).toLocaleString('id-ID');
            maxDisplay.innerText = 'Rp ' + (maxVal * 1000).toLocaleString('id-ID');
        }
        // Jalanin sekali pas halaman kelar loading
        document.addEventListener('DOMContentLoaded', updateRangeUI);
    </script>
</x-layoutCategories>