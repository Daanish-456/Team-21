<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;

class AdminOrdersController extends Controller
{
    private const ALLOWED_STATUSES = [
        'Pending',
        'Processing',
        'Shipped',
        'Completed',
        'Cancelled',
    ];

    public function index(Request $request)
    {
        $status = $request->string('status')->toString();
        $status = in_array($status, self::ALLOWED_STATUSES, true) ? $status : '';

        $sort = $request->string('sort')->toString();
        $sort = in_array($sort, ['newest', 'oldest', 'highest', 'lowest'], true) ? $sort : 'newest';

        $ordersQuery = Order::query()->with([
            'user:UserID,Name,Email,Phone,Address',
            'items.product:ProductID,Product_Name,Image_URL',
        ]);

        if ($status !== '') {
            $ordersQuery->where('OrderStatus', $status);
        }

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
            ->get()
            ->map(function (Order $order) {
                return $this->mapOrder($order);
            });

        $statusCounts = Order::query()
            ->selectRaw('OrderStatus, COUNT(*) as aggregate')
            ->groupBy('OrderStatus')
            ->pluck('aggregate', 'OrderStatus');

        return view('pages.admin.orders', [
            'orders' => $orders,
            'selectedStatus' => $status,
            'selectedSort' => $sort,
            'statuses' => self::ALLOWED_STATUSES,
            'statusCounts' => $statusCounts,
            'totalOrders' => Order::count(),
        ]);
    }

    public function view(Request $request)
    {
        return $this->index($request);
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'OrderStatus' => 'required|string|in:'.implode(',', self::ALLOWED_STATUSES),
        ]);

        $order->update([
            'OrderStatus' => $validated['OrderStatus'],
        ]);

        if ($request->filled('redirect_to') && $request->input('redirect_to') === 'show') {
            return redirect()
                ->route('admin.orders.show', $order)
                ->with('success', 'Order #'.$order->OrderID.' updated to '.$validated['OrderStatus'].'.');
        }

        return redirect()
            ->route('admin.orders', $request->only(['status', 'sort']))
            ->with('success', 'Order #'.$order->OrderID.' updated to '.$validated['OrderStatus'].'.');
    }

    public function show(Order $order)
    {
        $order->load([
            'user:UserID,Name,Email,Phone,Address',
            'items.product:ProductID,Product_Name,Image_URL',
        ]);

        return view('pages.admin.order-show', [
            'order' => $this->mapOrder($order),
            'statuses' => self::ALLOWED_STATUSES,
        ]);
    }

    private function mapOrder(Order $order): array
    {
        $itemCount = $order->items->sum('Quantity');
        $total = $order->TotalAmount;

        if ($total <= 0) {
            $total = $order->items->sum(function ($item) {
                return  $item->Price * $item->Quantity;
            });
        }

        $addressLines = preg_split("/\r\n|\n|\r/", ($order->Address ?? $order->user?->Address ?? ''));
        $addressLines = array_filter(array_map('trim', $addressLines ?: []));

        return [
            'id' => $order->OrderID,
            'customer_name' => $order->user?->Name ?? 'Guest',
            'customer_email' => $order->user?->Email ?? null,
            'customer_phone' => $order->user?->Phone ?? null,
            'placed_at' => Carbon::parse($order->OrderDate),
            'status' => $order->OrderStatus ?? 'Pending',
            'item_count' => $itemCount,
            'total' => $total,
            'address_lines' => array_values($addressLines),
            'items' => $order->items->map(function ($item) {
                return [
                    'product_name' => $item->product?->Product_Name ?? 'Product unavailable',
                    'image_url' => $item->product?->Image_URL,
                    'quantity' => $item->Quantity,
                    'price' => $item->Price,
                    'line_total' => $item->Price * $item->Quantity,
                ];
            })->all(),
        ];
    }
}
