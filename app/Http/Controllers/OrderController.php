<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $userId = session('UserID');

        $cart = Cart::where('UserID', $userId)
            ->with(['items.product'])
            ->first();

        if (! $cart || $cart->items->isEmpty()) {
            return redirect()->route('basket')->with('error', 'Your basket is empty.');
        }

        DB::beginTransaction();

        try {
            $total = 0;
            $productsById = [];

            foreach ($cart->items as $item) {
                $product = Product::where('ProductID', $item->ProductID)
                    ->lockForUpdate()
                    ->first();

                if (! $product || $product->Stock < $item->Quantity) {
                    throw new \RuntimeException('insufficient_stock');
                }

                $productsById[$item->ProductID] = $product;
            }

            $order = Order::create([
                'UserID' => $userId,
                'OrderDate' => now(),
                'OrderStatus' => 'Pending',
            ]);

            foreach ($cart->items as $item) {
                $product = $productsById[$item->ProductID];

                $lineTotal = $item->Quantity * $product->Price;
                $total += $lineTotal;

                OrderItem::create([
                    'OrderID' => $order->OrderID,
                    'ProductID' => $item->ProductID,
                    'Quantity' => $item->Quantity,
                    'Price' => $product->Price,
                ]);

                $product->decrement('Stock', $item->Quantity);
            }

            $order->save();

            $cart->items()->delete();

            DB::commit();

            return view('pages.order-confirmation', compact('order'));
        } catch (\Throwable $e) {
            DB::rollBack();

            if ($e instanceof \RuntimeException && $e->getMessage() === 'insufficient_stock') {
                return redirect()->route('basket')
                    ->with('error', 'One or more items are out of stock. Please review your basket.');
            }
            dd($e->getMessage()); // This will show the actual error

            return redirect()->route('basket')
                ->with('error', 'Could not place order. Please try again.');
        }
    }
}
