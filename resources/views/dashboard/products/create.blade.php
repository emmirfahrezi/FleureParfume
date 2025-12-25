@extends('layouts.dashboard')

@section('content')
@if ($errors->any())
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
    <strong class="font-bold">Waduh! Ada yang salah nih:</strong>
    <ul class="mt-2 list-disc list-inside">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<h1 class="text-2xl font-bold mb-6">Tambah Produk</h1>

<div class="bg-white rounded-xl shadow p-6 max-w-2xl">
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <!-- Nama Produk -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Nama Produk
            </label>
            <input
                type="text"
                name="name"
                required
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                       focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <!-- Deskripsi -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Deskripsi <span class="text-gray-400 text-xs">(Maks. 25 Kata)</span>
            </label>
            <textarea
                name="description"
                rows="3"
                placeholder=""
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                       focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>

            @error('description')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Kategori -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Kategori
            </label>
            <select
                name="category_id"
                required
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">

                <option value="">-- Pilih Kategori --</option>

                @foreach ($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
                @endforeach

            </select>
        </div>

        <!-- Gambar -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Gambar Produk
            </label>
            <input
                type="file"
                name="image"
                accept="image/*"
                class="block w-full text-sm text-gray-700
                       file:mr-4 file:py-2 file:px-4
                       file:rounded-lg file:border-0
                       file:bg-indigo-600 file:text-white
                       hover:file:bg-indigo-700">
        </div>

        <!-- Harga -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Harga
            </label>
            <input
                type="number"
                name="price"
                required
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                       focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <!-- Stok -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Stok
            </label>
            <input
                type="number"
                name="stock"
                required
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm
                       focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <!-- Button -->
        <div class="flex gap-3">
            <button
                type="submit"
                class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg text-sm">
                Simpan
            </button>

            <a
                href="{{ route('products.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg text-sm">
                Batal
            </a>
        </div>
    </form>
</div>

<script>
document.querySelector('form').addEventListener('submit', () => {
    localStorage.setItem('product_created', 'true');
});
</script>

@endsection