<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class CartController extends Controller {
  public function index() {
    $cart = session('cart', []);
    return view('frontend.cart.index', compact('cart'));
  }

  public function add(Request $r) {
    $r->validate([
      'menu_id' => 'required|exists:menus,id',
      'qty' => 'required|integer|min:1',
    ]);

    $menu = \App\Models\Menu::findOrFail($r->menu_id);
    $cart = session('cart', []);
    $key = $menu->id;
    if(isset($cart[$key])) $cart[$key]['qty'] += $r->qty;
    else $cart[$key] = ['id'=>$menu->id,'name'=>$menu->name,'price'=>$menu->price,'qty'=>$r->qty,'image'=>$menu->image];
    session(['cart'=>$cart]);
    return back()->with('success','Added to cart');
  }

  public function remove(Request $r) {
    $cart = session('cart', []);
    unset($cart[$r->key]);
    session(['cart'=>$cart]);
    return back();
  }
}
