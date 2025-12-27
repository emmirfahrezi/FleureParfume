@extends('layouts.dashboard')

@section('content')
<!-- TITLE -->
<h1 class="text-lg sm:text-2xl font-semibold text-gray-800 mb-4 sm:mb-6">
    Dashboard
</h1>

<!-- STAT CARDS -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-8 sm:mb-10">
    <div class="bg-white p-4 sm:p-6 rounded-xl shadow text-center">
        <h3 class="text-xs sm:text-sm text-gray-500">Total Produk</h3>
        <p class="text-2xl sm:text-3xl font-bold mt-1 sm:mt-2">24</p>
    </div>
    <div class="bg-white p-4 sm:p-6 rounded-xl shadow text-center">
        <h3 class="text-xs sm:text-sm text-gray-500">Total Pesanan</h3>
        <p class="text-2xl sm:text-3xl font-bold mt-1 sm:mt-2">120</p>
    </div>
    <div class="bg-white p-4 sm:p-6 rounded-xl shadow text-center">
        <h3 class="text-xs sm:text-sm text-gray-500">Pendapatan</h3>
        <p class="text-2xl sm:text-3xl font-bold mt-1 sm:mt-2">Rp 12.500.000</p>
    </div>
</div>

<!-- SALES CHART -->
<div class="bg-white p-4 sm:p-6 rounded-xl shadow mb-8 sm:mb-10">
    <h2 class="text-base sm:text-lg font-semibold text-gray-700 mb-4 sm:mb-6">
        Statistik Penjualan (Bulanan)
    </h2>

    <!-- Chart Container -->
    <div class="flex items-end justify-between gap-2 sm:gap-4 h-48 sm:h-64">
        @php
            $data = [
                ['bulan' => 'Jan', 'tinggi' => 120, 'nilai' => 60],
                ['bulan' => 'Feb', 'tinggi' => 180, 'nilai' => 80],
                ['bulan' => 'Mar', 'tinggi' => 100, 'nilai' => 50],
                ['bulan' => 'Apr', 'tinggi' => 220, 'nilai' => 90],
                ['bulan' => 'Mei', 'tinggi' => 150, 'nilai' => 70],
            ];
        @endphp

        @foreach ($data as $d)
            <div class="flex flex-col items-center justify-end flex-1">
                <div class="bg-indigo-600 rounded-t-lg flex items-end justify-center transition-all duration-300"
                     style="
                         height: {{ max(60, $d['tinggi'] * 0.8) }}px;
                         width: clamp(32px, 10vw, 60px);
                     ">
                    <span class="text-white text-[10px] sm:text-xs mb-1">{{ $d['nilai'] }}</span>
                </div>
                <span class="mt-1 sm:mt-2 text-[10px] sm:text-xs text-gray-500">{{ $d['bulan'] }}</span>
            </div>
        @endforeach
    </div>
</div>

@endsection
