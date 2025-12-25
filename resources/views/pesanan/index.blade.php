<x-layoutCategories>
    <div class="max-w-6xl mx-auto px-6 py-14 pt-28">
        <div class="mb-8">
            <h1 class="text-4xl font-light tracking-wide" style="font-family: cormorant, serif !important;">
                Pesanan Saya
            </h1>
            <p class="text-gray-600 mt-2" style="font-family: poppins, sans-serif;">
                Lihat riwayat dan status pesanan kamu
            </p>
        </div>

        @if ($orders->isEmpty())
            <div class="bg-white rounded-xl shadow-md p-12 text-center">
                <p class="text-gray-500 mb-4" style="font-family: poppins, sans-serif;">
                    Belum ada pesanan
                </p>
                <a href="/buy"
                    class="inline-block bg-black text-white px-6 py-2 rounded-lg hover:bg-gray-800 transition">
                    Mulai Belanja
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($orders as $order)
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <p class="text-sm text-gray-600" style="font-family: poppins, sans-serif;">
                                    Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                                </p>
                                <p class="text-xs text-gray-500" style="font-family: poppins, sans-serif;">
                                    {{ $order->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                            <div class="text-right">
                                <span
                                    class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                            @if ($order->status == 'pending') bg-yellow-100 text-yellow-800
                            @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                            @elseif($order->status == 'shipped') bg-purple-100 text-purple-800
                            @elseif($order->status == 'delivered') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>

                        <div class="border-t pt-4 mb-4">
                            <div class="space-y-2">
                                @foreach ($order->orderItems as $item)
                                    <div class="flex items-center gap-3">
                                        @if ($item->product->image)
                                            <img src="{{ asset('storage/' . $item->product->image) }}"
                                                class="w-12 h-12 object-cover rounded">
                                        @else
                                            <div class="w-12 h-12 bg-gray-200 rounded"></div>
                                        @endif
                                        <div class="flex-1">
                                            <p class="text-sm font-semibold" style="font-family: poppins, sans-serif;">
                                                {{ $item->product->name }}
                                            </p>
                                            <p class="text-xs text-gray-600" style="font-family: poppins, sans-serif;">
                                                {{ $item->quantity }} x Rp
                                                {{ number_format($item->price, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex justify-between items-center border-t pt-4">
                            <div>
                                <p class="text-sm text-gray-600" style="font-family: poppins, sans-serif;">Total
                                    Pembayaran</p>
                                <p class="text-lg font-semibold" style="font-family: poppins, sans-serif;">
                                    Rp {{ number_format($order->total, 0, ',', '.') }}
                                </p>
                            </div>
                            <a href="{{ route('orders.show', $order->id) }}"
                                class="bg-black text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-800 transition">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layoutCategories>
