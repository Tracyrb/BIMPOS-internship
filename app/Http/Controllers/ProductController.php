<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Stock;
use Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    public function user_index(Request $request)
    {
        $user = Auth::user();
        $products = Product::all();
        $stocks = Stock::where('user_id', $user->id)
                    ->get();

        return view('product.user_index', compact('products', 'stocks'));
    }

    /**
 * Show the form for creating a new resource.
 */
public function create()
{
    $categories = Category::all();
    return view('product.create', compact('categories'));
}

/**
 * Store a newly created resource in storage.
 */
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
    ]);

    $product = new Product;
    $product->name = $request->input('name');
    $product->price = $request->input('price');
    $product->category_id = $request->input('category_id');
    $product->save();

    return redirect()->route('admin.products.index');
}

/**
 * Show the form for editing the specified resource.
 */
public function edit(Product $product)
{
    $categories = Category::all();
    $menus = Menu::all();
    return view('product.edit', compact('product', 'categories', 'menus'));
}

/**
 * Update the specified resource in storage.
 */
public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
    ]);

    $product->update([
        'name' => $request->input('name'),
        'price' => $request->input('price'),
        'category_id' => $request->input('category_id'),
    ]);

    return redirect()->route('admin.products.index');
}

/**
 * Remove the specified resource from storage.
 */
public function destroy(Product $product)
{
    $product->stocks()->delete();
    $product->delete();
    return redirect()->route('admin.products.index');
}

}
