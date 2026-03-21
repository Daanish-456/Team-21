<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    private function formatAddress(array $validated): string
    {
        return rtrim(implode("\n", [
            $validated['address_line_1'],
            $validated['address_line_2'] ?? '',
            $validated['city'],
            $validated['county'] ?? '',
            strtoupper($validated['postcode']),
            $validated['country'],
        ]), "\n");
    }

    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'card_name' => 'required|string|max:255',
            'card_number' => 'required|string|max:19',
            'expiry' => 'required|string|max:5',
            'cvv' => 'required|string|max:4',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:120',
            'county' => 'nullable|string|max:120',
            'postcode' => 'required|string|max:20',
            'country' => 'required|string|max:120',
        ]);

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
            $user = User::where('UserID', $userId)->first();
            $formattedAddress = $this->formatAddress($validated);

            foreach ($cart->items as $item) {
                $product = Product::where('ProductID', $item->ProductID)
                    ->lockForUpdate()
                    ->first();

                if (! $product || $product->Stock < $item->Quantity) {
                    throw new \RuntimeException('insufficient_stock');
                }

                $productsById[$item->ProductID] = $product;
            }

            if ($user && $request->boolean('save_address')) {
                $user->Address = $formattedAddress;
                $user->save();
            }

            $order = Order::create([
                'UserID' => $userId,
                'OrderDate' => now(),
                'OrderStatus' => 'Pending',
                'Address' => $formattedAddress,
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

            $order->TotalAmount = $total;
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

            return redirect()->route('basket')
                ->with('error', 'Could not place order. Please try again.');
        }
    }
}
