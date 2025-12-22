<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;


class CategoryPageController extends Controller
{
    public function woman()
    {
        $products = Product::whereHas('category', function ($query) {
            $query->where('name', 'Wanita');
        })->latest()->get();

        return view('woman', compact('products'));
    }

    public function man()
    {
        $products = Product::whereHas('category', function ($query) {
            $query->where('name', 'Pria');
        })->latest()->get();

        return view('man', compact('products'));
    }

    public function unisex()
    {
        // Ambil produk yang kategorinya 'Unisex'
        $products = Product::whereHas('category', function ($query) {
            $query->where('name', 'Unisex');
        })->latest()->get();

        return view('unisex', compact('products'));
    }
}
