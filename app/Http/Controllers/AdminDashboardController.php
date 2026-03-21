<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('category')->get();
        $totalProducts = $products->count();
        $totalUnits = $products->sum('Stock');
        $lowStockProducts = $products->where('Stock', '<=', 5)->sortBy('Stock')->values();
        $outOfStockProducts = $products->where('Stock', '<=', 0)->count();
        $stats = [
            ['label' => 'Total Products', 'value' => $totalProducts],
            ['label' => 'Total Units in Stock', 'value' => $totalUnits],
            ['label' => 'Low Stock Lines', 'value' => $lowStockProducts->count()],
            ['label' => 'Out of Stock', 'value' => $outOfStockProducts],
        ];

        $sort = $request->string('order_sort')->toString();
        $sort = in_array($sort, ['newest', 'oldest', 'highest', 'lowest'], true) ? $sort : 'newest';

        $ordersQuery = Order::query()
            ->with([
                'user:UserID,Name',
                'items',
            ]);

        if ($sort === 'oldest') {
            $ordersQuery->orderBy('OrderDate', 'asc');
        } elseif ($sort === 'highest') {
            $ordersQuery->orderBy('TotalAmount', 'desc');
        } elseif ($sort === 'lowest') {
            $ordersQuery->orderBy('TotalAmount', 'asc');
        } else {
            $ordersQuery->orderBy('OrderDate', 'desc');
        }

        $orders = $ordersQuery
            ->limit(6)
            ->get()
            ->map(function ($order) {
                $itemAmount = $order->items->sum('Quantity');
                $calculatedTotal = $order->items->sum(function ($item) {
                    return $item->Price * $item->Quantity;
                });
                $displayTotal = $order->TotalAmount;

                if ($displayTotal <= 0 && $calculatedTotal > 0) {
                    $displayTotal = $calculatedTotal;
                }

                return [
                    'id' => $order->OrderID,
                    'customer' => $order->user?->Name ?? 'Guest',
                    'item_amount' => $itemAmount,
                    'status' => $order->OrderStatus ?? 'Pending',
                    'total' => '£'.number_format($displayTotal, 2),
                ];
            })
            ->all();

        $inventory = $lowStockProducts->take(6)->map(function ($product) {
            return [
                'id' => $product->ProductID,
                'name' => $product->Product_Name,
                'category' => $product->category?->CategoryName ?? 'Uncategorised',
                'stock' => $product->Stock,
            ];
        })->all();

        $ticketTimestampColumn = Schema::hasColumn('Contact_Message', 'created_at') ? 'created_at' : 'CreatedAt';

        $tickets = ContactMessage::query()
            ->orderByDesc($ticketTimestampColumn)
            ->limit(6)
            ->get()
            ->map(function ($ticket) {
                $message = $ticket->message ?? $ticket->Message ?? '';
                $submittedAt = $ticket->created_at ?? $ticket->CreatedAt ?? null;

                return [
                    'id' => $ticket->id ?? $ticket->MessageID ?? '-',
                    'name' => $ticket->name ?? $ticket->Name ?? 'Unknown',
                    'email' => $ticket->email ?? $ticket->Email ?? '-',
                    'message' => Str::limit(trim($message), 90),
                    'submitted' => $submittedAt ? Carbon::parse($submittedAt)->diffForHumans() : null,
                ];
            })
            ->all();

        return view('pages.admin.dashboard', compact('stats', 'orders', 'inventory', 'tickets', 'sort'));
    }
}
