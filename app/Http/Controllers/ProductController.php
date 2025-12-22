<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
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
        $products = $query->with('category')->get();

        // jika request AJAX atau ingin JSON, kembalikan data JSON
        if ($request->ajax() || $request->wantsJson()) {
            $data = $products->map(function ($p) {
                return [
                    'id' => $p->id,
                    'name' => $p->name,
                    'category' => $p->category->name,
                    'price' => $p->price,
                    'stock' => $p->stock,
                    'image' => $p->image ? asset('storage/' . $p->image) : null,
                ];
            });

            return response()->json(['products' => $data]);
        }

        return view('dashboard.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('dashboard.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            //25 kata untuk deskripsi
            'description' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if (str_word_count($value) > 25) {
                        $fail('Maksimal 25 kata saja!.');
                    }
                },
            ],
        ]);



        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        } else {
            $imagePath = null;
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
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

        $categories = Category::all();

        return view('dashboard.products.update', compact('product', 'categories'));
    }

    public function update(Request $request, string $id)
    {

        $product = Product::findOrFail($id);

        //validasi
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            //25 kata untuk deskripsi
            'description' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if (str_word_count($value) > 25) {
                        $fail('Deskripsi kepanjangan Bang! Maksimal 25 kata aja.');
                    }
                },
            ],
        ]);

        //data untuk update
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
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

        return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate!');
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
