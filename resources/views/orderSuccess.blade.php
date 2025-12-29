<x-layoutCategories>
    <div class="max-w-4xl mx-auto px-6 py-14 pt-28">
        <div class="text-center mb-8">
            <div class="mb-4">
                <svg class="w-20 h-20 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h1 class="text-4xl font-light tracking-wide mb-2" style="font-family: cormorant, serif !important;">
                Pesanan Berhasil!
            </h1>
            <p class="text-gray-600" style="font-family: poppins, sans-serif;">
                Terima kasih sudah berbelanja di Fleure Parfume
            </p>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4" style="font-family: cormorant, serif !important;">Detail Pesanan</h2>

            <div class="grid grid-cols-2 gap-4 text-sm mb-4" style="font-family: poppins, sans-serif;">
                <div>
                    <p class="text-gray-600">Order ID</p>
                    <p class="font-semibold">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Status</p>
                    <p class="font-semibold capitalize">{{ $order->status }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Tanggal</p>
                    <p class="font-semibold">{{ $order->created_at->format('d M Y, H:i') }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Metode Pembayaran</p>
                    <p class="font-semibold capitalize">{{ $order->payment_method }}</p>
                </div>
            </div>

            <div class="border-t pt-4">
                <h3 class="font-semibold mb-3" style="font-family: poppins, sans-serif;">Informasi Pengiriman</h3>
                <p class="text-sm text-gray-700" style="font-family: poppins, sans-serif;">
                    {{ $order->name }}<br>
                    {{ $order->phone }}<br>
                    {{ $order->email }}<br>
                    {{ $order->address }}<br>
                    {{ $order->city }}, {{ $order->province }} {{ $order->postal_code }}
                    @if ($order->note)
                        <br><span class="text-gray-600">Catatan: {{ $order->note }}</span>
                    @endif
                </p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4" style="font-family: cormorant, serif !important;">Produk yang Dipesan
            </h2>

            <div class="space-y-3">
                @foreach ($order->orderItems as $item)
                    <div class="flex items-center gap-4 border-b pb-3">
                        @if ($item->product->image)
                            <img src="{{ asset('storage/' . $item->product->image) }}"
                                class="w-16 h-16 object-cover rounded">
                        @else
                            <div class="w-16 h-16 bg-gray-200 rounded"></div>
                        @endif

                        <div class="flex-1">
                            <p class="font-semibold" style="font-family: poppins, sans-serif;">
                                {{ $item->product->name }}</p>
                            <p class="text-sm text-gray-600" style="font-family: poppins, sans-serif;">
                                {{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}
                            </p>
                        </div>

                        <p class="font-semibold" style="font-family: poppins, sans-serif;">
                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                        </p>
                    </div>
                @endforeach
            </div>

            <div class="mt-4 pt-4 space-y-2" style="font-family: poppins, sans-serif;">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Subtotal</span>
                    <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Ongkir</span>
                    <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-lg font-semibold pt-2 border-t">
                    <span>Total</span>
                    <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <div class="text-center space-y-3">
            <div class="flex flex-wrap justify-center gap-2">
                <a href="{{ route('invoices.show', $order->id) }}"
                    class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg uppercase tracking-widest text-xs font-semibold hover:bg-blue-700 transition">
                    Lihat Invoice
                </a>
                <a href="{{ route('invoices.download', $order->id) }}"
                    class="inline-block bg-green-600 text-white px-4 py-2 rounded-lg uppercase tracking-widest text-xs font-semibold hover:bg-green-700 transition">
                    Download PDF
                </a>
                <a href="{{ route('orders.index') }}"
                    class="inline-block bg-black text-white px-4 py-2 rounded-lg uppercase tracking-widest text-xs font-semibold hover:bg-gray-800 transition">
                    Lihat Semua Pesanan
                </a>
            </div>
            <br>
            <a href="/buy" class="text-sm text-gray-600 hover:text-black" style="font-family: poppins, sans-serif;">
                ← Kembali Belanja
            </a>
        </div>
    </div>
</x-layoutCategories>
