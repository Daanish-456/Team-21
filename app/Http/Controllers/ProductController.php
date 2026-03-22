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

    public function index(Request $request)
    {
        $query = Product::orderBy('ProductID', 'desc');

        $query = $this->applyFilters($query, $request);

        $products = $query->get();

        return view('pages.shop', [
            'products' => $products,
            'pageTitle' => 'Shop All',
            'pageDescription' => 'Explore our full handcrafted jewellery collection.',
            'activeCategory' => 'all',
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

    public function category($id, Request $request)
    {
        $category = Category::findOrFail($id);

        $query = Product::where('CategoryID', $id)
            ->orderBy('ProductID', 'desc');

        $query = $this->applyFilters($query, $request);

        $products = $query->get();

        return view('pages.shop', [
            'products' => $products,
            'pageTitle' => $category->Category_Name ?? 'Category',
            'pageDescription' => 'Browse our curated jewellery collection.',
            'activeCategory' => 'all',
            'searchTerm' => null,
        ]);
    }

    public function necklaces(Request $request)
    {
        $query = Product::where('CategoryID', 1)->orderBy('ProductID', 'desc');
        $query = $this->applyFilters($query, $request);

        return view('pages.shop', [
            'products' => $query->get(),
            'pageTitle' => 'Necklaces',
            'pageDescription' => 'Explore elegant handcrafted necklaces for every occasion.',
            'activeCategory' => 'necklaces',
            'searchTerm' => null,
        ]);
    }

    public function earrings(Request $request)
    {
        $query = Product::where('CategoryID', 2)->orderBy('ProductID', 'desc');
        $query = $this->applyFilters($query, $request);

        return view('pages.shop', [
            'products' => $query->get(),
            'pageTitle' => 'Earrings',
            'pageDescription' => 'Discover our collection of handcrafted earrings.',
            'activeCategory' => 'earrings',
            'searchTerm' => null,
        ]);
    }

    public function bracelets(Request $request)
    {
        $query = Product::where('CategoryID', 3)->orderBy('ProductID', 'desc');
        $query = $this->applyFilters($query, $request);

        return view('pages.shop', [
            'products' => $query->get(),
            'pageTitle' => 'Bracelets',
            'pageDescription' => 'Browse our handcrafted bracelet collection.',
            'activeCategory' => 'bracelets',
            'searchTerm' => null,
        ]);
    }

    public function rings(Request $request)
    {
        $query = Product::where('CategoryID', 4)->orderBy('ProductID', 'desc');
        $query = $this->applyFilters($query, $request);

        return view('pages.shop', [
            'products' => $query->get(),
            'pageTitle' => 'Rings',
            'pageDescription' => 'Find handcrafted rings designed for everyday wear and special moments.',
            'activeCategory' => 'rings',
            'searchTerm' => null,
        ]);
    }

    public function bestsellers(Request $request)
    {
        $query = Product::where('bestseller', 1)->orderBy('ProductID', 'desc');
        $query = $this->applyFilters($query, $request);

        return view('pages.shop', [
            'products' => $query->get(),
            'pageTitle' => 'Bestsellers',
            'pageDescription' => 'Shop our most loved handcrafted jewellery pieces.',
            'activeCategory' => 'bestsellers',
            'searchTerm' => null,
        ]);
    }

    private function applyFilters($query, Request $request)
    {
        if ($request->has('availability')) {
            $query->whereIn('Availability', $request->availability);
        }

        if ($request->has('shape')) {
            $query->whereIn('StoneShape', $request->shape);
        }

        if ($request->has('stone')) {
            $query->whereIn('Stone', $request->stone);
        }

        if ($request->has('metal')) {
            $query->whereIn('Metal', $request->metal);
        }

        if ($request->filled('min_price')) {
            $query->where('Price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('Price', '<=', $request->max_price);
        }

        return $query;
    }
}