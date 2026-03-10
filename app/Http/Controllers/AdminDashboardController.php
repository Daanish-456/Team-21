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
                'items' => function ($query) {
                    $query->with('product:ProductID,Product_Name');
                },
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
                $firstItem = $order->items->first();
                $extraItemsCount = max($order->items->count() - 1, 0);

                $itemLabel = $firstItem?->product?->Product_Name ?? 'No items';
                if ($extraItemsCount > 0) {
                    $itemLabel .= " +{$extraItemsCount} more";
                }

                return [
                    'id' => $order->OrderID,
                    'customer' => $order->user?->Name ?? 'Guest',
                    'item' => $itemLabel,
                    'status' => $order->OrderStatus ?? 'Pending',
                    'total' => '£'.number_format((float) $order->TotalAmount, 2),
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
                $message = $ticket->message ? $ticket->Message : '';

                return [
                    'id' => $ticket->id,
                    'name' => $ticket->name ?? $ticket->Name ?? 'Unknown',
                    'email' => $ticket->email ?? $ticket->Email ?? '-',
                    'message' => Str::limit(trim((string) $message), 90),
                    'submitted' => $ticket->created_at ? Carbon::parse($ticket->CreatedAt)->diffForHumans() : null,
                ];
            })
            ->all();

        return view('pages.admin.dashboard', compact('stats', 'orders', 'inventory', 'tickets', 'sort'));
    }
}
