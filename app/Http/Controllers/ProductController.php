<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = [
            [
                'name' => 'Parfum Mawar',
                'category' => 'Wanita',
                'price' => 150000,
                'stock' => 10,
                'image' => 'parfum1.jpg',
            ],
            [
                'name' => 'Parfum Musk',
                'category' => 'Pria',
                'price' => 175000,
                'stock' => 8,
                'image' => 'parfum2.jpg',
            ],
            [
                'name' => 'Parfum Citrus',
                'category' => 'Unisex',
                'price' => 165000,
                'stock' => 12,
                'image' => 'parfum3.jpg',
            ],
        ];

        return view('dashboard.products.index', compact('products'));
    }

    public function create()
    {
        return view('dashboard.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required',
        'category' => 'required|in:Pria,Wanita,Unisex',
        'price' => 'required|numeric',
        'stock' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // upload gambar (dummy save)
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        } else {
            $imagePath = null;
        }

        // nanti data disimpan ke DB
        return redirect()->route('products.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
