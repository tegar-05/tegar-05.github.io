<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $total = $this->calculateTotal($cart);
        return view('cart', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1|max:99',
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart = session('cart', []);

        // Ensure cart is an array
        if (!is_array($cart)) {
            $cart = [];
        }

        $key = $product->id;

        if (isset($cart[$key])) {
            $cart[$key]['qty'] += $request->qty;
            // Ensure quantity doesn't exceed max
            if ($cart[$key]['qty'] > 99) {
                $cart[$key]['qty'] = 99;
            }
        } else {
            $cart[$key] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => $request->qty,
                'image' => $product->image,
                'category' => $product->category,
            ];
        }

        session(['cart' => $cart]);
        return back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request, $key)
    {
        $request->validate([
            'action' => 'required|in:increase,decrease',
        ]);

        $cart = session('cart', []);

        if (isset($cart[$key])) {
            if ($request->action === 'increase') {
                $cart[$key]['qty'] += 1;
            } elseif ($request->action === 'decrease') {
                $cart[$key]['qty'] -= 1;
                if ($cart[$key]['qty'] <= 0) {
                    unset($cart[$key]);
                }
            }
        }

        session(['cart' => $cart]);
        return back()->with('success', 'Cart updated successfully!');
    }

    public function updateQuantity(Request $request, $product_id)
    {
        $request->validate([
            'qty' => 'required|integer|min:1|max:99',
        ]);

        $cart = session('cart', []);

        // Ensure cart is an array
        if (!is_array($cart)) {
            $cart = [];
        }

        if (isset($cart[$product_id])) {
            $cart[$product_id]['qty'] = $request->qty;
            session(['cart' => $cart]);
            return back()->with('success', 'Quantity updated successfully!');
        }

        return back()->with('error', 'Product not found in cart!');
    }

    public function remove(Request $request, $product_id)
    {
        $cart = session('cart', []);
        unset($cart[$product_id]);
        session(['cart' => $cart]);

        return back()->with('success', 'Product removed from cart!');
    }

    public function clear()
    {
        session(['cart' => []]);
        return back()->with('success', 'Cart cleared successfully!');
    }

    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }
        return $total;
    }
}
