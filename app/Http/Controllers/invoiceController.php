<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    /**
     * Tampilkan invoice di browser (HTML)
     */
    public function show($orderId)
    {
        // Query order dengan eager load relasi
        $order = Order::with(['orderItems.product', 'user'])->findOrFail($orderId);

        // Validasi: user hanya bisa lihat invoice milik mereka
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized. Ini bukan pesanan Anda.');
        }

        // Return view HTML invoice
        return view('invoice.show', compact('order'));
    }

    /**
     * Download invoice sebagai PDF
     */
    public function download($orderId)
    {
        // Query order dengan relasi yang sama
        $order = Order::with(['orderItems.product', 'user'])->findOrFail($orderId);

        // Validasi ownership
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized. Ini bukan pesanan Anda.');
        }

        // Load view template invoice ke PDF
        $pdf = Pdf::loadView('invoice.template', compact('order'));

        // Buat filename unik dengan order code dan tanggal
        $filename = 'Invoice-' . $order->code . '-' . now()->format('Ymd') . '.pdf';

        // Download file PDF
        return $pdf->download($filename);
    }
}
