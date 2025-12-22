@extends('layouts.dashboard')

@section('content')
<h1 class="text-2xl font-bold mb-6">Data Produk</h1>

<div class="bg-white rounded-xl shadow p-6">

    <!-- HEADER + FILTER -->
    <div class="flex flex-col gap-4 mb-6">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-700">Daftar Produk</h2>
            <a href="{{ route('products.create') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-lg">Create</a>
        </div>

        <!-- FILTER FORM -->
        <form method="GET" action="{{ route('products.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-3">
            <!-- Search -->
            <div class="col-span-1 md:col-span-2">
                <label class="block text-xs text-gray-500 mb-1">Cari</label>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari produk..."
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Category -->
            <div>
                <label class="block text-xs text-gray-500 mb-1">Kategori</label>
                <select name="category"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">Semua</option>
                    <option value="Pria" {{ request('category') == 'Pria' ? 'selected' : '' }}>Pria</option>
                    <option value="Wanita" {{ request('category') == 'Wanita' ? 'selected' : '' }}>Wanita</option>
                    <option value="Unisex" {{ request('category') == 'Unisex' ? 'selected' : '' }}>Unisex</option>
                </select>
            </div>

            <!-- Sort -->
            <div>
                <label class="block text-xs text-gray-500 mb-1">Urutkan</label>
                <select name="sort" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">Default</option>
                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama A–Z</option>
                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama Z–A</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                </select>
            </div>

            <!-- Price Range -->
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Harga Min</label>
                    <input type="number" name="price_min" value="{{ request('price_min') }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        min="0">
                </div>
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Harga Max</label>
                    <input type="number" name="price_max" value="{{ request('price_max') }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        min="0">
                </div>
            </div>



            <!-- Actions -->
            <div class="flex items-end gap-2 md:col-span-5">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-lg">Terapkan
                    Filter</button>
                <a href="{{ route('products.index') }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm px-4 py-2 rounded-lg">Reset</a>
            </div>
        </form>
    </div>


    <!-- TABLE -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-600">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                <tr>
                    <th class="px-6 py-3">Gambar</th>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Kategori</th>
                    <th class="px-6 py-3">Harga</th>
                    <th class="px-6 py-3">Stok</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody id="productTable">
                @forelse ($products as $product)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-6 py-4">
                        @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                            class="w-14 h-14 rounded-lg object-cover">
                        @else
                        <span class="text-xs text-gray-400">No Image</span>
                        @endif
                    </td>

                    <td class="px-6 py-4 font-medium text-gray-800">
                        {{ $product->name }}
                    </td>

                    <td class="px-6 py-4">
                        @if($product->category)
                        <span class="px-3 py-1 text-xs rounded-full
            {{ $product->category->name == 'Wanita' ? 'bg-pink-100 text-pink-700' : '' }}
            {{ $product->category->name == 'Pria' ? 'bg-blue-100 text-blue-700' : '' }}
            {{ $product->category->name == 'Unisex' ? 'bg-purple-100 text-purple-700' : '' }}">

                            {{ $product->category->name }}
                        </span>
                        @else
                        <span class="text-xs text-gray-400">Tanpa Kategori</span>
                        @endif
                    </td>

                    <td class="px-6 py-4">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $product->stock }}
                    </td>

                    <td class="px-6 py-4 text-center space-x-2">
                        <a href="{{ route('products.edit', $product->id) }}"
                            class="px-3 py-1 text-xs text-white bg-yellow-400 rounded hover:bg-yellow-500">
                            Edit
                        </a>

                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline"
                            onsubmit="return confirm('Yakin mau hapus produk {{ $product->name }}?');">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1 text-xs text-white bg-red-500 rounded hover:bg-red-600">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-6 text-gray-400">
                        Belum ada produk
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>

<!-- Optional: Client-side quick filter on current page results -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.querySelector('input[name="q"]');
        if (!input) return;
        const tableBody = document.getElementById('productTable');
        const url = "{{ route('products.index') }}";

        let timer = null;

        input.addEventListener('input', function() {
            clearTimeout(timer);
            timer = setTimeout(() => {
                const q = input.value;

                // preserve other filters in querystring
                const params = new URLSearchParams(window.location.search);
                if (q) params.set('q', q);
                else params.delete('q');

                fetch(url + '?' + params.toString(), {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        const products = data.products || [];

                        if (products.length === 0) {
                            tableBody.innerHTML = `<tr><td colspan="6" class="text-center py-6 text-gray-400">Belum ada produk</td></tr>`;
                            return;
                        }

                        tableBody.innerHTML = products.map(p => `
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4">${p.image ? `<img src="${p.image}" class="w-14 h-14 rounded-lg object-cover">` : `<span class="text-xs text-gray-400">No Image</span>`}</td>
                            <td class="px-6 py-4 font-medium text-gray-800">${escapeHtml(p.name)}</td>
                            <td class="px-6 py-4"><span class="px-3 py-1 text-xs rounded-full ${p.category == 'Wanita' ? 'bg-pink-100 text-pink-700' : ''} ${p.category == 'Pria' ? 'bg-blue-100 text-blue-700' : ''} ${p.category == 'Unisex' ? 'bg-purple-100 text-purple-700' : ''}">${p.category}</span></td>
                            <td class="px-6 py-4">Rp ${Number(p.price).toLocaleString('id-ID')}</td>
                            <td class="px-6 py-4">${p.stock}</td>
                            <td class="px-6 py-4 text-center space-x-2">
                                <a href="/dashboard/products/${p.id}/edit" class="px-3 py-1 text-xs text-white bg-yellow-400 rounded hover:bg-yellow-500">Edit</a>

                                <form action="/dashboard/products/${p.id}" method="POST" class="inline" onsubmit="return confirm('Yakin mau hapus produk ${escapeHtml(p.name)}?');">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="px-3 py-1 text-xs text-white bg-red-500 rounded hover:bg-red-600">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    `).join('');
                    })
                    .catch(err => console.error(err));
            }, 300);
        });

        function escapeHtml(unsafe) {
            return unsafe ? unsafe.replace(/[&<>"'\/]/g, function(m) {
                return ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#039;',
                    '/': '&#x2F;'
                })[m];
            }) : '';
        }
    });
</script>
@endsection
