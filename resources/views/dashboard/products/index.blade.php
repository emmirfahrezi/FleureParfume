@extends('layouts.dashboard')

@section('content')

<!-- PAGE TITLE -->
<div class="mb-10">
    <h1 class="text-4xl font-semibold tracking-wide">
        Data Produk
    </h1>
    <p class="text-sm text-[#6B5B4B] mt-2">
        Kelola produk parfum dengan tampilan premium
    </p>
</div>

<!-- CARD -->
<div class="bg-white rounded-3xl shadow-xl shadow-[#00000010] p-10">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-10">
        <h2 class="text-xl font-medium tracking-wide">
            Daftar Produk
        </h2>

        <a href="{{ route('products.create') }}"
           class="bg-gradient-to-r from-[#8B5A2B] to-[#6F4518]
           hover:from-[#6F4518] hover:to-[#5A3714]
           text-white px-6 py-2 rounded-full text-sm
           shadow-md hover:shadow-lg transition">
            + Tambah Produk
        </a>
    </div>

    <!-- FILTER -->
    <form method="GET" action="{{ route('products.index') }}"
          class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-12">

        <div class="md:col-span-2">
            <label class="text-xs text-[#6B5B4B] tracking-wide">Cari Produk</label>
            <input type="text" name="q" value="{{ request('q') }}"
                   placeholder="Masukkan nama produk..."
                   class="w-full mt-1 px-4 py-3 rounded-xl border
                   focus:ring-2 focus:ring-[#8B5A2B] outline-none">
        </div>

        <div>
            <label class="text-xs text-[#6B5B4B] tracking-wide">Kategori</label>
            <select name="category"
                    class="w-full mt-1 px-4 py-3 rounded-xl border
                    focus:ring-2 focus:ring-[#8B5A2B]">
                <option value="">Semua</option>
                <option value="Pria">Pria</option>
                <option value="Wanita">Wanita</option>
                <option value="Unisex">Unisex</option>
            </select>
        </div>

        <div>
            <label class="text-xs text-[#6B5B4B] tracking-wide">Urutkan</label>
            <select name="sort"
                    class="w-full mt-1 px-4 py-3 rounded-xl border
                    focus:ring-2 focus:ring-[#8B5A2B]">
                <option value="">Default</option>
                <option value="price_asc">Harga Terendah</option>
                <option value="price_desc">Harga Tertinggi</option>
            </select>
        </div>

        <div class="flex gap-2">
            <input type="number" name="price_min" placeholder="Min"
                   class="w-full mt-6 px-4 py-3 rounded-xl border">
            <input type="number" name="price_max" placeholder="Max"
                   class="w-full mt-6 px-4 py-3 rounded-xl border">
        </div>

        <div class="md:col-span-5 flex gap-3 mt-4">
            <button
                class="bg-[#8B5A2B] hover:bg-[#6F4518]
                text-white px-6 py-3 rounded-full text-sm
                shadow hover:shadow-md transition">
                Terapkan Filter
            </button>

            <a href="{{ route('products.index') }}"
               class="bg-[#E7D7C1] hover:bg-[#D6C2A5]
               px-6 py-3 rounded-full text-sm transition">
                Reset
            </a>
        </div>
    </form>

    <!-- TABLE -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="text-xs uppercase tracking-widest text-[#6B5B4B]">
                <tr>
                    <th class="pb-4">Gambar</th>
                    <th class="pb-4">Nama</th>
                    <th class="pb-4">Kategori</th>
                    <th class="pb-4">Harga</th>
                    <th class="pb-4">Stok</th>
                    <th class="pb-4 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($products as $product)
                <tr class="border-t hover:bg-[#FAF6F0] transition">
                    <td class="py-5">
                        <img src="{{ asset('storage/'.$product->image) }}"
                             class="w-16 h-16 rounded-2xl object-cover
                             shadow-sm hover:scale-105 transition">
                    </td>

                    <td class="font-medium">
                        {{ $product->name }}
                    </td>

                    <td>
                        <span class="px-4 py-1 rounded-full text-xs
                        bg-[#EFE3D3] tracking-wide">
                            {{ $product->category }}
                        </span>
                    </td>

                    <td>
                        Rp {{ number_format($product->price,0,',','.') }}
                    </td>

                    <td>
                        {{ $product->stock }}
                    </td>

                    <td class="text-center space-x-2">
                        <a href="{{ route('products.edit',$product->id) }}"
                           class="bg-[#C9A063] hover:bg-[#B08950]
                           text-white px-4 py-1 rounded-full text-xs transition">
                            Edit
                        </a>

                        <form action="{{ route('products.destroy',$product->id) }}"
                              method="POST" class="inline"
                              onsubmit="return confirm('Yakin hapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button
                                class="bg-[#8B3A3A] hover:bg-[#6F2C2C]
                                text-white px-4 py-1 rounded-full text-xs transition">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-10 text-gray-400">
                        Belum ada produk
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
