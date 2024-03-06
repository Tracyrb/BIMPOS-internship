<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    function index()
    {
        return Category::all();
    }
    function insert(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'menu_id' => 'required|exists:menus,id',
        ]);

        if ($validator->fails()) {
            return ['success' => 'Validation error', 'errors' => $validator->errors()];
        }

        $columns = ['category_name', 'description', 'menu_id'];
        $tableName = 'categories';
        $data = [
            'category_name' => $request->name,
            'description' => $request->description,
            'menu_id' => $request->menu_id,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $item = DB::table($tableName)->where('category_name', $data['category_name'])->first();

        if ($item) {
            DB::table($tableName)->upsert([$data], $columns, ['category_name']);
            return ['success' => 'Record inserted or updated successfully'];
        } else {
            DB::table($tableName)->insert($data);
            return ['success' => 'Record inserted successfully'];
        }
    }

    public function show($category_id)
{
    $category = Category::where('category_id', $category_id)->first();

    if (!$category) {
        return response()->json(['message' => 'Category not found'], 404);
    }

    return $category;
}


}
