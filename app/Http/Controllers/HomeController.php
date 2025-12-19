<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Florist;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Cache::remember('active_sliders', 3600, function () {
            return Slider::where('is_active', true)
                ->orderBy('order')
                ->get();
        });

        $signatureProducts = Cache::remember('signature_products', 3600, function () {
            return Product::where('is_active', true)
                ->where(function ($query) {
                    $query->where('is_signature', true)
                          ->orWhere('is_flores', true);
                })
                ->with('category')
                ->take(6)
                ->get();
        });

        return view('home', compact('sliders', 'signatureProducts'));
    }

    public function menu(Request $request)
    {
        $query = Product::where('is_active', true)->with('category');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category') && $request->category !== 'all') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('name', $request->category);
            });
        }

        $products = $query->paginate(12)->appends($request->query());

        // Get unique categories for filter dropdown
        $categories = Cache::remember('product_categories', 3600, function () {
            return Category::whereHas('products', function ($q) {
                $q->where('is_active', true);
            })->pluck('name')->unique();
        });

        return view('menu', compact('products', 'categories'));
    }

    public function florist()
    {
        $florists = Cache::remember('active_florists', 3600, function () {
            return Florist::where('is_active', true)->get();
        });

        return view('florist', compact('florists'));
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
