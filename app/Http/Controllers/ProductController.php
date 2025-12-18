<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
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

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        } else {
            $imagePath = null;
        }

        Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);

        return view('dashboard.products.edit', compact('product'));
    }

    public function update(Request $request, string $id)
    {

        $product = Product::findOrFail($id);

        //validasi
        $request->validate([
            'name' => 'required',
            'category' => 'required|in:Pria,Wanita,Unisex',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'nullable|image|mines:jpg,jpeg,png|max:2048',
        ]);

        //data untuk update
        $data = [
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'stock' => $request->stock,
        ];

        // cek user upload gambar baru
        if ($request->hasFile('image')) {

            //hapus gambar sebelumnya jika ada
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            //upload gambar baru
            $data['image'] = $request->file('image')->store('products', 'public');
        } else {
            //tetep pake gambar lama kalo ga up gambar baru
            $data['image'] = $product->image;
        }

        //excute update
        $product->update($data);
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        //hapus gambr dari storage kalo ada
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        //hapis dari database
        $product->delete($id);

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
