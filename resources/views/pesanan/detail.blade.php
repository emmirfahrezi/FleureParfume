<x-layoutCategories>
    <div class="max-w-4xl mx-auto px-6 py-14 pt-28">
        <div class="mb-8">
            <a href="{{ route('orders.index') }}" class="text-sm text-gray-600 hover:text-black mb-2 inline-block">
                ← Kembali ke Pesanan
            </a>
            <h1 class="text-4xl font-light tracking-wide" style="font-family: cormorant, serif !important;">
                Detail Pesanan
            </h1>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <p class="text-sm text-gray-600" style="font-family: poppins, sans-serif;">
                        Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                    </p>
                    <p class="text-xs text-gray-500" style="font-family: poppins, sans-serif;">
                        {{ $order->created_at->format('d M Y, H:i') }}
                    </p>
                </div>
                <span class="inline-block px-4 py-2 text-sm font-semibold rounded-full
                    @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                    @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                    @elseif($order->status == 'shipped') bg-purple-100 text-purple-800
                    @elseif($order->status == 'delivered') bg-green-100 text-green-800
                    @else bg-red-100 text-red-800
                    @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <div class="grid md:grid-cols-2 gap-6 mb-6 pb-6 border-b">
                <div>
                    <h3 class="font-semibold mb-2" style="font-family: poppins, sans-serif;">Informasi Kontak</h3>
                    <p class="text-sm text-gray-700" style="font-family: poppins, sans-serif;">
                        {{ $order->name }}<br>
                        {{ $order->phone }}<br>
                        {{ $order->email }}
                    </p>
                </div>
                <div>
                    <h3 class="font-semibold mb-2" style="font-family: poppins, sans-serif;">Alamat Pengiriman</h3>
                    <p class="text-sm text-gray-700" style="font-family: poppins, sans-serif;">
                        {{ $order->address }}<br>
                        {{ $order->city }}, {{ $order->province }}<br>
                        {{ $order->postal_code }}
                        @if($order->note)
                        <br><span class="text-gray-600 italic">Catatan: {{ $order->note }}</span>
                        @endif
                    </p>
                </div>
            </div>

            <div class="mb-6 pb-6 border-b">
                <h3 class="font-semibold mb-3" style="font-family: poppins, sans-serif;">Metode Pembayaran</h3>
                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 bg-gray-100 rounded text-sm" style="font-family: poppins, sans-serif;">
                        {{ ucfirst($order->payment_method) }}
                    </span>
                    <span class="px-3 py-1 text-xs rounded
                        @if($order->payment_status == 'pending') bg-yellow-100 text-yellow-800
                        @elseif($order->payment_status == 'paid') bg-green-100 text-green-800
                        @else bg-red-100 text-red-800
                        @endif">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </div>
            </div>

            <div>
                <h3 class="font-semibold mb-4" style="font-family: poppins, sans-serif;">Produk yang Dipesan</h3>
                <div class="space-y-4">
                    @foreach($order->orderItems as $item)
                    <div class="flex items-center gap-4 border-b pb-4">
                        @if($item->product->image)
                        <img src="{{ asset('storage/' . $item->product->image) }}" class="w-20 h-20 object-cover rounded">
                        @else
                        <div class="w-20 h-20 bg-gray-200 rounded"></div>
                        @endif
                        
                        <div class="flex-1">
                            <p class="font-semibold" style="font-family: poppins, sans-serif;">{{ $item->product->name }}</p>
                            <p class="text-sm text-gray-600" style="font-family: poppins, sans-serif;">
                                Kategori: {{ $item->product->category->name ?? '-' }}
                            </p>
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

                <div class="mt-6 pt-4 border-t space-y-2" style="font-family: poppins, sans-serif;">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Subtotal</span>
                        <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Ongkir</span>
                        <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-xl font-semibold pt-3 border-t">
                        <span>Total</span>
                        <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layoutCategories>
