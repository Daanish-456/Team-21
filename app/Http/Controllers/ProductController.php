<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{

    public function home()
    {

        $products = Product::limit(3)->get();

        return view('pages.home', compact('products'));
    }

    public function index()
    {
        $products = Product::all();

        return view('pages.shop', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('pages.product.product', compact('product'));
    }


    public function search(Request $request)
    {
        $q = $request->input('q');

        $products = Product::where('Product_Name', 'LIKE', "%{$q}%")
            ->orWhere('Description', 'LIKE', "%{$q}%")
            ->get();

        return view('pages.shop', [
            'products' => $products,
            'searchTerm' => $q,
        ]);
    }


    public function category($id)
    {
        $category = Category::findOrFail($id);

        $products = Product::where('CategoryID', $id)->get();

        return view('pages.shop', [
            'products' => $products,
            'category' => $category,
        ]);
    }
}


