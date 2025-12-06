<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Order Notification</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .header { background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 20px; }
        .order-details { background-color: #fff; padding: 20px; border: 1px solid #dee2e6; border-radius: 5px; }
        .item { padding: 10px 0; border-bottom: 1px solid #eee; }
        .total { font-weight: bold; font-size: 18px; color: #28a745; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>New Order from {{ $orderData->customer_name }}</h2>
        <p><strong>Order ID:</strong> #{{ $orderData->id }}</p>
        <p><strong>Phone:</strong> {{ $orderData->customer_phone }}</p>
        <p><strong>Address:</strong> {{ $orderData->customer_address }}</p>
        <p><strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $orderData->payment_method)) }}</p>
        <p><strong>Status:</strong> {{ ucfirst($orderData->status) }}</p>
    </div>

    <div class="order-details">
        <h3>Order Details:</h3>
        <div style="margin-top: 20px;">
            @foreach ($orderData->items as $item)
                <div class="item">
                    <strong>{{ $item->product_name }}</strong> x {{ $item->quantity }}<br>
                    <small>Price: Rp {{ number_format($item->price, 0, ',', '.') }} | Subtotal: Rp {{ number_format($item->subtotal, 0, ',', '.') }}</small>
                </div>
            @endforeach
        </div>

        <div class="total">
            Total: Rp {{ number_format($orderData->total, 0, ',', '.') }}
        </div>
    </div>

    <p style="margin-top: 30px; color: #6c757d;">
        Please process this order promptly. Contact the customer if you need any additional information.
    </p>
</body>
</html>
