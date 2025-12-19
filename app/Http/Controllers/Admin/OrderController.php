<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // List orders
    public function index(Request $request)
    {
        $query = Order::with('user');

        // Apply filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }
        if ($request->filled('period')) {
            switch ($request->period) {
                case 'today':
                    $query->whereDate('created_at', today());
                    break;
                case 'week':
                    $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'month':
                    $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
                    break;
            }
        }

        $orders = $query->latest()->paginate(10)->appends($request->query());
        return view('admin.orders.index', compact('orders'));
    }

    // Show order detail
    public function show(Order $order)
    {
        $order->load('items.menu'); // eager load
        return view('admin.orders.show', compact('order'));
    }

    // Update status
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,delivering,completed,cancelled'
        ]);

        $order->update(['status'=>$request->status]);

        return back()->with('success','Status pesanan berhasil diperbarui.');
    }

    // Stats (Dashboard)
    public function stats()
    {
        return [
            'pending' => Order::where('status','pending')->count(),
            'completed' => Order::where('status','completed')->count(),
            'cancelled' => Order::where('status','cancelled')->count(),
        ];
    }
}
