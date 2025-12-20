@extends('layouts.dashboard')

@section('content')
<h1 class="text-2xl font-bold mb-6">Detail Pesanan</h1>

<div class="bg-white rounded-xl shadow p-6 space-y-6">

    <!-- INFO PESANAN -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
        <p><strong>ID Pesanan:</strong> #ORD-001</p>
        <p><strong>Tanggal Pesanan:</strong> 20 Des 2025</p>
        <p><strong>Nama Customer:</strong> Najran Al-Faresy</p>
        <p>
            <strong>Status:</strong>
            <span class="ml-2 px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                Belum Dibayar
            </span>
        </p>
    </div>

    <!-- ALAMAT -->
    <div>
        <h2 class="text-lg font-semibold text-gray-800 mb-2">Alamat Pengiriman</h2>
        <p class="text-sm text-gray-600">
            Jl. Merdeka No. 123, Kecamatan Sukajadi,<br>
            Kota Bandung, Jawa Barat 40161
        </p>
    </div>

    <!-- PRODUK -->
    <div>
        <h2 class="text-lg font-semibold text-gray-800 mb-3">Produk Dipesan</h2>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="text-xs uppercase bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-center">Produk</th>
                        <th class="px-6 py-3 text-center">Harga</th>
                        <th class="px-6 py-3 text-center">Jumlah</th>
                        <th class="px-6 py-3 text-center">Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="border-b">
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-4">
                                <img src="{{ asset('images/products/parfum1.jpg') }}"
                                     class="w-16 h-16 rounded-lg object-cover">
                                <span class="font-medium text-gray-800">
                                    Fleur Rose
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            Rp 250.000
                        </td>
                        <td class="px-6 py-4 text-center">
                            2
                        </td>
                        <td class="px-6 py-4 text-center font-semibold">
                            Rp 500.000
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-4">
                                <img src="{{ asset('images/products/parfum2.jpg') }}"
                                     class="w-16 h-16 rounded-lg object-cover">
                                <span class="font-medium text-gray-800">
                                    Noir Homme
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            Rp 250.000
                        </td>
                        <td class="px-6 py-4 text-center">
                            1
                        </td>
                        <td class="px-6 py-4 text-center font-semibold">
                            Rp 250.000
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- TOTAL -->
    <div class="flex justify-end">
        <div class="w-full md:w-1/3 bg-gray-50 rounded-lg p-4">
            <div class="flex justify-between text-sm text-gray-600 mb-2">
                <span>Subtotal</span>
                <span>Rp 750.000</span>
            </div>
            <div class="flex justify-between text-sm text-gray-600 mb-2">
                <span>Ongkir</span>
                <span>Rp 0</span>
            </div>
            <div class="flex justify-between text-lg font-bold text-gray-800 border-t pt-2">
                <span>Total</span>
                <span>Rp 750.000</span>
            </div>
        </div>
    </div>
</div>

<!-- BACK -->
<a href="/pesanan"
   class="inline-flex items-center gap-2 mt-6 px-5 py-2.5
          bg-indigo-600 text-white text-sm font-semibold
          rounded-lg shadow
          hover:bg-indigo-700 transition">
    ← Kembali
</a>

@endsection
