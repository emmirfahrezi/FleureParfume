<div class="bg-white shadow-md rounded-xl p-6 mb-8">
    <!-- Title -->
    <h2 class="text-2xl font-semibold mb-4">Cari Produk</h2>

    <!-- Search & Filter Form -->
    <form class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
        <!-- Search Bar -->
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-600 mb-1">Nama Produk</label>
            <input type="text" placeholder="Cari produk..."
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <!-- Category Filter -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Kategori</label>
            <select
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="">Semua</option>
                <option value="Pria">Pria</option>
                <option value="Wanita">Wanita</option>
                <option value="Unisex">Unisex</option>
            </select>
        </div>

        <!-- Price Min -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Harga Min</label>
            <input type="number" placeholder="0"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <!-- Price Max -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Harga Max</label>
            <input type="number" placeholder="0"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <!-- Button Submit -->
        <div class="md:col-span-5 flex gap-2">
            <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm transition">
                Terapkan Filter
            </button>
            <button type="reset"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm transition">
                Reset
            </button>
        </div>
    </form>
</div>
