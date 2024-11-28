<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ControllerProduse;
use App\Http\Controllers\Admin\CategoryController;
Route::get('/', [ControllerProduse::class, 'index']);

// Admin - Categorii
Route::resource('categories', CategoryController::class)->middleware('auth');

// Public - Produse
Route::get('products', [ProductController::class, 'index'])->name('products.index');


Route::get('/dashboard', function () {
    $products = \App\Models\Product::all();
    $categories = \App\Models\Category::all();
    return view('dashboard', compact('products', 'categories'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('admin.dashboard');
    Route::resource('products', ProductController::class);
});

Route::get('/products', [ProductController::class, 'filterByCategory'])->name('products.filter');
Route::get('/products/welcome', [ControllerProduse::class, 'filterByCategory'])->name('products.welcome');
require __DIR__.'/auth.php';
