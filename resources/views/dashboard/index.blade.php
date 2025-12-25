@extends('layouts.dashboard')

@section('content')
<!-- TITLE -->
<h1 class="text-2xl font-semibold text-gray-800 mb-6">
    Dashboard
</h1>

<!-- STAT CARDS -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-sm text-gray-500">Total Produk</h3>
        <p class="text-3xl font-bold mt-2">24</p>
    </div>
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-sm text-gray-500">Total Pesanan</h3>
        <p class="text-3xl font-bold mt-2">120</p>
    </div>
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-sm text-gray-500">Pendapatan</h3>
        <p class="text-3xl font-bold mt-2">Rp 12.500.000</p>
    </div>
</div>

<!-- SALES CHART -->
<div class="bg-white p-6 rounded-xl shadow mb-10">
    <h2 class="text-lg font-semibold text-gray-700 mb-6">
        Statistik Penjualan (Bulanan)
    </h2>
    <div class="flex items-end gap-6 h-64">
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
        <div class="flex-1 flex flex-col items-center justify-end">
            <div class="w-full bg-indigo-600 rounded-t-lg flex items-end justify-center"
                 style="height: {{ $d['tinggi'] }}px">
                <span class="text-white text-xs mb-1">{{ $d['nilai'] }}</span>
            </div>
            <span class="mt-2 text-xs text-gray-500">{{ $d['bulan'] }}</span>
        </div>
        @endforeach
    </div>
</div>

@endsection
