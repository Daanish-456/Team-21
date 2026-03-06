<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Throwable;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->orderBy('Stock')
            ->orderBy('Product_Name')
            ->get();

        $categories = Category::orderBy('CategoryName')->get();

        return view('pages.admin.stock', compact('products', 'categories'));
    }

    public function edit(Product $product)
    {
        $product->load('category');
        $categories = Category::orderBy('CategoryName')->get();

        return view('pages.admin.stock-edit', compact('product', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Product_Name' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'Price' => 'required|numeric|min:0',
            'Stock' => 'required|integer|min:0',
            'Image_URL' => 'nullable|string|max:255',
            'CategoryID' => 'required|exists:Category,CategoryID',
        ]);

        Product::create($validated);

        return redirect()->route('admin.stock')->with('success', 'Product added.');
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'Product_Name' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'Price' => 'required|numeric|min:0',
            'Stock' => 'required|integer|min:0',
            'Image_URL' => 'nullable|string|max:255',
            'CategoryID' => 'required|exists:Category,CategoryID',
        ]);

        $product->update($validated);

        return redirect()->route('admin.stock.edit', $product)->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        try {
            $product->delete();
        } catch (Throwable $exception) {
            return redirect()->route('admin.stock')
                ->with('error', 'This product could not be deleted because it is still linked to other records.');
        }

        return redirect()->route('admin.stock')->with('success', 'Product deleted.');
    }
}
