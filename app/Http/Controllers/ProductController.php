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
        $products = Product::orderBy('ProductID', 'desc')->get();

        return view('pages.shop', [
            'products' => $products,
            'pageTitle' => 'Shop All',
            'pageDescription' => 'Explore our full handcrafted jewellery collection.',
            'activeCategory' => 'all',
            'searchTerm' => null,
        ]);
    }

    public function shopCategory($slug)
    {
        $categories = [
            'necklaces' => [
                'id' => 1,
                'title' => 'Necklaces',
                'description' => 'Elegant everyday layers and statement pieces.',
            ],
            'earrings' => [
                'id' => 2,
                'title' => 'Earrings',
                'description' => 'Studs, hoops and drops designed for every style.',
            ],
            'bracelets' => [
                'id' => 3,
                'title' => 'Bracelets',
                'description' => 'Stackable chains and beadwork for every day.',
            ],
            'rings' => [
                'id' => 4,
                'title' => 'Rings',
                'description' => 'Stacks, solitaires and statement pieces.',
            ],
        ];

        if (!array_key_exists($slug, $categories)) {
            abort(404);
        }

        $categoryData = $categories[$slug];

        $products = Product::where('CategoryID', $categoryData['id'])
            ->orderBy('ProductID', 'desc')
            ->get();

        return view('pages.shop', [
            'products' => $products,
            'pageTitle' => $categoryData['title'],
            'pageDescription' => $categoryData['description'],
            'activeCategory' => $slug,
            'searchTerm' => null,
        ]);
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
        $q = trim($request->input('q'));

        $products = Product::query()
            ->when($q, function ($query) use ($q) {
                $query->where('Product_Name', 'LIKE', "%{$q}%")
                    ->orWhere('Description', 'LIKE', "%{$q}%");
            })
            ->orderBy('ProductID', 'desc')
            ->get();

        return view('pages.shop', [
            'products' => $products,
            'pageTitle' => $q ? 'Search Results' : 'Shop All',
            'pageDescription' => $q ? 'Showing results for "' . $q . '"' : 'Explore our full handcrafted jewellery collection.',
            'activeCategory' => 'all',
            'searchTerm' => $q,
        ]);
    }

    public function category($id)
    {
        $category = Category::findOrFail($id);

        $products = Product::where('CategoryID', $id)
            ->orderBy('ProductID', 'desc')
            ->get();

        return view('pages.shop', [
            'products' => $products,
            'pageTitle' => $category->Category_Name ?? 'Category',
            'pageDescription' => 'Browse our curated jewellery collection.',
            'activeCategory' => 'all',
            'searchTerm' => null,
        ]);
    }

   public function earrings()
    {
    $products = Product::where('CategoryID', 2)->get();
    return view('pages.earrings', compact('products'));
    }

    public function necklaces()
    {
    $products = Product::where('CategoryID', 1)->get();
    return view('pages.necklaces', compact('products'));
    }

    public function bracelets()
    {
    $products = Product::where('CategoryID', 3)->get();
    return view('pages.bracelets', compact('products'));
    }

    public function rings()
    {
    $products = Product::where('CategoryID', 4)->get();
    return view('pages.rings', compact('products'));
    }
}
