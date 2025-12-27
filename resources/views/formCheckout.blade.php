<x-layoutCategories>
    <div class="max-w-6xl mx-auto px-6 py-14 pt-28">
        <div class="mb-8">
            <h1 class="text-4xl font-light tracking-wide" style="font-family: cormorant, serif !important;">Checkout</h1>
            <p class="text-gray-600 mt-2" style="font-family: poppins, sans-serif;">
                Lengkapi detail pengiriman dan pembayaran untuk menyelesaikan pesanan.
            </p>
        </div>

        <form id="checkoutForm" action="{{ route('orders.prepare') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @csrf

            @if(session('error'))
            <div class="lg:col-span-3 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
            @endif

            @if(isset($errorMessage) && $errorMessage)
            <div class="lg:col-span-3 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <strong>Payment Gateway Error:</strong> {{ $errorMessage }}
                <br><small>Periksa konfigurasi Midtrans atau cek log untuk detail.</small>
            </div>
            @endif

            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-xl shadow-md p-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-gray-900" style="font-family: cormorant, serif !important;">Informasi Kontak</h2>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-sm text-gray-600" style="font-family: poppins, sans-serif;">Nama Lengkap</label>
                            <input type="text" name="name" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black" placeholder="John Doe" required>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm text-gray-600" style="font-family: poppins, sans-serif;">Email</label>
                            <input type="email" name="email" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black" placeholder="you@email.com" required>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm text-gray-600" style="font-family: poppins, sans-serif;">No. Telepon</label>
                            <input type="tel" name="phone" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black" placeholder="08xxxxxxxxxx" required>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm text-gray-600" style="font-family: poppins, sans-serif;">Catatan untuk Kurir (opsional)</label>
                            <input type="text" name="note" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black" placeholder="Patokan rumah, dll">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <!-- Alamat tetap -->
                    <div class="space-y-2">
                        <label class="text-sm text-gray-600">Alamat</label>
                        <input type="text" name="address" class="w-full border rounded-lg px-3 py-2" required>
                    </div>

                    <!-- Provinsi -->
                    <div class="space-y-2">
                        <label class="text-sm text-gray-600">Provinsi</label>
                        <select id="province" name="province" class="w-full border rounded-lg px-3 py-2" required>
                            <option value="">-- Pilih Provinsi --</option>
                        </select>
                    </div>

                    <!-- Kota -->
                    <div class="space-y-2">
                        <label class="text-sm text-gray-600">Kota / Kabupaten</label>
                        <select id="city" name="city" class="w-full border rounded-lg px-3 py-2" required>
                            <option value="">-- Pilih Kota/Kabupaten --</option>
                        </select>
                    </div>

                    <!-- Kode Pos tetap -->
                    <div class="space-y-2">
                        <label class="text-sm text-gray-600">Kode Pos</label>
                        <input type="text" name="postal_code" class="w-full border rounded-lg px-3 py-2" required>
                    </div>

                </div>



                <div class="bg-white rounded-xl shadow-md p-6 space-y-4">
                    <h2 class="text-xl font-semibold text-gray-900" style="font-family: cormorant, serif !important;">Metode Pembayaran</h2>
                    <div class="space-y-3">
                        <label for="codCheckbox" class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:border-black">
                            <input type="checkbox" id="codCheckbox" name="cod" value="1" class="h-4 w-4">

                            <div>
                                <p class="font-semibold" style="font-family: poppins, sans-serif;">Bayar di Tempat (COD)</p>
                                <p class="text-sm text-gray-600" style="font-family: poppins, sans-serif;">Tersedia untuk area tertentu — centang jika ingin COD</p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <div class="bg-white rounded-xl shadow-md p-6 space-y-4">
                    <h2 class="text-xl font-semibold text-gray-900" style="font-family: cormorant, serif !important;">Ringkasan Pesanan</h2>
                    <div class="flex justify-between text-sm text-gray-700" style="font-family: poppins, sans-serif;">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($subtotal ?? 0, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm text-gray-700" style="font-family: poppins, sans-serif;">
                        <span>Ongkir</span>
                        <span>Rp {{ number_format($shippingCost ?? 0, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-base font-semibold pt-2" style="font-family: poppins, sans-serif;">
                        <span>Total</span>
                        <span>Rp {{ number_format($total ?? 0, 0, ',', '.') }}</span>
                    </div>
                    <button type="submit" id="pay-button" class="w-full bg-black text-white py-3 rounded-lg uppercase tracking-widest text-sm font-semibold hover:bg-gray-800 transition">
                        Lanjutkan ke Pembayaran
                    </button>
                    <a href="/cart" class="block text-center text-sm text-gray-600 hover:text-black" style="font-family: poppins, sans-serif;">Kembali ke Cart</a>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Load provinsi
            fetch('/wilayah/provinsi')
                .then(res => res.json())
                .then(data => {
                    const prov = document.getElementById('province');
                    data.forEach(item => {
                        prov.innerHTML += `
                    <option value="${item.name}" data-id="${item.id}">
                        ${item.name}
                    </option>`;
                    });
                });

            // Load kota saat provinsi dipilih
            document.getElementById('province').addEventListener('change', function() {
                const provinceId = this.options[this.selectedIndex].dataset.id;

                fetch(`/wilayah/kabupaten/${provinceId}`)
                    .then(res => res.json())
                    .then(data => {
                        const city = document.getElementById('city');
                        city.innerHTML = '<option value="">-- Pilih Kota/Kabupaten --</option>';

                        data.forEach(item => {
                            city.innerHTML += `
                        <option value="${item.name}">
                            ${item.name}
                        </option>`;
                        });
                    });
            });

        });
    </script>

    <!-- Midtrans Snap JS -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const payButton = document.getElementById('pay-button');
            const form = document.getElementById('checkoutForm');
            const codCheckbox = document.getElementById('codCheckbox');

            function ensurePaymentField(value) {
                let input = document.getElementById('paymentHidden');
                if (!input) {
                    input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'payment';
                    input.id = 'paymentHidden';
                    form.appendChild(input);
                }
                input.value = value;
            }

            if (payButton && form) {
                payButton.addEventListener('click', function(e) {
                    e.preventDefault();

                    // If COD checkbox is checked, set payment=cod, otherwise default to 'ewallet'
                    if (codCheckbox && codCheckbox.checked) {
                        ensurePaymentField('cod');
                    } else {
                        ensurePaymentField('ewallet');
                    }

                    // Validate required fields
                    if (!form.checkValidity()) {
                        form.reportValidity();
                        return;
                    }

                    // Submit form to save order data first
                    form.submit();
                });
            }
        });

        // If snap token exists, show payment popup
        @if(isset($snapToken) && $snapToken)
        document.addEventListener('DOMContentLoaded', function() {
            const snapToken = "{{ $snapToken }}";

            if (typeof window.snap === 'undefined') {
                console.error('Midtrans Snap not loaded');
                return;
            }

            // Auto-show payment popup
            window.snap.pay(snapToken, {
                onSuccess: function(result) {
                    console.log('Payment success:', result);
                    window.location.href = "{{ route('payments.midtrans.finish') }}?order_id={{ session('pending_order_code') }}&status_code=200&transaction_status=settlement";
                },
                onPending: function(result) {
                    console.log('Payment pending:', result);
                    window.location.href = "{{ route('payments.midtrans.finish') }}?order_id={{ session('pending_order_code') }}&status_code=201&transaction_status=pending";
                },
                onError: function(result) {
                    console.error('Payment error:', result);
                    alert('Pembayaran gagal. Silakan coba lagi.');
                    window.location.href = "{{ route('orders.checkout') }}";
                },
                onClose: function() {
                    console.log('Payment popup closed');
                    // Don't redirect, let user try again
                }
            });
        });
        @endif
    </script>

</x-layoutCategories>