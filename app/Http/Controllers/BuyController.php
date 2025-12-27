<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class BuyController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // SEARCH
        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        // SORT
        if ($request->sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            // default: latest
            $query->orderBy('created_at', 'desc');
        }

        // PAGINATION 
        $products = $query->paginate(4)->withQueryString();

        return view('buy', compact('products'));
    }
}
