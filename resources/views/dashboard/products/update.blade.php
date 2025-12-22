@extends('layouts.dashboard')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Produk</h1>

<div class="bg-white rounded-xl shadow p-8 w-full">
    <form action="{{ route('products.update', $product->id) }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-6">

        @csrf

        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
            <input
                type="text"
                name="name"
                value="{{ old('name', $product->name) }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
            <select name="category_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="">Pilih Kategori</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ (old('category_id', $product->category_id) == $cat->id) ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Produk</label>
            <div class="flex items-center gap-6">
                @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="w-24 h-24 rounded-lg object-cover border">
                @else
                <div class="w-24 h-24 flex items-center justify-center rounded-lg border text-gray-400 text-xs">No Image</div>
                @endif
                <input type="file" name="image" class="block text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-600 file:text-white hover:file:bg-indigo-700">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
            <input type="number" name="price" value="{{ old('price', $product->price) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <textarea name="description" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="flex gap-4 pt-4">
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-8 py-2 rounded-lg text-sm font-medium">
                Update
            </button>
            <a href="{{ route('products.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-8 py-2 rounded-lg text-sm font-medium">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection