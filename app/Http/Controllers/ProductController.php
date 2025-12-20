<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // query builder
        $query = Product::query();

        //filter untuk pencarian dari nama produk
        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        //filter dari kategori (pria, wanita, unisex)
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        //filter harga minimum
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        //filter harga max
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        //untuk sorting 
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                default:
                    $query->orderBy('create_at', 'desc');
                    break;
            }
        } else {
            $query->orderBy('create_at', 'desc');
        }

        //execute query ambil data
        $products = $query->get();

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
