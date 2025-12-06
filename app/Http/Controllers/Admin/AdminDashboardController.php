<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'pending' => Order::where('status','pending')->count(),
            'completed' => Order::where('status','completed')->count(),
            'canceled' => Order::where('status','canceled')->count(),
        ];

        $recentOrders = Order::orderBy('created_at','desc')->limit(5)->get();

        return view('admin.dashboard', compact('stats','recentOrders'));
    }
}
