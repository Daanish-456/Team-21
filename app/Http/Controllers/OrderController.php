<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $cart = Cart::where('UserID', session('UserID'))
            ->with(['items.product'])
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('basket')->with('error', 'Your basket is empty.');
        }

        DB::beginTransaction();

        try {
            $total = 0;

            $order = Order::create([
                'UserID'      => session('UserID'),
                'OrderDate'   => now(),
                'OrderStatus' => 'Pending',
                'TotalAmount' => 0, // temp, update after calc
            ]);

            foreach ($cart->items as $item) {
                $lineTotal = $item->Quantity * $item->product->Price;
                $total    += $lineTotal;

                OrderItem::create([
                    'OrderID'   => $order->OrderID,
                    'ProductID' => $item->ProductID,
                    'Quantity'  => $item->Quantity,
                    'Price'     => $item->product->Price,
                ]);
            }

            $order->TotalAmount = $total;
            $order->save();
            
            $cart->items()->delete();

            DB::commit();

            
            return view('pages.order-confirmation', compact('order'));

        } catch (\Throwable $e) {
    DB::rollBack();
    dd($e->getMessage()); // This will show the actual error
}
    }
}

