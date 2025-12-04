<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController
{
    protected function getUserCart()
    {
        // Your app stores the logged-in user ID in the session
        $userId = session('UserID');

        if (!$userId) {
            // Extra safety – middleware should normally catch this
            abort(403, 'You must be logged in to use the basket.');
        }

        return Cart::firstOrCreate([
            'UserID' => $userId,
        ]);
    }

  public function show()
{
    $cart = $this->getUserCart();

    $items = DB::table('cart_item')
        ->join('Product', 'cart_item.ProductID', '=', 'Product.ProductID')
        ->where('cart_item.CartID', $cart->CartID)
        ->select(
            'cart_item.CartID',
            'cart_item.ProductID',
            'cart_item.Quantity',
            'Product.Product_Name',
            'Product.Price',
            'Product.Image_URL'
        )
        ->get();

    return view('pages.basket', compact('cart', 'items'));
}


  public function add($productId, Request $request)
{
    $cart    = $this->getUserCart(); // ensures Cart row exists for this user
    $product = Product::where('ProductID', $productId)->firstOrFail();

    $quantity = max(1, (int) $request->input('quantity', 1));

    // IMPORTANT: use your real table name here – I’ll keep 'cart_item' as before
    $existingItem = DB::table('cart_item')
        ->where('CartID', $cart->CartID)
        ->where('ProductID', $product->ProductID)
        ->first();

    if ($existingItem) {
        // We don't rely on CartItemID anymore, just update by CartID & ProductID
        DB::table('cart_item')
            ->where('CartID', $cart->CartID)
            ->where('ProductID', $product->ProductID)
            ->update([
                'Quantity' => $existingItem->Quantity + $quantity,
            ]);
    } else {
        // Insert new row
        DB::table('cart_item')->insert([
            'CartID'    => $cart->CartID,
            'ProductID' => $product->ProductID,
            'Quantity'  => $quantity,
        ]);
    }

    return redirect()->route('basket')->with('success', 'Item added to basket.');
}


    public function update($productId, Request $request)
    {
        $cart = $this->getUserCart();
        $quantity = max(1, (int) $request->input('quantity', 1));

        CartItem::where('CartID', $cart->CartID)
            ->where('ProductID', $productId)
            ->update(['Quantity' => $quantity]);

        return redirect()->route('basket')->with('success', 'Basket updated.');
    }

    public function remove($productId)
    {
        $cart = $this->getUserCart();

        CartItem::where('CartID', $cart->CartID)
            ->where('ProductID', $productId)
            ->delete();

        return redirect()->route('basket')->with('success', 'Item removed from basket.');
    }
}
