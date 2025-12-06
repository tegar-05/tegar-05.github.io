<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Real data from database
        $ordersToday = Order::whereDate('created_at', today())->count();
        $revenueToday = Order::whereDate('created_at', today())->sum('total');
        $topProduct = OrderItem::select('product_name')
            ->groupBy('product_name')
            ->orderByRaw('COUNT(*) DESC')
            ->first()
            ->product_name ?? 'No orders yet';

        $recentOrders = Order::latest()->take(5)->get();

        return view('admin.dashboard.index', compact('ordersToday', 'revenueToday', 'topProduct', 'recentOrders'));
    }

    public function checkNewOrders()
    {
        // Get orders from last 24 hours that are pending
        $newOrders = Order::where('status', 'pending')
            ->where('created_at', '>=', now()->subDay())
            ->count();

        return response()->json(['newOrders' => $newOrders]);
    }
}

