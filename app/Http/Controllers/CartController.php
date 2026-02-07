<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController
{
    protected function getUserCart()
    {
        $userId = session('UserID');

        if (! $userId) {
            abort(403, 'You must be logged in to use the basket.');
        }

        return Cart::firstOrCreate([
            'UserID' => $userId,
        ]);
    }

    public function show()
    {
        $cart = $this->getUserCart();

        $items = $cart->items()->with('product')->get();

        return view('pages.basket', compact('cart', 'items'));
    }

    public function add($productId, Request $request)
    {
        $cart = $this->getUserCart();
        $product = Product::where('ProductID', $productId)->firstOrFail();

        $quantity = max(1, (int) $request->input('quantity', 1));
        $existingItem = $cart->items()->where('ProductID', $productId)->first();
        $currentQuantity = $existingItem ? $existingItem->Quantity : 0;
        $newQuantity = $currentQuantity + $quantity;

        if ($newQuantity > $product->Stock) {
            return redirect()->back()->with('error', "Cannot add more than {$product->Stock} items. You already have {$currentQuantity} in your basket.");
        }

        if ($existingItem) {
            $existingItem->increment('Quantity', $quantity);
        } else {
            $cart->items()->create([
                'ProductID' => $productId,
                'Quantity' => $quantity,
            ]);
        }

        return redirect()->route('basket')->with('success', 'Item added to basket.');
    }

    public function update($productId, Request $request)
    {
        $cart = $this->getUserCart();
        $product = Product::where('ProductID', $productId)->firstOrFail();
        $quantity = max(1, (int) $request->input('quantity', 1));

        if ($quantity > $product->Stock) {
            return redirect()->route('basket')->with('error', "Cannot set quantity higher than {$product->Stock} available in stock.");
        }

        $cart->items()->where('ProductID', $productId)->update(['Quantity' => $quantity]);

        return redirect()->route('basket')->with('success', 'Basket updated.');
    }

    public function remove($productId)
    {
        $cart = $this->getUserCart();

        $cart->items()->where('ProductID', $productId)->delete();

        return redirect()->route('basket')->with('success', 'Item removed from basket.');
    }
}
