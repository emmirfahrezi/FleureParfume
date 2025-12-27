<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $order->code }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 13px;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        
        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 40px;
            border-bottom: 2px solid #c9302c;
            padding-bottom: 20px;
        }
        
        .company-info h1 {
            font-size: 32px;
            color: #c9302c;
            font-style: italic;
            margin-bottom: 5px;
        }
        
        .company-info p {
            font-size: 12px;
            color: #666;
        }
        
        .invoice-title {
            text-align: right;
        }
        
        .invoice-title h2 {
            font-size: 24px;
            color: #c9302c;
            margin-bottom: 10px;
        }
        
        .invoice-info {
            font-size: 12px;
            color: #666;
        }
        
        .invoice-info p {
            margin: 4px 0;
        }
        
        /* Info Section */
        .info-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
            gap: 40px;
        }
        
        .info-block h4 {
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            color: #c9302c;
            margin-bottom: 8px;
        }
        
        .info-block p {
            font-size: 12px;
            margin: 3px 0;
            color: #333;
        }
        
        .info-block {
            flex: 1;
        }
        
        /* Items Table */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        
        .items-table thead {
            background-color: #c9302c;
            color: white;
        }
        
        .items-table th {
            padding: 12px 8px;
            text-align: left;
            font-weight: bold;
            font-size: 12px;
            border: none;
        }
        
        .items-table td {
            padding: 10px 8px;
            border-bottom: 1px solid #ddd;
            font-size: 12px;
        }
        
        .items-table tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }
        
        .items-table tbody tr:hover {
            background-color: #f5f5f5;
        }
        
        .qty, .unit-price, .subtotal {
            text-align: right;
            font-family: 'Courier New', monospace;
        }
        
        /* Summary Section */
        .summary {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 40px;
        }
        
        .summary-box {
            width: 300px;
        }
        
        .summary-line {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: 12px;
            border-bottom: 1px solid #ddd;
        }
        
        .summary-line.total {
            border-top: 2px solid #c9302c;
            border-bottom: 2px solid #c9302c;
            font-weight: bold;
            font-size: 14px;
            padding: 12px 0;
            color: #c9302c;
        }
        
        .summary-line label {
            font-weight: 600;
        }
        
        .summary-line span {
            text-align: right;
            font-family: 'Courier New', monospace;
        }
        
        /* Payment Status */
        .payment-status {
            background-color: #f0f0f0;
            padding: 15px;
            margin-bottom: 30px;
            border-left: 4px solid #c9302c;
        }
        
        .payment-status p {
            font-size: 12px;
            margin: 4px 0;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
            margin-top: 4px;
        }
        
        .status-paid {
            background-color: #d4edda;
            color: #155724;
        }
        
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .status-failed {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        /* Footer */
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 11px;
            color: #666;
            text-align: center;
        }
        
        .order-number {
            font-weight: bold;
            color: #c9302c;
        }
        
        .currency {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="company-info">
                <h1>FleureParfume</h1>
                <p>Premium Fragrance Collections</p>
            </div>
            <div class="invoice-title">
                <h2>INVOICE</h2>
                <div class="invoice-info">
                    <p><strong>No. Pesanan:</strong> <span class="order-number">{{ $order->code }}</span></p>
                    <p><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y') }}</p>
                    <p><strong>Jam:</strong> {{ $order->created_at->format('H:i') }} WIB</p>
                </div>
            </div>
        </div>

        <!-- Customer & Shipping Info -->
        <div class="info-section">
            <div class="info-block">
                <h4>Penagihan Kepada:</h4>
                <p>{{ $order->user->name }}</p>
                <p>{{ $order->email }}</p>
                <p>{{ $order->phone }}</p>
            </div>
            <div class="info-block">
                <h4>Pengiriman Ke:</h4>
                <p>{{ $order->name }}</p>
                <p>{{ $order->address }}</p>
                <p>{{ $order->city }}, {{ $order->province }} {{ $order->postal_code }}</p>
            </div>
        </div>

        <!-- Items Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 40%;">Produk</th>
                    <th style="width: 10%; text-align: right;">Qty</th>
                    <th style="width: 20%; text-align: right;">Harga Satuan</th>
                    <th style="width: 30%; text-align: right;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td class="qty">{{ $item->quantity }}</td>
                    <td class="unit-price">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td class="subtotal">
                        <span class="currency">Rp</span> {{ number_format($item->quantity * $item->price, 0, ',', '.') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center; color: #999;">Tidak ada item pesanan</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Summary -->
        <div class="summary">
            <div class="summary-box">
                <div class="summary-line">
                    <label>Subtotal:</label>
                    <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="summary-line">
                    <label>Ongkos Kirim:</label>
                    <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                </div>
                <div class="summary-line total">
                    <label>TOTAL PEMBAYARAN:</label>
                    <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Payment Status -->
        <div class="payment-status">
            <p><strong>Status Pembayaran:</strong></p>
            @php
                $statusClass = match($order->payment_status) {
                    'paid' => 'status-paid',
                    'pending' => 'status-pending',
                    'failed' => 'status-failed',
                    default => 'status-pending'
                };
                $statusText = match($order->payment_status) {
                    'paid' => 'LUNAS',
                    'pending' => 'MENUNGGU PEMBAYARAN',
                    'failed' => 'PEMBAYARAN GAGAL',
                    default => 'UNKNOWN'
                };
            @endphp
            <span class="status-badge {{ $statusClass }}">{{ $statusText }}</span>
            <p style="margin-top: 8px;">Metode Pembayaran: <strong>{{ ucfirst($order->payment_method) }}</strong></p>
            
            @if($order->note)
            <p style="margin-top: 8px; font-style: italic; color: #666;">
                Catatan: {{ $order->note }}
            </p>
            @endif
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Terima kasih telah berbelanja di FleureParfume! 💐</p>
            <p>Invoice ini adalah bukti pembayaran sah. Mohon simpan invoice ini dengan baik.</p>
            <p style="margin-top: 10px; color: #999;">Dicetak pada: {{ now()->format('d M Y H:i:s') }} WIB</p>
        </div>
    </div>
</body>
</html>
