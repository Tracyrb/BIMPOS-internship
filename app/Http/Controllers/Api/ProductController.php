<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    function index()
    {
        return Product::all();
    }

    function insert(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return ['success' => 'Validation error', 'errors' => $validator->errors()];
        }

        $columns = ['name', 'price', 'category_id'];
        $tableName = 'products';
        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $item = DB::table($tableName)->where('name', $data['name'])->first();

        if ($item) {
            DB::table($tableName)->upsert([$data], $columns, ['name']);
            return ['success' => 'Record inserted or updated successfully'];
        } else {
            DB::table($tableName)->insert($data);
            return ['success' => 'Record inserted successfully'];
        }
    }

    public function show($product_id)
    {
        $product = Product::where('product_id', $product_id)->first();

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return $product;
    }

}
