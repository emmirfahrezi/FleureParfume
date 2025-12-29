@extends('layouts.dashboard')

@section('content')
<!-- Popup Success -->
<x-popup.popup-create-success />
<x-popup.popup-update-success />
<x-popup.popup-delete-success />

<h1 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6">Data Produk</h1>

<div class="bg-white rounded-xl shadow p-3 sm:p-6">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
        <h2 class="text-base sm:text-lg font-semibold text-gray-700">Daftar Produk</h2>
        <a href="{{ route('products.create') }}"
            class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs sm:text-sm px-4 py-2 rounded-lg text-center">
            + Tambah Produk
        </a>
    </div>

    <!-- FILTERS -->
    <div class="space-y-3 sm:space-y-0 mb-6">
        <!-- BARIS 1: CARI + KATEGORI -->
        <div class="flex flex-wrap gap-2 sm:gap-3">
            <!-- Cari Nama -->
            <div class="flex-1 min-w-[140px]">
                <label class="block text-[10px] sm:text-xs text-gray-500 mb-0.5">Cari Nama</label>
                <input type="text" id="searchInput" placeholder="Cari produk..."
                    class="w-full border border-gray-300 rounded-lg px-2 sm:px-3 py-1.5 sm:py-2 text-[11px] sm:text-sm focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Kategori -->
            <div class="flex-1 min-w-[120px]">
                <label class="block text-[10px] sm:text-xs text-gray-500 mb-0.5">Kategori</label>
                <select id="categorySelect"
                    class="w-full border border-gray-300 rounded-lg px-2 sm:px-3 py-1.5 sm:py-2 text-[11px] sm:text-sm">
                    <option value="">Semua</option>
                    <option value="Pria">Pria</option>
                    <option value="Wanita">Wanita</option>
                    <option value="Unisex">Unisex</option>
                </select>
            </div>
        </div>

        <!-- BARIS 2: URUTKAN + MIN + MAX -->
        <div class="grid grid-cols-3 gap-2 sm:gap-3">
            <!-- Urutkan -->
            <div>
                <label class="block text-[10px] sm:text-xs text-gray-500 mb-0.5">Urutkan</label>
                <select id="sortSelect"
                    class="w-full border border-gray-300 rounded-lg px-2 sm:px-3 py-1.5 sm:py-2 text-[11px] sm:text-sm">
                    <option value="">Default</option>
                    <option value="name_asc">Nama A–Z</option>
                    <option value="name_desc">Nama Z–A</option>
                    <option value="price_asc">Harga Terendah</option>
                    <option value="price_desc">Harga Tertinggi</option>
                </select>
            </div>

            <!-- Min -->
            <div>
                <label class="block text-[10px] sm:text-xs text-gray-500 mb-0.5">Min</label>
                <input type="number" id="minPrice"
                    class="w-full border border-gray-300 rounded-lg px-2 sm:px-3 py-1.5 sm:py-2 text-[11px] sm:text-sm">
            </div>

            <!-- Max -->
            <div>
                <label class="block text-[10px] sm:text-xs text-gray-500 mb-0.5">Max</label>
                <input type="number" id="maxPrice"
                    class="w-full border border-gray-300 rounded-lg px-2 sm:px-3 py-1.5 sm:py-2 text-[11px] sm:text-sm">
            </div>
        </div>
    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto rounded-lg border border-gray-100">
        <table class="w-full text-[11px] sm:text-sm text-left text-gray-600">
            <thead class="text-[10px] sm:text-xs text-gray-700 uppercase bg-gray-100">
                <tr>
                    <th class="px-2 sm:px-4 py-2 sm:py-3">Gambar</th>
                    <th class="px-2 sm:px-4 py-2 sm:py-3">Nama</th>
                    <th class="px-2 sm:px-4 py-2 sm:py-3">Kategori</th>
                    <th class="px-2 sm:px-4 py-2 sm:py-3">Harga</th>
                    <th class="px-2 sm:px-4 py-2 sm:py-3">Stok</th>
                    <th class="px-2 sm:px-4 py-2 sm:py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="productTableBody">
                @foreach ($products as $product)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-2 sm:px-4 py-3 sm:py-4">
                        @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                            class="w-9 h-9 sm:w-12 sm:h-12 rounded-lg object-cover">
                        @else
                        -
                        @endif
                    </td>
                    <td class="px-2 sm:px-4 py-3 sm:py-4 font-medium">{{ $product->name }}</td>
                    <td class="px-2 sm:px-4 py-3 sm:py-4">{{ $product->category->name ?? '-' }}</td>
                    <td class="px-2 sm:px-4 py-3 sm:py-4">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td class="px-2 sm:px-4 py-3 sm:py-4">{{ $product->stock }}</td>
                    <td class="px-2 sm:px-4 py-3 sm:py-4 text-center space-x-1 sm:space-x-2">
                        <a href="{{ route('products.edit', $product->id) }}"
                            class="text-yellow-500 hover:underline text-[11px] sm:text-sm">Edit</a>
                        |
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline"
                            onsubmit="return confirm('Hapus?');">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 hover:underline text-[11px] sm:text-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- SCRIPT LIVE SEARCH --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const inputs = ['searchInput', 'categorySelect', 'sortSelect', 'minPrice', 'maxPrice'];
        const tableBody = document.getElementById('productTableBody');

        function fetchProducts() {
            const q = document.getElementById('searchInput').value;
            const cat = document.getElementById('categorySelect').value;
            const sort = document.getElementById('sortSelect').value;
            const min = document.getElementById('minPrice').value;
            const max = document.getElementById('maxPrice').value;

            fetch(`{{ route('products.index') }}?q=${q}&category=${cat}&sort=${sort}&price_min=${min}&price_max=${max}`, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(res => res.json())
                .then(data => {
                    tableBody.innerHTML = '';
                    if (data.products.length === 0) {
                        tableBody.innerHTML = '<tr><td colspan="6" class="text-center py-4 text-[11px] sm:text-sm">Zonk, gak ada data Bang.</td></tr>';
                        return;
                    }
                    data.products.forEach(p => {
                        let img = p.image ? `<img src="${p.image}" class="w-9 h-9 sm:w-12 sm:h-12 rounded-lg object-cover">` : '-';
                        let price = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(p.price);
                        let row = `
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-2 sm:px-4 py-3 sm:py-4">${img}</td>
                                <td class="px-2 sm:px-4 py-3 sm:py-4 font-medium">${p.name}</td>
                                <td class="px-2 sm:px-4 py-3 sm:py-4">${p.category || '-'}</td>
                                <td class="px-2 sm:px-4 py-3 sm:py-4">${price}</td>
                                <td class="px-2 sm:px-4 py-3 sm:py-4">${p.stock}</td>
                                <td class="px-2 sm:px-4 py-3 sm:py-4 text-center">
                                    <a href="/dashboard/products/${p.id}/edit" class="text-yellow-500 hover:underline text-[11px] sm:text-sm">Edit</a> |
                                    <form action="/dashboard/products/${p.id}" method="POST" class="inline" onsubmit="return confirm('Hapus?');">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="text-red-500 hover:underline text-[11px] sm:text-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>`;
                        tableBody.innerHTML += row;
                    });
                });
        }

        inputs.forEach(id => {
            const el = document.getElementById(id);
            el.addEventListener(id.includes('Select') ? 'change' : 'keyup', fetchProducts);
        });
        document.getElementById('minPrice').addEventListener('change', fetchProducts);
        document.getElementById('maxPrice').addEventListener('change', fetchProducts);
    });
</script>
@endsection
