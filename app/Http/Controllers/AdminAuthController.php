<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminAuthController extends Controller
{
    public function loginPage()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required',
        ]);

        $loginField = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        $credentials = [
            $loginField => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                Auth::logout();
                return back()->withErrors(['username' => 'You do not have admin access.']);
            }
        }

        return back()->withErrors(['username' => 'Invalid credentials.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }

    public function dashboard()
    {
        $totalProducts = \App\Models\Product::count();
        $totalOrders = \App\Models\Order::count();
        $totalUsers = User::count();
        $recentOrders = \App\Models\Order::latest()->take(5)->get();

        return view('admin.dashboard.index', compact('totalProducts', 'totalOrders', 'totalUsers', 'recentOrders'));
    }
}
