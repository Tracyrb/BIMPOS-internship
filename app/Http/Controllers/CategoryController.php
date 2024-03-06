<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }
    public function user_index()
    {
        $categories = Category::all();
        return view('category.user_index', compact('categories'));
    }

    public function create()
    {
        $menus = Menu::all();
        return view('category.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255', 
            'menu_id' => 'required|exists:menus,id',
        ]);

        $category = new Category;
        $category->category_name = $request->input('category_name');
        $category->description = $request->input('description');
        $category->menu_id = $request->input('menu_id') ; 
        $category->save();

        return redirect()->route('admin.categories.index');
    }

    public function edit(Category $category)
    {
        $menus = Menu::all();
        return view('category.edit', compact('category', 'menus'));
    }
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255', 
            'menu_id' => 'required|exists:menus,id',
        ]);

        $category->update([
            'category_name' => $request->input('category_name'),
            'description' => $request->input('description'),
            'menu_id' => $request->input('menu_id'),
        ]);

        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->products()->delete();
        $category->delete();

        return redirect()->route('admin.categories.index');
    }
}
