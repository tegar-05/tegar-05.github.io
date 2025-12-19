<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Http\Requests\CheckoutRequest;

class CheckoutController extends Controller
{
    public function show()
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('menu')->with('error', 'Your cart is empty');
        }
        return view('checkout', compact('cart'));
    }

    public function process(CheckoutRequest $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('menu')->with('error', 'Your cart is empty');
        }

        $total = array_sum(array_map(fn($item) => $item['price'] * $item['qty'], $cart));

        // Set initial status based on payment method
        $status = match($request->payment_method) {
            'cod' => 'pending',
            'bank_transfer' => 'awaiting_payment',
            'midtrans' => 'pending_payment',
            default => 'pending'
        };

        $order = Order::create([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'payment_method' => $request->payment_method,
            'total' => $total,
            'status' => $status,
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['qty'],
                'price' => $item['price'],
                'line_total' => $item['price'] * $item['qty'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('checkout.success', $order);
    }

    public function success(Order $order)
    {
        return view('checkout-success', compact('order'));
    }
}
