<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminAuthController extends Controller
{
    // Show login form
    public function loginPage()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login', ['error' => null]);
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            } else {
                Auth::logout();
                return view('admin.login', ['error' => 'Access denied. Admin privileges required.']);
            }
        }

        return view('admin.login', ['error' => 'Invalid email or password.']);
    }

    // Dashboard
    public function dashboard()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('admin.login');
        }

        try {
            $ordersToday = \App\Models\Order::whereDate('created_at', now())->count();
            $revenueToday = \App\Models\Order::whereDate('created_at', now())->sum('total');
            $topProduct = \App\Models\Product::orderByDesc('sold')->value('name') ?? 'No data';
            $recentOrders = \App\Models\Order::with('user')->latest()->take(5)->get();
        } catch (\Exception $e) {
            $ordersToday = 0;
            $revenueToday = 0;
            $topProduct = 'No data';
            $recentOrders = collect();
        }

        return view('admin.dashboard.index', compact('ordersToday', 'revenueToday', 'topProduct', 'recentOrders'));
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
