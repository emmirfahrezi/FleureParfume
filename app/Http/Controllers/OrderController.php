<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        return view('formCheckout', compact('cartItems', 'subtotal', 'shippingCost', 'total'));
    }

    // Proses checkout dan simpan order
    public function store(Request $request)
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

        // Simpan order dalam transaction
        DB::beginTransaction();
        try {
            // Buat order
            $order = Order::create([
                'user_id' => Auth::id(),
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'note' => $validated['note'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'province' => $validated['province'],
                'postal_code' => $validated['postal_code'],
                'payment_method' => $validated['payment'],
                'payment_status' => 'pending',
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'total' => $total,
                'status' => 'pending',
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

            return redirect()->route('orders.success', $order->id)->with('success', 'Pesanan berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Halaman sukses setelah checkout
    public function success($orderId)
    {
        $order = Order::with('orderItems.product')->findOrFail($orderId);
        
        // Pastikan order milik user yang login
        if ($order->user_id !== Auth::id()) {
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
