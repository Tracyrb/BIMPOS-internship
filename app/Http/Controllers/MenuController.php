<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::all();
        return view('menu.index', compact('menus'));
    }

    public function User_index()
    {
        $menus = Menu::all();
        return view('menu.user_index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {    
        return view('menu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{   
    $user = Auth::user();
    $request->validate([
        'name' => 'required|string|max:255', 
        'description' => 'nullable|string|max:1250', 
    ]);

    $menu = new Menu;
    $menu->admin_id = $user->admin_id;
    $menu->name = $request->input('name');
    $menu->description = $request->input('description');
    $menu->save();

    return redirect()->route('admin.menus.index');
}
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        return view('menu.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255', 
        ]);

        $menu->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('admin.menus.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu, CategoryController $categoryController)
    {
        $categories = $menu->categories;
        $categories->each(function ($category) use ($categoryController) {
            $categoryController->destroy($category);
        });
        $menu->delete();
        return redirect()->route('admin.menus.index');
    }

}
