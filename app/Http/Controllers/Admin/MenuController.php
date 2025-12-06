<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    // List menu
    public function index()
    {
        $menus = Menu::paginate(10);
        return view('admin.menu.index', compact('menus'));
    }

    // Show form create menu
    public function create()
    {
        return view('admin.menu.create');
    }

    // Store new menu
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'description'=>'nullable|string',
            'price'=>'required|numeric',
            'image'=>'nullable|image',
            'is_popular'=>'nullable|boolean',
            'is_active'=>'nullable|boolean',
        ]);

        // Upload image
        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('menus','public');
        }

        $data['slug'] = Str::slug($data['name']).'-'.time();

        Menu::create($data);

        return redirect()->route('admin.menu.index')->with('success','Menu berhasil ditambahkan');
    }

    // Show edit form
    public function edit(Menu $menu)
    {
        return view('admin.menu.edit', compact('menu'));
    }

    // Update menu
    public function update(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'description'=>'nullable|string',
            'price'=>'required|numeric',
            'image'=>'nullable|image',
            'is_popular'=>'nullable|boolean',
            'is_active'=>'nullable|boolean',
        ]);

        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('menus','public');
        }

        $menu->update($data);

        return redirect()->route('admin.menu.index')->with('success','Menu berhasil diupdate');
    }

    // Delete menu
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menu.index')->with('success','Menu berhasil dihapus');
    }
}
