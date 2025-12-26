@extends('layouts.dashboard')

@section('content')
<h1 class="text-2xl font-bold mb-6">Data Pesanan</h1>

<div class="bg-white rounded-xl shadow p-6">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <h2 class="text-lg font-semibold text-gray-700">
            Daftar Pesanan ({{ $orders->count() }})
        </h2>

        <form method="GET" action="{{ route('admin.orders.index') }}" class="flex gap-2">
            <!-- FILTER TANGGAL -->
            <input
                type="date"
                name="date"
                value="{{ request('date') }}"
                class="border border-gray-300 rounded-lg px-3 py-2 text-sm
                       focus:outline-none focus:ring-2 focus:ring-indigo-500"
            />

            <!-- SEARCH -->
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari ID / Nama Customer..."
                class="border border-gray-300 rounded-lg px-4 py-2 text-sm
                       focus:outline-none focus:ring-2 focus:ring-indigo-500"
            >

            <!-- FILTER -->
            <select
                name="status"
                class="border border-gray-300 rounded-lg px-3 py-2 text-sm 
                       focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Diproses</option>
                <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Dikirim</option>
                <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Selesai</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
            </select>

            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-lg">
                Filter
            </button>
            <a href="{{ route('admin.orders.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm px-4 py-2 rounded-lg">
                Reset
            </a>
        </form>
    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-600">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-center">ID Pesanan</th>
                    <th class="px-6 py-3 text-center">Customer</th>
                    <th class="px-6 py-3 text-center">Tanggal</th>
                    <th class="px-6 py-3 text-center">Total</th>
                    <th class="px-6 py-3 text-center">Status</th>
                    <th class="px-6 py-3 text-center">Pembayaran</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($orders as $order)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-center text-gray-800">
                        #ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{ $order->name }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{ $order->created_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        Rp {{ number_format($order->total, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 text-center">
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
                        
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="inline-block">
                            @csrf
                            <select name="status" onchange="this.form.submit()" 
                                    class="px-2 py-1 text-xs rounded-full border-0 {{ $status['class'] }} cursor-pointer focus:ring-2 focus:ring-indigo-500">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Diproses</option>
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Dikirim</option>
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Selesai</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-6 py-4 text-center">
                        @php
                            $paymentConfig = [
                                'pending' => ['label' => 'Belum Bayar', 'class' => 'bg-yellow-100 text-yellow-700'],
                                'paid' => ['label' => 'Lunas', 'class' => 'bg-green-100 text-green-700'],
                                'failed' => ['label' => 'Gagal', 'class' => 'bg-red-100 text-red-700'],
                            ];
                            $payment = $paymentConfig[$order->payment_status] ?? ['label' => $order->payment_status, 'class' => 'bg-gray-100 text-gray-700'];
                        @endphp
                        
                        <form action="{{ route('admin.orders.updatePayment', $order->id) }}" method="POST" class="inline-block">
                            @csrf
                            <select name="payment_status" onchange="this.form.submit()" 
                                    class="px-2 py-1 text-xs rounded-full border-0 {{ $payment['class'] }} cursor-pointer focus:ring-2 focus:ring-indigo-500">
                                <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Belum Bayar</option>
                                <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Lunas</option>
                                <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Gagal</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-6 py-4 text-center space-x-2">
                        <a href="{{ route('admin.orders.show', $order->id) }}"
                           class="px-3 py-1 text-xs text-white bg-indigo-600 rounded hover:bg-indigo-700">
                            Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-6 text-gray-400">
                        Belum ada pesanan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
