<x-layoutCategories>
    <div class="max-w-6xl mx-auto px-6 py-14 pt-28">
        <div class="mb-8">
            <h1 class="text-4xl font-light tracking-wide" style="font-family: cormorant, serif !important;">Checkout</h1>
            <p class="text-gray-600 mt-2" style="font-family: poppins, sans-serif;">
                Lengkapi detail pengiriman dan pembayaran untuk menyelesaikan pesanan.
            </p>
        </div>

        <form action="#" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @csrf

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

                <div class="bg-white rounded-xl shadow-md p-6 space-y-4">
                    <h2 class="text-xl font-semibold text-gray-900" style="font-family: cormorant, serif !important;">Alamat Pengiriman</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-sm text-gray-600" style="font-family: poppins, sans-serif;">Alamat</label>
                            <input type="text" name="address" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black" placeholder="Jl. Melati No. 10" required>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm text-gray-600" style="font-family: poppins, sans-serif;">Kota / Kabupaten</label>
                            <input type="text" name="city" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black" placeholder="Jakarta" required>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm text-gray-600" style="font-family: poppins, sans-serif;">Provinsi</label>
                            <input type="text" name="province" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black" placeholder="DKI Jakarta" required>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm text-gray-600" style="font-family: poppins, sans-serif;">Kode Pos</label>
                            <input type="text" name="postal_code" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black" placeholder="12345" required>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 space-y-4">
                    <h2 class="text-xl font-semibold text-gray-900" style="font-family: cormorant, serif !important;">Pengiriman</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <label class="border rounded-lg p-4 flex flex-col gap-2 cursor-pointer hover:border-black">
                            <div class="flex items-center gap-2">
                                <input type="radio" name="shipping" value="regular" class="h-4 w-4" checked>
                                <span class="font-semibold" style="font-family: poppins, sans-serif;">Reguler</span>
                            </div>
                            <p class="text-sm text-gray-600" style="font-family: poppins, sans-serif;">Estimasi 2-4 hari</p>
                            <p class="text-sm font-medium" style="font-family: poppins, sans-serif;">Rp 20.000</p>
                        </label>
                        <label class="border rounded-lg p-4 flex flex-col gap-2 cursor-pointer hover:border-black">
                            <div class="flex items-center gap-2">
                                <input type="radio" name="shipping" value="express" class="h-4 w-4">
                                <span class="font-semibold" style="font-family: poppins, sans-serif;">Express</span>
                            </div>
                            <p class="text-sm text-gray-600" style="font-family: poppins, sans-serif;">Estimasi 1-2 hari</p>
                            <p class="text-sm font-medium" style="font-family: poppins, sans-serif;">Rp 35.000</p>
                        </label>
                        <label class="border rounded-lg p-4 flex flex-col gap-2 cursor-pointer hover:border-black">
                            <div class="flex items-center gap-2">
                                <input type="radio" name="shipping" value="pickup" class="h-4 w-4">
                                <span class="font-semibold" style="font-family: poppins, sans-serif;">Ambil di Toko</span>
                            </div>
                            <p class="text-sm text-gray-600" style="font-family: poppins, sans-serif;">Gratis biaya kirim</p>
                            <p class="text-sm font-medium" style="font-family: poppins, sans-serif;">Rp 0</p>
                        </label>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 space-y-4">
                    <h2 class="text-xl font-semibold text-gray-900" style="font-family: cormorant, serif !important;">Metode Pembayaran</h2>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:border-black">
                            <input type="radio" name="payment" value="bank" class="h-4 w-4" checked>
                            <div>
                                <p class="font-semibold" style="font-family: poppins, sans-serif;">Transfer Bank</p>
                                <p class="text-sm text-gray-600" style="font-family: poppins, sans-serif;">BCA / Mandiri / BNI</p>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:border-black">
                            <input type="radio" name="payment" value="ewallet" class="h-4 w-4">
                            <div>
                                <p class="font-semibold" style="font-family: poppins, sans-serif;">E-Wallet</p>
                                <p class="text-sm text-gray-600" style="font-family: poppins, sans-serif;">OVO / GoPay / DANA / ShopeePay</p>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:border-black">
                            <input type="radio" name="payment" value="cod" class="h-4 w-4">
                            <div>
                                <p class="font-semibold" style="font-family: poppins, sans-serif;">Bayar di Tempat (COD)</p>
                                <p class="text-sm text-gray-600" style="font-family: poppins, sans-serif;">Tersedia untuk area tertentu</p>
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
                        <span>Rp 290.000</span>
                    </div>
                    <div class="flex justify-between text-sm text-gray-700" style="font-family: poppins, sans-serif;">
                        <span>Ongkir</span>
                        <span>Rp 20.000</span>
                    </div>
                    <div class="flex justify-between text-base font-semibold pt-2" style="font-family: poppins, sans-serif;">
                        <span>Total</span>
                        <span>Rp 310.000</span>
                    </div>
                    <button type="submit" class="w-full bg-black text-white py-3 rounded-lg uppercase tracking-widest text-sm font-semibold hover:bg-gray-800 transition">
                        Bayar Sekarang
                    </button>
                    <a href="/cart" class="block text-center text-sm text-gray-600 hover:text-black" style="font-family: poppins, sans-serif;">Kembali ke Cart</a>
                </div>
            </div>
        </form>
    </div>
</x-layoutCategories>
