@extends('layouts.dashboard')

@section('content')
@if ($errors->any())
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 text-sm sm:text-base">
    <strong class="font-bold">Waduh! Ada yang salah nih:</strong>
    <ul class="mt-2 list-disc list-inside">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<h1 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6">Edit Produk</h1>

<!-- WRAPPER FULL -->
<div class="bg-white rounded-xl shadow p-4 sm:p-8 w-full">
    <form action="{{ route('products.update', $product->id) }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-5 sm:space-y-6 text-sm sm:text-base">
        @csrf
        @method('PUT')

        <!-- Nama Produk -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Nama Produk
            </label>
            <input
                type="text"
                name="name"
                value="{{ old('name', $product->name) }}"
                class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 text-sm
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
                class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 text-sm
                       focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description', $product->description) }}</textarea>

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
                class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 text-sm
                       focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Gambar Produk -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Gambar Produk
            </label>

            <div class="flex flex-col sm:flex-row sm:items-center gap-4 sm:gap-6">
                @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}"
                    class="w-24 h-24 rounded-lg object-cover border self-center sm:self-auto">
                @else
                <div class="w-24 h-24 flex items-center justify-center rounded-lg border text-gray-400 text-xs self-center sm:self-auto">
                    No Image
                </div>
                @endif

                <input
                    type="file"
                    name="image"
                    class="block text-xs sm:text-sm text-gray-700
                           file:mr-3 file:sm:mr-4 file:py-2 file:px-3 sm:file:px-4
                           file:rounded-lg file:border-0
                           file:bg-indigo-600 file:text-white
                           hover:file:bg-indigo-700 w-full sm:w-auto">
            </div>
        </div>

        <!-- Harga -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Harga
            </label>
            <input
                type="number"
                name="price"
                value="{{ old('price', $product->price) }}"
                class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 text-sm
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
                value="{{ old('stock', $product->stock) }}"
                class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 text-sm
                       focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <!-- BUTTON -->
        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 pt-4">
            <button
                type="submit"
                class="w-full sm:w-auto bg-yellow-500 hover:bg-yellow-600 text-white px-6 sm:px-8 py-2 rounded-lg text-sm font-medium text-center">
                Update
            </button>

            <a
                href="/dashboard/products"
                class="w-full sm:w-auto bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 sm:px-8 py-2 rounded-lg text-sm font-medium text-center">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
