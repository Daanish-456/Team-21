<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class CartController extends Controller
{
    protected function getUserCart()
    {
        return Cart::firstOrCreate([
            'UserID' => Auth::id(),
        ]);
    }

    public function show()
    {
        $cart = $this->getUserCart();

        $items = CartItem::where('CartID', $cart->CartID)
            ->with('product')
            ->get();

        return view('pages.basket', compact('cart', 'items'));
    }

    public function add($productId, Request $request)
    {
        $cart    = $this->getUserCart();
        $product = Product::where('ProductID', $productId)->firstOrFail();

        $quantity = max(1, (int) $request->input('quantity', 1));

        $item = CartItem::firstOrCreate(
            ['CartID' => $cart->CartID, 'ProductID' => $product->ProductID],
            ['Quantity' => 0]
        );

        $item->Quantity += $quantity;
        $item->save();

        return redirect()->route('cart.show')->with('success', 'Item added to basket.');
    }

    public function update($productId, Request $request)
    {
        $cart = $this->getUserCart();
        $quantity = max(1, (int) $request->input('quantity', 1));

        CartItem::where('CartID', $cart->CartID)
            ->where('ProductID', $productId)
            ->update(['Quantity' => $quantity]);

        return redirect()->route('cart.show')->with('success', 'Basket updated.');
    }

    public function remove($productId)
    {
        $cart = $this->getUserCart();

        CartItem::where('CartID', $cart->CartID)
            ->where('ProductID', $productId)
            ->delete();

        return redirect()->route('cart.show')->with('success', 'Item removed from basket.');
    }
}

