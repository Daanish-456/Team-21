<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Routing\Controller;

class AdminDashboardController extends Controller
{
    public function index()
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

        // to replace these with actual orders once done
        $orders = [
            ['id' => 1, 'customer' => 'Amelia Johnson', 'item' => 'Moonstone Pendant', 'status' => 'Packing', 'total' => '£84.00'],
            ['id' => 2, 'customer' => 'Mia Patel', 'item' => 'Pearl Drop Earrings', 'status' => 'Ready to Ship', 'total' => '£64.00'],
            ['id' => 3, 'customer' => 'Olivia Brown', 'item' => 'Sage Quartz Ring', 'status' => 'Awaiting Payment', 'total' => '£46.00'],
        ];

        $inventory = $lowStockProducts->take(6)->map(function ($product) {
            return [
                'id' => $product->ProductID,
                'name' => $product->Product_Name,
                'category' => $product->category?->CategoryName ?? 'Uncategorised',
                'stock' => $product->Stock,
            ];
        })->all();

        return view('pages.admin.dashboard', compact('stats', 'orders', 'inventory'));
    }
}
