@extends('layouts.dashboard')

@section('content')
<!-- Popup Success -->


<h1 class="text-lg sm:text-2xl font-bold mb-4 sm:mb-6">Data Pesanan</h1>

<div class="bg-white rounded-xl shadow px-3 sm:px-6 py-4 sm:py-6 overflow-hidden">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 sm:gap-4 mb-4 sm:mb-6">
        <h2 class="text-base sm:text-lg font-semibold text-gray-700">
            Daftar Pesanan ({{ $orders->count() }})
        </h2>

        <!-- FILTER FORM -->
        <form method="GET" action="{{ route('admin.orders.index') }}"
              class="flex flex-wrap gap-2 w-full md:w-auto">

            <!-- DATE -->
            <input type="date" name="date" value="{{ request('date') }}"
                   class="flex-1 min-w-[120px] border border-gray-300 rounded-lg px-2 py-1.5 text-[11px] sm:text-sm
                          focus:outline-none focus:ring-2 focus:ring-indigo-500" />

            <!-- SEARCH -->
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari ID / Nama..."
                   class="flex-1 min-w-[140px] border border-gray-300 rounded-lg px-2 py-1.5 text-[11px] sm:text-sm
                          focus:outline-none focus:ring-2 focus:ring-indigo-500" />

            <!-- STATUS -->
            <select name="status"
                    class="flex-1 min-w-[120px] border border-gray-300 rounded-lg px-2 py-1.5 text-[11px] sm:text-sm
                           focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Diproses</option>
                <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Dikirim</option>
                <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Selesai</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
            </select>

            <!-- BUTTONS -->
            <div class="flex gap-2 flex-1 sm:flex-none">
                <button type="submit"
                        class="flex-1 sm:flex-none bg-indigo-600 hover:bg-indigo-700 text-white text-[11px] sm:text-sm px-3 py-1.5 rounded-lg">
                    Filter
                </button>
                <a href="{{ route('admin.orders.index') }}"
                   class="flex-1 sm:flex-none bg-gray-200 hover:bg-gray-300 text-gray-800 text-[11px] sm:text-sm px-3 py-1.5 rounded-lg text-center">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- TABLE -->
    <div class="w-full overflow-x-hidden">
        <table class="w-full text-[10px] sm:text-sm text-gray-700 border-collapse">
            <thead class="bg-gray-100 text-gray-600 uppercase text-[9px] sm:text-xs">
                <tr>
                    <th class="px-2 py-2 text-center">ID</th>
                    <th class="px-2 py-2 text-center">Customer</th>
                    <th class="px-2 py-2 text-center">Tanggal</th>
                    <th class="px-2 py-2 text-center">Total</th>
                    <th class="px-2 py-2 text-center">Status</th>
                    <th class="px-2 py-2 text-center">Bayar</th>
                    <th class="px-2 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-2 py-2 text-center font-medium text-gray-800">
                        #{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
                    </td>
                    <td class="px-2 py-2 text-center truncate max-w-[100px]">{{ $order->name }}</td>
                    <td class="px-2 py-2 text-center whitespace-nowrap">
                        {{ $order->created_at->format('d M Y') }}
                    </td>
                    <td class="px-2 py-2 text-center whitespace-nowrap">
                        Rp {{ number_format($order->total, 0, ',', '.') }}
                    </td>

                    <!-- STATUS -->
                    <td class="px-2 py-2 text-center">
                        @php
                            $statusConfig = [
                                'pending' => 'bg-gray-100 text-gray-700',
                                'processing' => 'bg-blue-100 text-blue-700',
                                'shipped' => 'bg-indigo-100 text-indigo-700',
                                'delivered' => 'bg-green-100 text-green-700',
                                'cancelled' => 'bg-red-100 text-red-700'
                            ];
                        @endphp
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                            @csrf
                            <select name="status" onchange="this.form.submit()"
                                class="text-[9px] sm:text-xs px-1 py-1 rounded-full border-0 focus:ring-1 focus:ring-indigo-500 {{ $statusConfig[$order->status] ?? 'bg-gray-100 text-gray-700' }}">
                                <option value="pending" {{ $order->status=='pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status=='processing' ? 'selected' : '' }}>Proses</option>
                                <option value="shipped" {{ $order->status=='shipped' ? 'selected' : '' }}>Kirim</option>
                                <option value="delivered" {{ $order->status=='delivered' ? 'selected' : '' }}>Selesai</option>
                                <option value="cancelled" {{ $order->status=='cancelled' ? 'selected' : '' }}>Batal</option>
                            </select>
                        </form>
                    </td>

                    <!-- PAYMENT -->
                    <td class="px-2 py-2 text-center">
                        @php
                            $paymentColor = [
                                'pending' => 'bg-yellow-100 text-yellow-700',
                                'paid' => 'bg-green-100 text-green-700',
                                'failed' => 'bg-red-100 text-red-700'
                            ];
                        @endphp
                        <form action="{{ route('admin.orders.updatePayment', $order->id) }}" method="POST">
                            @csrf
                            <select name="payment_status" onchange="this.form.submit()"
                                class="text-[9px] sm:text-xs px-1 py-1 rounded-full border-0 focus:ring-1 focus:ring-indigo-500 {{ $paymentColor[$order->payment_status] ?? 'bg-gray-100 text-gray-700' }}">
                                <option value="pending" {{ $order->payment_status=='pending' ? 'selected' : '' }}>Belum</option>
                                <option value="paid" {{ $order->payment_status=='paid' ? 'selected' : '' }}>Lunas</option>
                                <option value="failed" {{ $order->payment_status=='failed' ? 'selected' : '' }}>Gagal</option>
                            </select>
                        </form>
                    </td>

                    <!-- AKSI -->
                    <td class="px-2 py-2 text-center">
                        <a href="{{ route('admin.orders.show', $order->id) }}"
                           class="px-2 py-1 text-[9px] sm:text-xs text-white bg-indigo-600 rounded hover:bg-indigo-700">
                            Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-3 text-gray-400 text-[10px] sm:text-sm">
                        Belum ada pesanan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
