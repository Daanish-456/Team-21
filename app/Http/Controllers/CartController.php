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
        $product = Product::with('ringSizes')->where('ProductID', $productId)->firstOrFail();
        $selectedSize = trim($request->input('size', ''));

        $quantity = max(1, $request->input('quantity', 1));
        $ringSize = null;

        if ($product->ringSizes->isNotEmpty()) {
            $ringSize = $product->ringSizes->firstWhere('Size', $selectedSize);

            if (! $ringSize) {
                return redirect()->back()->with('error', 'Please select a valid ring size.');
            }
        }

        $existingItem = $cart->items()
            ->where('ProductID', $productId)
            ->where('Size', $selectedSize)
            ->first();
        $currentQuantity = $existingItem ? $existingItem->Quantity : 0;
        $newQuantity = $currentQuantity + $quantity;
        $availableStock = $ringSize ? $ringSize->Stock : $product->Stock;

        if ($newQuantity > $availableStock) {
            return redirect()->back()->with('error', "Cannot add more than {$availableStock} items. You already have {$currentQuantity} in your basket.");
        }

        if ($existingItem) {
            $existingItem->increment('Quantity', $quantity);
        } else {
            $cart->items()->create([
                'ProductID' => $productId,
                'Size' => $selectedSize,
                'Quantity' => $quantity,
            ]);
        }

        return redirect()->route('basket')->with('success', 'Item added to basket.');
    }

    public function update($productId, Request $request)
    {
        $cart = $this->getUserCart();
        $product = Product::with('ringSizes')->where('ProductID', $productId)->firstOrFail();
        $selectedSize = trim($request->input('size', ''));
        $quantity = max(1, $request->input('quantity', 1));
        $availableStock = $product->Stock;

        if ($product->ringSizes->isNotEmpty()) {
            $ringSize = $product->ringSizes->firstWhere('Size', $selectedSize);

            if (! $ringSize) {
                return redirect()->route('basket')->with('error', 'Please select a valid ring size.');
            }

            $availableStock = $ringSize->Stock;
        }

        if ($quantity > $availableStock) {
            return redirect()->route('basket')->with('error', "Cannot set quantity higher than {$availableStock} available in stock.");
        }

        $cart->items()
            ->where('ProductID', $productId)
            ->where('Size', $selectedSize)
            ->update(['Quantity' => $quantity]);

        return redirect()->route('basket')->with('success', 'Basket updated.');
    }

    public function remove($productId, Request $request)
    {
        $cart = $this->getUserCart();
        $selectedSize = trim((string) $request->input('size', ''));

        $cart->items()
            ->where('ProductID', $productId)
            ->where('Size', $selectedSize)
            ->delete();

        return redirect()->route('basket')->with('success', 'Item removed from basket.');
    }
}
