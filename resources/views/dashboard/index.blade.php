@extends('layouts.dashboard')

@section('content')
<!-- TITLE -->
<h1 class="text-2xl font-semibold text-gray-800 mb-6">
    Dashboard
</h1>
<!-- STAT CARDS -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
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
        <p class="text-3xl font-bold mt-2">
            Rp 12.500.000
        </p>
    </div>
</div>
<!-- SALES CHART -->
<div class="bg-white mt-10 p-6 rounded-xl shadow">
    <h2 class="text-lg font-semibold text-gray-700 mb-6">
        Statistik Penjualan (Bulanan)
    </h2>
    <!-- CHART WRAPPER -->
    <div class="flex items-end gap-6 h-64">
        <!-- JAN -->
        <div class="flex-1 flex flex-col items-center justify-end">
            <div class="w-full bg-indigo-600 rounded-t-lg flex items-end justify-center h-[120px]">
                <span class="text-white text-xs mb-1">60</span>
            </div>
            <span class="mt-2 text-xs text-gray-500">Jan</span>
        </div>
        <!-- FEB -->
        <div class="flex-1 flex flex-col items-center justify-end">
            <div class="w-full bg-indigo-600 rounded-t-lg flex items-end justify-center h-[180px]">
                <span class="text-white text-xs mb-1">80</span>
            </div>
            <span class="mt-2 text-xs text-gray-500">Feb</span>
        </div>
        <!-- MAR -->
        <div class="flex-1 flex flex-col items-center justify-end">
            <div class="w-full bg-indigo-600 rounded-t-lg flex items-end justify-center h-[100px]">
                <span class="text-white text-xs mb-1">50</span>
            </div>
            <span class="mt-2 text-xs text-gray-500">Mar</span>
        </div>
        <!-- APR -->
        <div class="flex-1 flex flex-col items-center justify-end">
            <div class="w-full bg-indigo-600 rounded-t-lg flex items-end justify-center h-[220px]">
                <span class="text-white text-xs mb-1">90</span>
            </div>
            <span class="mt-2 text-xs text-gray-500">Apr</span>
        </div>
        <!-- MEI -->
        <div class="flex-1 flex flex-col items-center justify-end">
            <div class="w-full bg-indigo-600 rounded-t-lg flex items-end justify-center h-[150px]">
                <span class="text-white text-xs mb-1">70</span>
            </div>
            <span class="mt-2 text-xs text-gray-500">Mei</span>
        </div>
    </div>
</div>

@endsection
