<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    static function filterNullOrEmpty($value): bool
    {
        return $value !== null && $value !== '';
    }

    private function applyFilters($query, Request $request)
    {
        $availability = array_filter(Arr::wrap($request->input('availability')), function($value) {
            return ProductController::filterNullOrEmpty($value);
        });
        if ($availability !== []) {
            $query->whereIn('Availability', $availability);
        }

        $shapes = array_filter(Arr::wrap($request->input('shape')), function($value) {
            return ProductController::filterNullOrEmpty($value);
        });
        if ($shapes !== []) {
            $query->whereIn('StoneShape', $shapes);
        }

        $stones = array_filter(Arr::wrap($request->input('stone')), function($value) {
            return ProductController::filterNullOrEmpty($value);
        });
        if ($stones !== []) {
            $query->whereIn('Stone', $stones);
        }

        $metals = array_filter(Arr::wrap($request->input('metal')), function($value) {
            return ProductController::filterNullOrEmpty($value);
        });
        if ($metals !== []) {
            $query->whereIn('Metal', $metals);
        }

        if ($request->filled('min_price')) {
            $query->where('Price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('Price', '<=', $request->max_price);
        }

        return $query;
    }

    
 


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
        $query = Product::query()->orderBy('ProductID', 'desc');

        $query = $this->applyFilters($query, $request);

        $products = $query->get();

        return view('pages.shop', [
            'products' => $products,
            'pageTitle' => 'Shop All',
            'pageDescription' => 'Explore our curated jewellery collection.',
            'activeCategory' => 'all',
            'searchTerm' => $request->q ?? null,
        ]);
    }

    public function show($id)
    {
        $product = Product::with([
            'ringSizes' => function ($query) {
                $query->orderBy('Size');
            },
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

        $query = Product::query()->orderBy('ProductID', 'desc');

        if ($q) {
            $query->where(function ($q2) use ($q) {
                $q2->where('Product_Name', 'LIKE', "%{$q}%")
                    ->orWhere('Description', 'LIKE', "%{$q}%");
            });
        }

        $query = $this->applyFilters($query, $request);

        $products = $query->get();

        return view('pages.shop', [
            'products' => $products,
            'pageTitle' => $q ? 'Search Results' : 'Shop All',
            'pageDescription' => $q
                ? 'Showing results for "' . $q . '"'
                : 'Explore our full handcrafted jewellery collection.',
            'activeCategory' => 'all',
            'searchTerm' => $q ?? null,
        ]);
    }

    private function category(Request $request, int $id, string $activeCategory = 'all')
    {
        $category = Category::findOrFail($id);

        $query = Product::where('CategoryID', $id)
            ->orderBy('ProductID', 'desc');

        $query = $this->applyFilters($query, $request);

        $products = $query->get();

        return view('pages.shop', [
            'products' => $products,
            'pageTitle' => $category->CategoryName ?? 'Category',
            'pageDescription' => 'Browse our curated jewellery collection.',
            'activeCategory' => $activeCategory,
            'searchTerm' => null,
        ]);
    }

    public function earrings(Request $request)
    {
        return $this->category($request, 2, 'earrings');
    }

    public function necklaces(Request $request)
    {
        return $this->category($request, 1, 'necklaces');
    }

    public function bracelets(Request $request)
    {
        return $this->category($request, 3, 'bracelets');
    }

    public function rings(Request $request)
    {
        return $this->category($request, 4, 'rings');
    }

public function bestsellers(Request $request)
{
    $bestsellerIds = [29, 22, 17, 40, 39, 27, 33, 34];

    $query = Product::whereIn('ProductID', $bestsellerIds)
        ->orderByRaw('FIELD(ProductID, ' . implode(',', $bestsellerIds) . ')');

    $query = $this->applyFilters($query, $request);

    return view('pages.shop', [
        'products' => $query->get(),
        'pageTitle' => 'Bestsellers',
        'pageDescription' => 'Discover the pieces our customers return to most.',
        'activeCategory' => 'bestsellers',
        'searchTerm' => null,
    ]);
}
}
