# Integrasi Midtrans Payment Gateway - Setup Guide

## ✅ Yang Sudah Dikerjakan

1. **SDK Terinstall** ✓
   - `composer require midtrans/midtrans-php` sudah dijalankan

2. **Konfigurasi Server** ✓
   - [AppServiceProvider.php](app/Providers/AppServiceProvider.php) - Midtrans config global

3. **Generate Snap Token** ✓
   - [OrderController.php](app/Http/Controllers/OrderController.php) - method `checkout()`
   - Token digenerate dan dikirim ke view

4. **Frontend Popup** ✓
   - [formCheckout.blade.php](resources/views/formCheckout.blade.php)
   - Snap popup muncul saat klik "Bayar Sekarang"

5. **Webhook Handler** ✓
   - [PaymentController.php](app/Http/Controllers/PaymentController.php)
   - Route: `POST /payments/midtrans/notification`

6. **Update Order Status** ✓
   - OrderController menerima `midtrans_status` dari popup
   - Webhook auto-update payment_status berdasarkan notifikasi Midtrans

7. **Database Migration** ✓
   - Kolom `code` ditambahkan ke tabel orders (untuk order_id Midtrans)

---

## 🔧 Yang Perlu Kamu Lakukan

### 1. Daftar Midtrans Sandbox (5 menit)
- Buka: https://dashboard.sandbox.midtrans.com/register
- Daftar dengan email kamu
- Setelah login, buka **Settings → Access Keys**
- Copy:
  - **Server Key** (SB-Mid-server-xxxxxx)
  - **Client Key** (SB-Mid-client-xxxxxx)

### 2. Update File .env
Tambahkan di akhir file `.env`:

```env
MIDTRANS_SERVER_KEY=SB-Mid-server-xxxxxx
MIDTRANS_CLIENT_KEY=SB-Mid-client-xxxxxx
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_SANITIZE=true
MIDTRANS_ENABLE_3DS=true
```

**Ganti** `xxxxxx` dengan key yang kamu dapat dari dashboard Midtrans.

### 3. Set Webhook di Dashboard Midtrans
- Di dashboard Midtrans → **Settings → Configuration**
- Set **Payment Notification URL**: 
  ```
  https://yourdomain.com/payments/midtrans/notification
  ```
  Untuk testing lokal pakai **ngrok**:
  ```bash
  ngrok http 8000
  ```
  Lalu pakai URL ngrok: `https://xxxx.ngrok.io/payments/midtrans/notification`

---

## 🧪 Testing

### 1. Jalankan Server
```bash
php artisan serve
```

### 2. Flow Testing
1. Login sebagai user
2. Tambah produk ke cart
3. Checkout → isi form alamat
4. Klik "Bayar Sekarang" → popup Midtrans muncul
5. Gunakan kartu test Midtrans:
   - **Card Number**: `4811 1111 1111 1114`
   - **CVV**: `123`
   - **Expiry**: `01/25` (atau bulan/tahun ke depan)
6. Selesaikan pembayaran
7. Order status auto-update ke "paid"

### 3. Test Webhook (Optional)
Pakai Postman atau curl:
```bash
curl -X POST http://localhost:8000/payments/midtrans/notification \
  -H "Content-Type: application/json" \
  -d '{
    "order_id": "INV-20251226123456-1",
    "transaction_status": "settlement",
    "payment_type": "credit_card"
  }'
```

---

## 📁 File yang Berubah

### Backend
- ✅ `app/Providers/AppServiceProvider.php` - Config Midtrans
- ✅ `app/Http/Controllers/OrderController.php` - Generate token & handle status
- ✅ `app/Http/Controllers/PaymentController.php` - Webhook handler (baru)
- ✅ `routes/web.php` - Route webhook
- ✅ `database/migrations/2025_12_26_084316_add_code_to_orders_table.php` - Add code column

### Frontend
- ✅ `resources/views/formCheckout.blade.php` - Snap popup integration

---

## 🚨 Troubleshooting

### Popup tidak muncul
- Pastikan `MIDTRANS_CLIENT_KEY` sudah di `.env`
- Buka Console browser (F12) → cek error JavaScript

### Status tidak update otomatis
- Cek logs: `storage/logs/laravel.log`
- Pastikan webhook URL sudah benar di dashboard Midtrans

### Kartu test ditolak
- Gunakan kartu test resmi Midtrans: https://docs.midtrans.com/reference/test-card-numbers

---

## 📞 Support

Dokumentasi lengkap:
- https://docs.midtrans.com/docs/snap-integration
- https://docs.midtrans.com/docs/snap-snap-js
- https://docs.midtrans.com/reference/test-card-numbers
