@extends('layouts.dashboard')

@section('content')
<h1 class="text-2xl font-bold mb-6">Data Produk</h1>

<div class="bg-white rounded-xl shadow p-6">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <h2 class="text-lg font-semibold text-gray-700">
            Daftar Produk
        </h2>

        <div class="flex gap-2">
            <!-- SEARCH -->
            <input
                type="text"
                id="searchInput"
                placeholder="Cari produk..."
                class="border border-gray-300 rounded-lg px-4 py-2 text-sm
                       focus:outline-none focus:ring-2 focus:ring-indigo-500">

            <a href=""
                class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-lg">
                Cari
            </a>
            <a href="{{ route('products.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-lg">create</a>
        </div>
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
                        <span class="px-3 py-1 text-xs rounded-full
                    {{ $product->category == 'Wanita' ? 'bg-pink-100 text-pink-700' : '' }}
                    {{ $product->category == 'Pria' ? 'bg-blue-100 text-blue-700' : '' }}
                    {{ $product->category == 'Unisex' ? 'bg-purple-100 text-purple-700' : '' }}">
                            {{ $product->category }}
                        </span>
                    </td>

                    <td class="px-6 py-4">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $product->stock }}
                    </td>

                    <td class="px-6 py-4 text-center space-x-2">
                        <a href="#"
                            class="px-3 py-1 text-xs text-white bg-yellow-400 rounded hover:bg-yellow-500">
                            Edit
                        </a>

                        <form action="{{ route('products.destroy', $product->id) }}"
                            method="POST"
                            class="inline"
                            onsubmit="return confirm('Yakin mau hapus produk {{ $product->name }}?');">
                            @csrf
                            @method('DELETE')
                            <button
                                class="px-3 py-1 text-xs text-white bg-red-500 rounded hover:bg-red-600">
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

<!-- SEARCH SCRIPT -->
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let value = this.value.toLowerCase();
        let rows = document.querySelectorAll('#productTable tr');

        rows.forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(value) ?
                '' :
                'none';
        });
    });
</script>
@endsection