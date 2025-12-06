<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function show()
    {
        $cart = session('cart', []);
        return view('checkout', compact('cart'));
    }

    public function process(Request $r)
    {
        $cart = session('cart', []);
        if(empty($cart)) return back()->with('error', 'Cart empty');

        $subtotal = array_sum(array_map(fn($i)=> $i['price']*$i['qty'], $cart));

        $order = Order::create([
            'order_number'=>'MD'.time(),
            'customer_name'=>$r->name,
            'phone'=>$r->phone,
            'address'=>$r->address,
            'subtotal'=>$subtotal,
            'total'=>$subtotal,
        ]);

            foreach($cart as $c) {
            $order->items()->create([
            'menu_id' => $c['id'],
            'quantity' => $c['qty'],
            'price' => $c['price'],
            'line_total' => $c['price']*$c['qty'],
                ]);
        }

        session()->forget('cart');

        // Prepare WA message
        $message = "New order #{$order->order_number}\nTotal: Rp {$order->total}\nCustomer: {$order->customer_name}\nItems:\n";
        foreach($order->items as $i) $message .= "- {$i->menu->name} x {$i->quantity}\n";

        $wa = "https://wa.me/628123456789?text=" . urlencode($message);

        // Redirect
        // Setelah menyimpan order
return redirect()->route('payment.process', ['order_id' => $order->id]);

    }
}
