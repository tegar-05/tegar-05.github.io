<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Florist;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // tanggal hari ini
        $today = Carbon::today();

        // total orders today
        $ordersToday = Order::whereDate('created_at', $today)->count();

        // revenue today (sum total column)
        $revenueToday = (int) Order::whereDate('created_at', $today)->sum('total');

        // top sold product (by order_items table or pivot)
        // Example if you have order_items table with product_id and quantity:
        $topProduct = DB::table('order_items')
            ->select('product_id', DB::raw('SUM(quantity) as total_qty'))
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->limit(1)
            ->first();

        $topProductName = null;
        if ($topProduct && $topProduct->product_id) {
            $product = Product::find($topProduct->product_id);
            $topProductName = $product ? $product->name : null;
        }

        // Statistics for CRUD modules
        $totalProducts = Product::count();
        $totalFlorists = Florist::count();
        $totalMenus = Menu::count();
        $totalCategories = Category::count();
        $totalSliders = Slider::count();

        // recent orders (paginated)
        $recentOrders = Order::with('user') // eager load relation user
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.dashboard.index', compact(
            'ordersToday',
            'revenueToday',
            'topProductName',
            'recentOrders',
            'totalProducts',
            'totalFlorists',
            'totalMenus',
            'totalCategories',
            'totalSliders'
        ));
    }

    // JSON endpoint to return new order count for polling
    public function newOrdersCount()
    {
        // define what "new" means; example: orders with is_new flag or created in last X minutes
        $count = Order::where('is_new', true)->count();

        return response()->json(['count' => $count]);
    }

    // Optional: summary JSON for widgets via AJAX
    public function summary()
    {
        $today = Carbon::today();
        $ordersToday = Order::whereDate('created_at', $today)->count();
        $revenueToday = (int) Order::whereDate('created_at', $today)->sum('total');

        return response()->json([
            'ordersToday' => $ordersToday,
            'revenueToday' => $revenueToday,
        ]);
    }

    // Export orders to CSV (optional filters: date_from, date_to, status)
    public function exportOrders(Request $request)
    {
        $from = $request->query('from');
        $to = $request->query('to');
        $status = $request->query('status');

        $query = Order::query()->with('user');

        if ($from) {
            $query->whereDate('created_at', '>=', $from);
        }
        if ($to) {
            $query->whereDate('created_at', '<=', $to);
        }
        if ($status) {
            $query->where('status', $status);
        }

        $fileName = 'orders_export_' . now()->format('Ymd_His') . '.csv';

        $orders = $query->orderByDesc('created_at')->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
        ];

        $callback = function () use ($orders) {
            $handle = fopen('php://output', 'w');

            // header row
            fputcsv($handle, [
                'Order ID', 'Customer', 'Email', 'Total', 'Status', 'Created At'
            ]);

            foreach ($orders as $order) {
                fputcsv($handle, [
                    $order->id,
                    $order->user?->name ?? $order->customer_name ?? 'Guest',
                    $order->user?->email ?? $order->customer_email ?? '',
                    $order->total,
                    $order->status,
                    $order->created_at->toDateTimeString(),
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
