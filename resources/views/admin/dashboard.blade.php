@extends('admin.layout')

@section('content')
<style>
    body {
        background: #f0f2f5;
    }

    .glass-card {
        backdrop-filter: blur(12px);
        background: rgba(255, 255, 255, 0.35);
        border-radius: 18px;
        border: 1px solid rgba(255, 255, 255, 0.25);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        padding: 25px;
        transition: 0.3s;
    }

    .glass-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.15);
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
        margin-top: 30px;
    }

    .dashboard-title {
        font-size: 28px;
        font-weight: 700;
        color: #333;
    }

    .card-value {
        font-size: 32px;
        font-weight: 700;
        color: #3b3b3b;
    }

    .card-label {
        font-size: 16px;
        opacity: 0.8;
    }
</style>


<div class="px-4 py-4">
    <h2 class="dashboard-title">Dashboard Admin</h2>

    {{-- GRID CARD --}}
    <div class="dashboard-grid">

        <div class="glass-card">
            <div class="card-value">128</div>
            <div class="card-label">Total Orders</div>
        </div>

        <div class="glass-card">
            <div class="card-value">Rp 1.250.000</div>
            <div class="card-label">Pendapatan Hari Ini</div>
        </div>

        <div class="glass-card">
            <div class="card-value">Cappuccino</div>
            <div class="card-label">Produk Terlaris</div>
        </div>

    </div>
</div>
@endsection
