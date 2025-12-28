@extends('layouts.dashboard')

@section('content')

<!-- TITLE -->
<div class="mb-6">
    <h1 class="text-xl sm:text-2xl font-bold text-slate-800">Dashboard Overview</h1>
    <p class="text-sm text-slate-500">Pantau statistik toko Anda di sini.</p>
</div>

<!-- STAT CARDS -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-8">
    <!-- Total Produk -->
    <div class="bg-white p-5 rounded-2xl shadow-sm border border-rose-100 flex items-center gap-4">
        <div class="h-12 w-12 rounded-xl bg-rose-50 flex items-center justify-center text-rose-600">
            <!-- Icon Sederhana (Box) -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
        </div>
        <div>
            <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Produk</h3>
            <p class="text-2xl font-bold text-slate-800">{{ number_format($totalProduk, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Total Pesanan -->
    <div class="bg-white p-5 rounded-2xl shadow-sm border border-rose-100 flex items-center gap-4">
        <div class="h-12 w-12 rounded-xl bg-amber-50 flex items-center justify-center text-amber-600">
            <!-- Icon Sederhana (Shopping Cart) -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div>
        <div>
            <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Pesanan</h3>
            <p class="text-2xl font-bold text-slate-800">{{ number_format($totalPesanan, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Total Pendapatan -->
    <div class="bg-white p-5 rounded-2xl shadow-sm border border-rose-100 flex items-center gap-4 lg:col-span-1 sm:col-span-2">
        <div class="h-12 w-12 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600">
            <!-- Icon Sederhana (Cash) -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div>
            <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Pendapatan</h3>
            <p class="text-2xl font-bold text-slate-800">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
        </div>
    </div>
</div>

<!-- SALES CHART -->
<div class="bg-white p-6 rounded-2xl shadow-sm border border-rose-100 mb-10">
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-lg font-bold text-slate-800">Statistik Penjualan</h2>
        <span class="text-xs bg-rose-50 text-rose-600 px-3 py-1 rounded-full font-medium">5 Bulan Terakhir</span>
    </div>

    <!-- Chart Container -->
    <div class="flex items-end justify-between gap-3 sm:gap-6 h-64 px-2">
        @forelse ($chartData as $d)
            <div class="flex flex-col items-center justify-end flex-1 group">
                <!-- Bar Grafik -->
                <div class="bg-rose-500 rounded-t-xl flex items-end justify-center transition-all duration-500 hover:bg-rose-400 relative w-full max-w-[50px]"
                     style="height: {{ max(40, $d['tinggi']) }}px;">
                    
                    <!-- Tooltip angka saat di-hover -->
                    <span class="absolute -top-10 scale-0 group-hover:scale-100 transition-transform bg-slate-800 text-white text-[10px] px-2 py-1 rounded shadow-xl whitespace-nowrap">
                        {{ $d['nilai'] }} Pesanan
                    </span>

                    <span class="text-white text-[10px] sm:text-xs mb-2 font-bold">{{ $d['nilai'] }}</span>
                </div>
                <!-- Label Bulan -->
                <span class="mt-3 text-[10px] sm:text-sm text-slate-500 font-medium">{{ $d['bulan'] }}</span>
            </div>
        @empty
            <div class="w-full flex flex-col items-center justify-center h-full text-slate-400 py-10">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2 opacity-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                <p class="text-sm italic">Belum ada data penjualan tersedia.</p>
            </div>
        @endforelse
    </div>
</div>

@endsection