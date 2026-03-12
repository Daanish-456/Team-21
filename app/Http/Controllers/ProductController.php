<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    public function home()
    {
        $products = Product::inRandomOrder()->limit(4)->get();
        $role = null;

        if (session()->has('UserID')) {
            $role = User::where('UserID', session('UserID'))->value('Role');
        }

        return view('pages.home', [
            'products' => $products,
            'isAdmin' => strtolower($role) === 'admin',
        ]);
    }

    public function index()
    {
        $products = Product::all();

        return view('pages.shop', compact('products'));
    }

    public function show($id)
    {
        $product = Product::with([
            'reviews' => function ($query) {
                $query->orderBy('ReviewDate', 'desc');
            },
            'reviews.user',
        ])->findOrFail($id);
        $currentUserId = session('UserID');
        $userReview = null;

        if ($currentUserId) {
            $userReview = $product->reviews->firstWhere('UserID', $currentUserId);
        }

        return view('pages.product.product', compact('product', 'userReview', 'currentUserId'));
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
