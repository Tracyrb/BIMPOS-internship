<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    function index()
    {
        return Menu::all();
    }

    public function insert(Request $request)
    {
        // if (!auth()->check()) {
        //     return response()->json(['error' => 'Unauthenticated'], 401);
        // }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'admin_id' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            return ['success' => 'Validation error', 'errors' => $validator->errors()];
        }

        $data = [
            'admin_id' => $request->admin_id,
            'name' => $request->name,
            'description' => $request->description,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $existingMenu = Menu::where('admin_id', $request->admin_id)->first();

        if ($existingMenu) {
            // Menu already exists, update it using upsert
            $data['menu_id'] = $existingMenu->menu_id;
            DB::table('menus')->upsert([$data], ['admin_id', 'menu_id'], ['admin_id', 'menu_id']);
            return ['success' => 'Record updated successfully'];
        } else {
            // Menu doesn't exist, insert a new record
            $lastMenu = Menu::latest()->first();
            $data['menu_id'] = $lastMenu ? $lastMenu->menu_id + 1 : 1;
            DB::table('menus')->insert($data);
            return ['success' => 'Record inserted successfully'];
        }
    }

    public function insertBulk(Request $request)
    {
        $menusData = $request->input('menus');

        if (!is_array($menusData) || empty($menusData)) {
            return response()->json(['error' => 'Invalid data provided'], 400);
        }

        $deletedCount = 0;
        $updatedCount = 0;
        $addedCount = 0;
        $insertData = [];
        $deleteIds = [];
    
        foreach ($menusData as $menuData) {
            $validator = Validator::make($menuData, [
                'menu_id' => 'required|integer',
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'admin_id' => 'required|exists:users,id',
                'isactive' => 'required|boolean',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => 'Validation error', 'errors' => $validator->errors(), 'failed_menu' => $menuData], 400);
            }

            $data = [
                'menu_id' => $menuData['menu_id'],
                'admin_id' => $menuData['admin_id'],
                'name' => $menuData['name'],
                'description' => $menuData['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if ($menuData['isactive']) {
                $insertData[] = $data;
            } else {
                $deleteIds[] = [
                    'menu_id' => $menuData['menu_id'],
                    'admin_id' => $menuData['admin_id'],
                ];
            }
        }

        if (!empty($insertData)) {
            $total = count($insertData);
            $wasInserted = DB::table('menus')->upsert($insertData, ['menu_id', 'admin_id']);

            $updatedCount = $wasInserted - $total;
            $addedCount = $total - $updatedCount;
        }

        if (!empty($deleteIds)) {
            $deletedCount += Menu::whereIn('menu_id', array_column($deleteIds, 'menu_id'))
                ->whereIn('admin_id', array_column($deleteIds, 'admin_id'))
                ->delete();
        }

        return response()->json([
            'success' => 'Records processed successfully',
            'deleted' => $deletedCount,
            'updated' => $updatedCount,
            'added' => $addedCount,
        ], 200);
    }
    public function show($menu_id)
    {
        $menu = Menu::where('menu_id', $menu_id)->first();

        if (!$menu) {
            return response()->json(['message' => 'Menu not found'], 404);
        }

        $categories = Category::where('menu_id', $menu_id)->get();

        $menuData = [
            'menu_id' => $menu->menu_id,
            'description' => $menu->description,
            'categories' => [],
        ];

        foreach ($categories as $category) {
            $categoryData = [
                'category_id' => $category->category_id,
                'description' => $category->description,
                'products' => [],
            ];

            $products = Product::where('category_id', $category->category_id)->get();

            foreach ($products as $product) {
                $productData = [
                    'product_id' => $product->product_id,
                    'description' => $product->description,
                    'stocks' => Stock::where('product_id', $product->product_id)->get(),
                ];

                $categoryData['products'][] = $productData;
            }

            $menuData['categories'][] = $categoryData;
        }

        return response()->json($menuData);
    }

}
