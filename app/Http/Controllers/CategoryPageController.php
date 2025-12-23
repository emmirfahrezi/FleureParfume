<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;


class CategoryPageController extends Controller
{
    private function applyFiltersToQuery(Request $request, $query)
    {
        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', (float) $request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', (float) $request->price_max);
        }

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
                case 'latest':
                    $query->orderBy('created_at', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        return $query;
    }

    private function getFilteredProducts(Request $request, string $categoryName)
    {
        $query = Product::whereHas('category', function ($q) use ($categoryName) {
            $q->where('name', $categoryName);
        });

        $query = $this->applyFiltersToQuery($request, $query);

        return $query->with('category')->get();
    }

    public function woman(Request $request)
    {
        $products = $this->getFilteredProducts($request, 'Wanita');

        return view('woman', [
            'products' => $products,
            'filters' => $request->only(['q', 'price_min', 'price_max', 'sort'])
        ]);
    }

    public function man(Request $request)
    {
        $products = $this->getFilteredProducts($request, 'Pria');

        return view('man', [
            'products' => $products,
            'filters' => $request->only(['q', 'price_min', 'price_max', 'sort'])
        ]);
    }

    public function unisex(Request $request)
    {
        $products = $this->getFilteredProducts($request, 'Unisex');

        return view('unisex', [
            'products' => $products,
            'filters' => $request->only(['q', 'price_min', 'price_max', 'sort'])
        ]);
    }

    public function exclusive(Request $request)
    {
        $products = $this->getFilteredProducts($request, 'Exclusive');

        return view('exclusive', [
            'products' => $products,
            'filters' => $request->only(['q', 'price_min', 'price_max', 'sort'])
        ]);
    }
}
