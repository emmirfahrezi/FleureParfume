<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        return view('cart', compact('cartItems'));
    }

    //tambah ke keranjang
    public function store(Request $request)
    {
        //pemgecekan produk sudah ada pada user
        $existingCart = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($existingCart) {
            $existingCart->increment('quantity', $request->quantity);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk masuk keranjang!');
    }

    //hapus product dari keranjang
    public function destroy($id)
    {
        Cart::where('id', $id)->where('user_id', Auth::id())->delete();

        return back()->with('success', 'Produk dihapus!');
    }
}
