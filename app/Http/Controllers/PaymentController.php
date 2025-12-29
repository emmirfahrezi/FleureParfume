<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Handle Midtrans payment notification/webhook
     */
    public function midtransNotification(Request $request)
    {
        try {
            // Get notification data
            $notif = new \Midtrans\Notification();
            
            $orderId = $notif->order_id;
            $transactionStatus = $notif->transaction_status;
            $fraudStatus = $notif->fraud_status ?? null;
            $paymentType = $notif->payment_type;
            
            // Find order by order_id (code field)
            $order = Order::where('code', $orderId)->first();
            
            if (!$order) {
                Log::error("Order not found: {$orderId}");
                return response()->json(['status' => 'error', 'message' => 'Order not found'], 404);
            }
            
            // Log notification
            Log::info("Midtrans notification received", [
                'order_id' => $orderId,
                'transaction_status' => $transactionStatus,
                'fraud_status' => $fraudStatus,
                'payment_type' => $paymentType,
            ]);
            
            // Update order based on transaction status
            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'accept') {
                    $order->payment_status = 'paid';
                    $order->status = 'processing';
                }
            } elseif ($transactionStatus == 'settlement') {
                $order->payment_status = 'paid';
                $order->status = 'processing';
            } elseif ($transactionStatus == 'pending') {
                $order->payment_status = 'pending';
            } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
                $order->payment_status = 'failed';
                $order->status = 'cancelled';
            } elseif ($transactionStatus == 'refund') {
                $order->payment_status = 'refunded';
            }
            
            $order->save();
            
            return response()->json(['status' => 'success']);
            
        } catch (\Exception $e) {
            Log::error("Midtrans notification error: " . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    
    /**
     * Handle finish redirect (optional - for UX after popup)
     */
    public function midtransFinish(Request $request)
    {
        Log::info('Midtrans finish callback', [
            'user_id' => Auth::id(),
            'query' => $request->all(),
            'has_checkout_data' => session()->has('checkout_data'),
            'has_order_code' => session()->has('pending_order_code'),
        ]);
        
        $orderId = $request->query('order_id');
        $transactionStatus = $request->query('transaction_status');

        // Jika popup ditutup atau status tidak valid, jangan buat order
        $allowedStatuses = ['settlement', 'capture', 'pending'];
        if (!$transactionStatus || !in_array($transactionStatus, $allowedStatuses, true)) {
            Log::info('Payment aborted or closed by user', [
                'order_id' => $orderId,
                'transaction_status' => $transactionStatus,
            ]);
            return redirect()->route('orders.checkout')->with('error', 'Pembayaran dibatalkan. Silakan coba lagi.');
        }
        
        // Get checkout data from session
        $checkoutData = session('checkout_data');
        $orderCode = session('pending_order_code');
        
        if (!$checkoutData || !$orderCode) {
            Log::error('No checkout data in session');
            return redirect()->route('cart.index')->with('error', 'Session expired. Please try again.');
        }
        
        // Get cart items
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty.');
        }
        
        // Calculate totals
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item->product->price * $item->quantity;
        }
        $shippingCost = 20000;
        $total = $subtotal + $shippingCost;
        
        // Determine payment status
        $paymentStatus = 'pending';
        $orderStatus = 'pending';
        
        if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
            $paymentStatus = 'paid';
            $orderStatus = 'processing';
        } elseif ($transactionStatus == 'pending') {
            $paymentStatus = 'pending';
            $orderStatus = 'pending';
        }
        
        // Create order
        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'code' => $orderCode,
                'name' => $checkoutData['name'],
                'email' => $checkoutData['email'],
                'phone' => $checkoutData['phone'],
                'note' => $checkoutData['note'] ?? null,
                'address' => $checkoutData['address'],
                'city' => $checkoutData['city'],
                'province' => $checkoutData['province'],
                'postal_code' => $checkoutData['postal_code'],
                'payment_method' => $checkoutData['payment'],
                'payment_status' => $paymentStatus,
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'total' => $total,
                'status' => $orderStatus,
            ]);
            
            // Save order items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                    'subtotal' => $item->product->price * $item->quantity,
                ]);
            }
            
            // Clear cart
            Cart::where('user_id', Auth::id())->delete();
            
            // Clear session
            session()->forget(['checkout_data', 'pending_order_code']);
            
            DB::commit();
            
            Log::info('Order created from finish callback', ['order_id' => $order->id]);
            
            return redirect()->route('orders.success', ['orderId' => $order->id])
                ->with('success', 'Payment successful! Your order has been placed.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create order from finish callback', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->route('cart.index')->with('error', 'Failed to create order: ' . $e->getMessage());
        }
    }
}
