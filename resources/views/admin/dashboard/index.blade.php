@extends('admin.layouts.main')

@section('content')
<style>
    .premium-bg {
        background: linear-gradient(135deg, #1f1c2c, #928dab);
        min-height: 100vh;
        padding: 30px;
        color: white;
    }
    .dashboard-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 25px;
    }
    .glass-card {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.12);
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        border: 1px solid rgba(255,255,255,0.2);
        transition: 0.3s;
    }
    .glass-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.3);
    }
    .stat-number {
        font-size: 32px;
        font-weight: 700;
        margin-top: 10px;
    }
    .recent-box {
        margin-top: 30px;
    }
    table {
        width: 100%;
        color: white;
    }
    table tr td {
        padding: 10px 0;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }
</style>

<div class="premium-bg">

    <div class="dashboard-title">📊 Admin Dashboard – Premium Mode
        <span id="newOrdersBadge" class="hidden bg-red-500 text-white text-xs px-2 py-1 rounded-full ml-2">New</span>
    </div>

    <div class="row" style="display: flex; gap: 20px; flex-wrap: wrap;">

        <div class="glass-card" style="flex: 1; min-width: 260px;">
            <h3>Order Hari Ini</h3>
            <div class="stat-number">{{ $ordersToday }}</div>
        </div>

        <div class="glass-card" style="flex: 1; min-width: 260px;">
            <h3>Pendapatan Hari Ini</h3>
            <div class="stat-number">Rp {{ number_format($revenueToday) }}</div>
        </div>

        <div class="glass-card" style="flex: 1; min-width: 260px;">
            <h3>Menu Terlaris</h3>
            <div class="stat-number">{{ $topProduct }}</div>
        </div>

    </div>


    <!-- Recent Orders -->
    <div class="glass-card recent-box">
        <h3>🧾 Order Terbaru</h3>

        @if($recentOrders->count() == 0)
            <p style="margin-top: 10px;">Belum ada order.</p>
        @else
            <table>
                @foreach($recentOrders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>Rp {{ number_format($order->total) }}</td>
                        <td>{{ $order->created_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
            </table>
        @endif

    </div>

</div>
@endsection
