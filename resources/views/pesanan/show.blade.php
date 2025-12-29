@extends('layouts.dashboard')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.orders.index') }}" class="text-indigo-600 hover:text-indigo-700 text-sm">
        ← Kembali ke Daftar Pesanan
    </a>
</div>

<h1 class="text-2xl font-bold mb-6">Detail Pesanan #ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</h1>

<div class="bg-white rounded-xl shadow p-6 space-y-6">

    <!-- INFO PESANAN -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
        <p><strong>ID Pesanan:</strong> #ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</p>
        <p><strong>Tanggal Pesanan:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
        <p><strong>Nama Customer:</strong> {{ $order->name }}</p>
        <p><strong>Email:</strong> {{ $order->email }}</p>
        <p><strong>No. HP:</strong> {{ $order->phone }}</p>
        <p><strong>Metode Pembayaran:</strong> {{ strtoupper($order->payment_method) }}</p>
        
        <div>
            <strong>Status Pesanan:</strong>
            @php
                $statusConfig = [
                    'pending' => ['label' => 'Pending', 'class' => 'bg-gray-100 text-gray-700'],
                    'processing' => ['label' => 'Diproses', 'class' => 'bg-blue-100 text-blue-700'],
                    'shipped' => ['label' => 'Dikirim', 'class' => 'bg-indigo-100 text-indigo-700'],
                    'delivered' => ['label' => 'Selesai', 'class' => 'bg-green-100 text-green-700'],
                    'cancelled' => ['label' => 'Dibatalkan', 'class' => 'bg-red-100 text-red-700'],
                ];
                $status = $statusConfig[$order->status] ?? ['label' => $order->status, 'class' => 'bg-gray-100 text-gray-700'];
            @endphp
            <span class="ml-2 px-3 py-1 text-xs rounded-full {{ $status['class'] }}">
                {{ $status['label'] }}
            </span>
        </div>

        <div>
            <strong>Status Pembayaran:</strong>
            @php
                $paymentConfig = [
                    'pending' => ['label' => 'Belum Bayar', 'class' => 'bg-yellow-100 text-yellow-700'],
                    'paid' => ['label' => 'Lunas', 'class' => 'bg-green-100 text-green-700'],
                    'failed' => ['label' => 'Gagal', 'class' => 'bg-red-100 text-red-700'],
                ];
                $payment = $paymentConfig[$order->payment_status] ?? ['label' => $order->payment_status, 'class' => 'bg-gray-100 text-gray-700'];
            @endphp
            <span class="ml-2 px-3 py-1 text-xs rounded-full {{ $payment['class'] }}">
                {{ $payment['label'] }}
            </span>
        </div>
    </div>

    @if($order->note)
    <div>
        <h2 class="text-lg font-semibold text-gray-800 mb-2">Catatan</h2>
        <p class="text-sm text-gray-600">{{ $order->note }}</p>
    </div>
    @endif

    <!-- ALAMAT -->
    <div>
        <h2 class="text-lg font-semibold text-gray-800 mb-2">Alamat Pengiriman</h2>
        <p class="text-sm text-gray-600">
            {{ $order->address }}<br>
            {{ $order->city }}, {{ $order->province }} {{ $order->postal_code }}
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
                    @foreach($order->orderItems as $item)
                    <tr class="border-b">
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-4">
                                @if($item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}"
                                         class="w-16 h-16 rounded-lg object-cover">
                                @else
                                    <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center text-xs text-gray-400">
                                        No Image
                                    </div>
                                @endif
                                <span class="font-medium">{{ $item->product->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            Rp {{ number_format($item->price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $item->quantity }}
                        </td>
                        <td class="px-6 py-4 text-center font-medium">
                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- TOTAL -->
    <div class="border-t pt-4">
        <div class="flex justify-end">
            <div class="w-full md:w-1/3 space-y-2 text-sm">
                <div class="flex justify-between">
                    <span>Subtotal:</span>
                    <span class="font-medium">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Ongkir:</span>
                    <span class="font-medium">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-lg font-bold border-t pt-2">
                    <span>Total:</span>
                    <span class="text-indigo-600">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- UPDATE STATUS -->
    <div class="border-t pt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Update Order Status -->
        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="space-y-2">
            @csrf
            <label class="block text-sm font-medium text-gray-700">Update Status Pesanan</label>
            <div class="flex gap-2">
                <select name="status" class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Diproses</option>
                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Dikirim</option>
                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Selesai</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm">
                    Update
                </button>
            </div>
        </form>

        <!-- Update Payment Status -->
        <form action="{{ route('admin.orders.updatePayment', $order->id) }}" method="POST" class="space-y-2">
            @csrf
            <label class="block text-sm font-medium text-gray-700">Update Status Pembayaran</label>
            <div class="flex gap-2">
                <select name="payment_status" class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Belum Bayar</option>
                    <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Lunas</option>
                    <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Gagal</option>
                </select>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">
                    Update
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
