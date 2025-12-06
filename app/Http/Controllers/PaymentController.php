<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\NewOrderNotification;
use App\Models\Order;
use App\Models\OrderItem;
use App\Http\Requests\PaymentRequest;

class PaymentController extends Controller
{
    public function process(PaymentRequest $request)
    {
        $validated = $request->validated();

        // Get cart from session
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('menu')->with('error', 'Your cart is empty');
        }

        // Calculate total
        $total = array_sum(array_map(fn($item) => $item['price'] * $item['qty'], $cart));

        // Create order
        $order = Order::create([
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'customer_address' => $validated['customer_address'],
            'payment_method' => $validated['payment_method'],
            'total' => $total,
            'status' => 'pending',
            'user_id' => auth()->id(),
        ]);

        // Create order items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_name' => $item['name'],
                'quantity' => $item['qty'],
                'price' => $item['price'],
                'subtotal' => $item['price'] * $item['qty'],
            ]);
        }

        // Clear cart
        session()->forget('cart');

        // Send email notification
        try {
            Mail::to('admin@madamedjeli.com')->send(new NewOrderNotification($order));
        } catch (\Exception $e) {
            // Log error but don't fail the order
            Log::error('Failed to send order notification email: ' . $e->getMessage());
        }

        // WhatsApp notification
        $message = "Pesanan baru #{$order->id}\nTotal: Rp " . number_format($total, 0, ',', '.') . "\nCustomer: {$request->customer_name}\nPayment: {$request->payment_method}";
        $phone = '628123456789';
        $waUrl = "https://wa.me/{$phone}?text=" . urlencode($message);

        return redirect()->route('home')->with('success', 'Order placed successfully! Check WhatsApp for confirmation: ' . $waUrl);
    }

    private function processMidtransPayment($order, $request)
    {
        // Midtrans configuration
        $serverKey = config('midtrans.server_key', 'SB-Mid-server-Your-Server-Key');
        $clientKey = config('midtrans.client_key', 'SB-Mid-client-Your-Client-Key');
        $isProduction = config('midtrans.is_production', false);

        // Prepare transaction data
        $transactionData = [
            'transaction_details' => [
                'order_id' => 'MD-' . $order->id . '-' . time(),
                'gross_amount' => $order->total,
            ],
            'customer_details' => [
                'first_name' => $request->customer_name,
                'phone' => $request->customer_phone,
                'billing_address' => [
                    'address' => $request->customer_address,
                ],
            ],
            'item_details' => [],
        ];

        // Add items
        foreach ($order->items as $item) {
            $transactionData['item_details'][] = [
                'id' => $item->id,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'name' => $item->product_name,
            ];
        }

        // Midtrans API call (simplified - in production use proper SDK)
        $url = $isProduction
            ? 'https://app.midtrans.com/snap/v1/transactions'
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

        $headers = [
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Basic ' . base64_encode($serverKey . ':'),
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($transactionData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode == 201) {
            $result = json_decode($response, true);
            return $result['redirect_url'];
        }

        // Fallback to COD if Midtrans fails
        return null;
    }

    public function handleNotification(Request $request)
    {
        // Handle Midtrans payment notification
        $notification = json_decode($request->getContent(), true);

        if (!$notification) {
            return response()->json(['status' => 'error'], 400);
        }

        $orderId = $notification['order_id'];
        $status = $notification['transaction_status'];

        // Extract order ID from Midtrans order_id (format: MD-{order_id}-{timestamp})
        $parts = explode('-', $orderId);
        if (count($parts) >= 2) {
            $order = Order::find($parts[1]);

            if ($order) {
                switch ($status) {
                    case 'capture':
                    case 'settlement':
                        $order->update(['status' => 'paid']);
                        break;
                    case 'pending':
                        $order->update(['status' => 'pending_payment']);
                        break;
                    case 'deny':
                    case 'cancel':
                    case 'expire':
                        $order->update(['status' => 'cancelled']);
                        break;
                }
            }
        }

        return response()->json(['status' => 'ok']);
    }
}
