<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product; // model menu
use Illuminate\Http\Request;

class AdminMenuController extends Controller
{
    public function index()
    {
        // Ambil semua menu
        $menus = Product::orderBy('created_at', 'desc')->get();

        // Kirim ke view
        return view('admin.menu.index', compact('menus'));
    }
}
