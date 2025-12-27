<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    // Menampilkan halaman checkout
    public function checkout()
    {
        
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        // Hitung total
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item->product->price * $item->quantity;
        }
        
        $shippingCost = 20000; // Fixed shipping cost
        $total = $subtotal + $shippingCost;

        // Build Midtrans Snap params and token
        $user = Auth::user();
        $items = [];
        foreach ($cartItems as $item) {
            $items[] = [
                'id' => (string) $item->product_id,
                'price' => (int) $item->product->price,
                'quantity' => (int) $item->quantity,
                'name' => $item->product->name,
            ];
        }

        $orderId = 'INV-' . now()->format('YmdHis') . '-' . Auth::id();
        
        // Store order ID in session for later use
        session(['pending_order_code' => $orderId]);

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $total,
            ],
            'item_details' => $items,
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone ?? '',
            ],
            'enabled_payments' => ['credit_card','gopay','shopeepay','permata_va','bca_va'],
            'credit_card' => ['secure' => true],
            'callbacks' => [
                'finish' => route('payments.midtrans.finish'),
            ],
        ];

        $snapToken = null;
        $errorMessage = null;
        $showPayment = session('show_payment', false);
        
        // Only generate token if we have saved form data
        if ($showPayment) {
            try {
                // Debug: Log config
                Log::info('Midtrans Config', [
                    'server_key' => substr(config('MIDTRANS_SERVER_KEY'), 0, 10) . '...',
                    'is_production' => \Midtrans\Config::$isProduction,
                ]);
                
                $snap = \Midtrans\Snap::createTransaction($params);
                $snapToken = $snap->token ?? null;
                
                Log::info('Snap token generated', ['token' => substr($snapToken, 0, 20) . '...']);
            } catch (\Throwable $e) {
                $errorMessage = $e->getMessage();
                Log::error('Midtrans Snap Error: ' . $errorMessage, [
                    'params' => $params,
                    'trace' => $e->getTraceAsString()
                ]);
            }
            
            // Clear flag
            session()->forget('show_payment');
        }

        return view('formCheckout', compact('cartItems', 'subtotal', 'shippingCost', 'total', 'snapToken', 'errorMessage', 'showPayment'));
    }

    
    
    // Prepare order - save form data and redirect to payment
    public function prepare(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'note' => 'nullable|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'province' => 'required|string',
            'postal_code' => 'required|string',
            'payment' => 'required|in:bank,ewallet,cod',
        ]);
        
        // Store form data in session
        session(['checkout_data' => $validated]);
        
        // Jika payment cod, langsung submit ke store (tanpa Midtrans)
        if ($validated['payment'] === 'cod') {
            // Simulasikan POST ke store dengan data session
            // Redirect ke halaman store (POST) dengan data session
            // Karena tidak bisa POST via redirect, arahkan ke route khusus yang handle COD
            return $this->store(new Request(array_merge($validated, ['payment' => 'cod'])));
        }

        // Jika bukan cod, tetap ke Midtrans
        return redirect()->route('orders.checkout')->with('show_payment', true);
    }

    // Proses checkout dan simpan order
    public function store(Request $request)
    {
        Log::info('=== ORDER STORE CALLED ===', [
            'user_id' => Auth::id(),
            'midtrans_status' => $request->input('midtrans_status'),
            'all_data' => $request->all(),
        ]);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'note' => 'nullable|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'province' => 'required|string',
            'postal_code' => 'required|string',
            'payment' => 'required|in:bank,ewallet,cod',
            'midtrans_status' => 'nullable|string',
        ]);

        // Ambil cart items user
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        // Hitung subtotal dan total
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item->product->price * $item->quantity;
        }
        
        $shippingCost = 20000;
        $total = $subtotal + $shippingCost;

        // Generate unique order code
        $orderCode = 'INV-' . now()->format('YmdHis') . '-' . Auth::id();

        // Determine payment status from Midtrans popup result
        $paymentStatus = 'pending';
        if (isset($validated['midtrans_status'])) {
            if ($validated['midtrans_status'] == 'success') {
                $paymentStatus = 'paid';
            } elseif ($validated['midtrans_status'] == 'pending') {
                $paymentStatus = 'pending';
            }
        }

        // Simpan order dalam transaction
        DB::beginTransaction();
        try {
            // Buat order
            $order = Order::create([
                'user_id' => Auth::id(),
                'code' => $orderCode,
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'note' => $validated['note'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'province' => $validated['province'],
                'postal_code' => $validated['postal_code'],
                'payment_method' => $validated['payment'],
                'payment_status' => $paymentStatus,
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'total' => $total,
                'status' => $paymentStatus == 'paid' ? 'processing' : 'pending',
            ]);

            // Simpan order items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                    'subtotal' => $item->product->price * $item->quantity,
                ]);
            }

            // Hapus cart items setelah checkout
            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            Log::info('Order created successfully', [
                'order_id' => $order->id,
                'order_code' => $order->code,
                'payment_status' => $order->payment_status,
            ]);

            return redirect()->route('orders.success', ['orderId' => $order->id])
                ->with('success', 'Pesanan berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Halaman sukses setelah checkout
    public function success($orderId)
    {
        Log::info('Success page accessed', ['order_id' => $orderId, 'user_id' => Auth::id()]);

        $order = Order::with('orderItems.product')->findOrFail($orderId);
        
        // Pastikan order milik user yang login
        if ($order->user_id !== Auth::id()) {
            Log::warning('Unauthorized success page access', [
                'order_id' => $orderId,
                'order_user_id' => $order->user_id,
                'current_user_id' => Auth::id(),
            ]);
            abort(403);
        }

        return view('orderSuccess', compact('order'));
    }

    // Lihat semua pesanan user
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('orderItems.product')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pesanan.index', compact('orders'));
    }

    // Detail pesanan
    public function show($id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);
        
        // Pastikan order milik user yang login
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('pesanan.detail', compact('order'));
    }
}
