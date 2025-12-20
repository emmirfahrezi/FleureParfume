<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function downloadUserReport()
    {
        // Ambil dari databse
        $users = User::all();

        // siapkan data untuk dikirim ke view
        $data = [
            'title' => 'Laporan Pengguna',
            'date' => date('m/d/Y'),
            'users' => $users
        ];

        // load view khusus untuk pdf
        $pdf = Pdf::loadView('report.users_pdf', $data);

        // download file pdf
        return $pdf->download('laporan-pengguna.pdf');
        }

        public function downloadProductReport()
    {
        // 1. Ambil semua data produk
        $products = Product::all();

        // 2. Data untuk dikirim ke view
        $data = [
            'title' => 'Laporan Inventaris Produk',
            'date' => date('d F Y'),
            'products' => $products
        ];

        // 3. Load view khusus produk
        // Pastikan file ini ada di: resources/views/report/products_pdf.blade.php
        $pdf = Pdf::loadView('report.products_pdf', $data);

        // 4. Download file
        return $pdf->download('daftar-produk-' . date('Ymd') . '.pdf');
    }
}
