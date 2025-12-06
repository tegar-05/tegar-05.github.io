<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $signatureProducts = Cache::remember('signature_products', 3600, function () {
            return Product::where('is_signature', true)
                ->orWhere('is_flores', true)
                ->with('category')
                ->take(6)
                ->get();
        });

        return view('home', compact('signatureProducts'));
    }

    public function menu()
    {
        $products = Cache::remember('all_products', 3600, function () {
            return Product::with('category')->paginate(12);
        });

        return view('menu', compact('products'));
    }

    public function florist()
    {
        return view('florist');
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function reservation()
    {
        return view('reservation');
    }

    public function order()
    {
        return view('order');
    }
}
