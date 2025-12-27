@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 pt-30">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold mb-2" style="font-family: cormorant, serif !important;">Invoice</h1>
                <p class="text-gray-600">Nomor Pesanan: <span class="font-bold text-rose-600">{{ $order->code }}</span></p>
            </div>
            <div class="text-right">
                <a href="{{ route('pesanan.index') }}"
                    class="inline-block px-6 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                    ← Kembali ke Pesanan
                </a>
            </div>
        </div>

        <!-- Invoice Preview -->
        <div class="bg-white rounded-lg shadow-lg p-8 mb-6" style="font-family: 'Segoe UI', sans-serif; font-size: 14px;">
            <!-- Header -->
            <div class="flex justify-between items-start mb-8 pb-6 border-b-2" style="border-color: #c9302c;">
                <div>
                    <h2 style="font-size: 32px; color: #c9302c; font-style: italic;">FleureParfume</h2>
                    <p style="color: #666; font-size: 12px;">Premium Fragrance Collections</p>
                </div>
                <div class="text-right">
                    <h2 style="font-size: 24px; color: #c9302c; margin-bottom: 10px;">INVOICE</h2>
                    <div style="font-size: 12px; color: #666;">
                        <p><strong>No. Pesanan:</strong> <span
                                style="color: #c9302c; font-weight: bold;">{{ $order->code }}</span></p>
                        <p><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y') }}</p>
                        <p><strong>Jam:</strong> {{ $order->created_at->format('H:i') }} WIB</p>
                    </div>
                </div>
            </div>

            <!-- Customer Info -->
            <div class="grid grid-cols-2 gap-8 mb-8">
                <div>
                    <h4
                        style="font-size: 11px; font-weight: bold; text-transform: uppercase; color: #c9302c; margin-bottom: 8px;">
                        Penagihan Kepada:</h4>
                    <p style="font-size: 12px; margin: 3px 0;">{{ $order->user->name }}</p>
                    <p style="font-size: 12px; margin: 3px 0;">{{ $order->email }}</p>
                    <p style="font-size: 12px; margin: 3px 0;">{{ $order->phone }}</p>
                </div>
                <div>
                    <h4
                        style="font-size: 11px; font-weight: bold; text-transform: uppercase; color: #c9302c; margin-bottom: 8px;">
                        Pengiriman Ke:</h4>
                    <p style="font-size: 12px; margin: 3px 0;">{{ $order->name }}</p>
                    <p style="font-size: 12px; margin: 3px 0;">{{ $order->address }}</p>
                    <p style="font-size: 12px; margin: 3px 0;">{{ $order->city }}, {{ $order->province }}
                        {{ $order->postal_code }}</p>
                </div>
            </div>

            <!-- Items Table -->
            <table class="w-full mb-6" style="border-collapse: collapse;">
                <thead style="background-color: #c9302c; color: white;">
                    <tr>
                        <th class="px-4 py-2 text-left" style="font-size: 11px; font-weight: bold;">Produk</th>
                        <th class="px-4 py-2 text-right" style="font-size: 11px; font-weight: bold; width: 80px;">Qty</th>
                        <th class="px-4 py-2 text-right" style="font-size: 11px; font-weight: bold; width: 120px;">Harga
                            Satuan</th>
                        <th class="px-4 py-2 text-right" style="font-size: 11px; font-weight: bold; width: 140px;">Subtotal
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($order->orderItems as $item)
                        <tr style="border-bottom: 1px solid #ddd;">
                            <td class="px-4 py-2" style="font-size: 12px;">{{ $item->product->name }}</td>
                            <td class="px-4 py-2 text-right" style="font-size: 12px;">{{ $item->quantity }}</td>
                            <td class="px-4 py-2 text-right" style="font-size: 12px; font-family: monospace;">Rp
                                {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 text-right" style="font-size: 12px; font-family: monospace;"><strong>Rp
                                    {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</strong></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-2 text-center" style="font-size: 12px; color: #999;">Tidak ada
                                item pesanan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Summary -->
            <div class="flex justify-end mb-6">
                <div style="width: 300px;">
                    <div class="flex justify-between mb-2"
                        style="font-size: 12px; padding: 8px 0; border-bottom: 1px solid #ddd;">
                        <span>Subtotal:</span>
                        <span style="font-family: monospace;">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between mb-2"
                        style="font-size: 12px; padding: 8px 0; border-bottom: 1px solid #ddd;">
                        <span>Ongkos Kirim:</span>
                        <span style="font-family: monospace;">Rp
                            {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between"
                        style="font-size: 14px; font-weight: bold; color: #c9302c; padding: 12px 0; border-top: 2px solid #c9302c; border-bottom: 2px solid #c9302c;">
                        <span>TOTAL PEMBAYARAN:</span>
                        <span style="font-family: monospace;">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Payment Status -->
            <div style="background-color: #f0f0f0; padding: 15px; margin-bottom: 20px; border-left: 4px solid #c9302c;">
                <p style="font-size: 12px; margin-bottom: 8px;"><strong>Status Pembayaran:</strong></p>
                @php
                    $statusClass = match ($order->payment_status) {
                        'paid' => 'bg-green-100 text-green-700',
                        'pending' => 'bg-yellow-100 text-yellow-700',
                        'failed' => 'bg-red-100 text-red-700',
                        default => 'bg-yellow-100 text-yellow-700',
                    };
                    $statusText = match ($order->payment_status) {
                        'paid' => 'LUNAS',
                        'pending' => 'MENUNGGU PEMBAYARAN',
                        'failed' => 'PEMBAYARAN GAGAL',
                        default => 'UNKNOWN',
                    };
                @endphp
                <span
                    class="inline-block px-3 py-1 rounded text-xs font-bold {{ $statusClass }}">{{ $statusText }}</span>
                <p style="font-size: 12px; margin-top: 8px;">Metode Pembayaran:
                    <strong>{{ ucfirst($order->payment_method) }}</strong></p>
                @if ($order->note)
                    <p style="font-size: 12px; margin-top: 8px; font-style: italic; color: #666;">Catatan:
                        {{ $order->note }}</p>
                @endif
            </div>

            <!-- Footer -->
            <div class="text-center pt-6" style="border-top: 1px solid #ddd; font-size: 11px; color: #666;">
                <p>Terima kasih telah berbelanja di FleureParfume! 💐</p>
                <p>Invoice ini adalah bukti pembayaran sah. Mohon simpan invoice ini dengan baik.</p>
            </div>
        </div>

        <!-- Download Button -->
        <div class="flex justify-center gap-4">
            <a href="{{ route('invoices.download', $order->id) }}"
                class="px-8 py-3 bg-rose-600 text-white rounded-lg hover:bg-rose-700 font-semibold">
                📥 Download PDF
            </a>
        </div>
    </div>
@endsection
