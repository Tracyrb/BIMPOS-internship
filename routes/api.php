<?php

use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\MenuController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('auth/register',[UserController::class, 'createUser']);
Route::post('auth/login', [UserController::class, 'loginUser']);

// Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('menus', [MenuController::class, 'index']);
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('products', [ProductController::class, 'index']);

    Route::get('menus/{menu_id}', [MenuController::class, 'show']);
    Route::get('categories/{category_id}', [CategoryController::class, 'show']);
    Route::get('products/{product_id}', [ProductController::class, 'show']);

    Route::post('menus', [MenuController::class,'insert']);
    Route::post('menus/bulk', [MenuController::class,'insertBulk']);
    Route::post('categories', [CategoryController::class,'insert']);
    Route::post('products', [ProductController::class,'insert']);
// });


