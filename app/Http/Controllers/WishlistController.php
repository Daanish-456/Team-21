<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController
{
    protected function getUserWishlist()
    {
        $userId = session('UserID');

        if (! $userId) {
            abort(403, 'You must be logged in to use the wishlist.');
        }

        return Wishlist::firstOrCreate([
            'UserID' => $userId,
        ]);
    }

    public function show()
    {
        $wishlist = $this->getUserWishlist();

        $items = $wishlist->items()->with('product')->get();

        return view('pages.wishlist', compact('wishlist', 'items'));
    }

    public function add($productId, Request $request)
    {
        $wishlist = $this->getUserWishlist();
        $product = Product::where('ProductID', $productId)->firstOrFail();

        $existing = $wishlist->items()->where('ProductID', $productId)->first();

        if ($existing) {
            return redirect()->back()->with('error', 'This item is already in your wishlist.');
        }

        $wishlist->items()->create([
            'ProductID' => $productId,
        ]);

        return redirect()->back()->with('success', 'Item added to wishlist.');
    }

    public function remove($productId, Request $request)
    {
        $wishlist = $this->getUserWishlist();

        $wishlist->items()->where('ProductID', $productId)->delete();

        return redirect()->route('wishlist')->with('success', 'Item removed from wishlist.');
    }
}
