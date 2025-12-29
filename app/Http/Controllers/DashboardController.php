<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil Total Produk
        $totalProduk = Product::count();

        // 2. Ambil Total Pesanan
        $totalPesanan = Order::count();

        // 3. Ambil Total Pendapatan
        $totalPendapatan = Order::sum('subtotal');

        // 4. Ambil Data Penjualan (Gunakan cara yang kompatibel dengan SQLite & MySQL)
        // Kita ambil semua pesanan dalam 5 bulan terakhir
        $allOrders = Order::where('created_at', '>=', now()->subMonths(5))
            ->orderBy('created_at', 'asc')
            ->get();

        // Kelompokkan di level PHP (Collection) agar tidak bentrok dengan syntax SQL
        $chartData = $allOrders->groupBy(function($order) {
            // Kelompokkan berdasarkan format "Tahun-Bulan" (misal: 2023-12)
            return Carbon::parse($order->created_at)->format('Y-m');
        })->map(function ($group, $key) {
            return [
                'bulan' => Carbon::parse($key . '-01')->translatedFormat('M'), // Jan, Feb, dst.
                'nilai' => $group->count(),
            ];
        })->values();

        // Hitung tinggi bar secara proporsional
        $maxSales = $chartData->max('nilai') ?: 1;
        $chartData = $chartData->map(function ($item) use ($maxSales) {
            return [
                'bulan' => $item['bulan'],
                'nilai' => $item['nilai'],
                'tinggi' => ($item['nilai'] / $maxSales) * 200
            ];
        });

        return view('dashboard.index', compact('totalProduk', 'totalPesanan', 'totalPendapatan', 'chartData'));
    }
}