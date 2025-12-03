<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function home()
    {

        $products = Product::limit(8)->get();

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

        return view('pages.product.show', compact('product'));
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
}


