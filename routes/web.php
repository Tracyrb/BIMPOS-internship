<?php

use App\Http\Controllers\CustomRegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomLoginController;
use App\Http\Controllers\StockController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/custom-login', [CustomLoginController::class, 'login'])->name('custom-login');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth', 'auth:sanctum', 'verified', 'checkAdmin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/menus', [MenuController::class, 'index'])->name('admin.menus.index')->middleware('auth');
    Route::get('/menus/create', [MenuController::class, 'create'])->name('admin.menus.create');
    Route::post('/menus', [MenuController::class, 'store'])->name('admin.menus.store');
    Route::get('/menus/{menu}/edit', [MenuController::class, 'edit'])->name('admin.menus.edit');
    Route::put('/menus/{menu}', [MenuController::class, 'update'])->name('admin.menus.update');
    Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])->name('admin.menus.destroy');

    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    Route::get('/stocks', [StockController::class, 'index'])->name('admin.stocks.index');
    Route::get('/stocks/create', [StockController::class, 'create'])->name('admin.stocks.create');
    Route::post('/stocks', [StockController::class, 'store'])->name('admin.stocks.store');
    Route::get('/stocks/{stock}/edit', [StockController::class, 'edit'])->name('admin.stocks.edit');
    Route::put('/stocks/{stock}', [StockController::class, 'update'])->name('admin.stocks.update');
    Route::delete('/stocks/{stock}', [StockController::class, 'destroy'])->name('admin.stocks.destroy');
});

Route::middleware(['auth:sanctum', 'verified', 'checkUser'])->prefix('user')->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    Route::get('/menus', [MenuController::class, 'user_index'])->name('user.menus.index');
    Route::get('/categories', [CategoryController::class, 'user_index'])->name('user.categories.index');
    Route::get('/products', [ProductController::class, 'user_index'])->name('user.products.index');
});