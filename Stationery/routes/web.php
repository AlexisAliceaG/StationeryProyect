<?php

use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\State\StateController;
use App\Http\Controllers\Categories\CategoriesController;
use App\Http\Controllers\Supplier\SupplierController;
use App\Http\Controllers\Sale\SaleController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('dashboard')->group(function() {
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/state', [StateController::class, 'index'])->name('state.index');
    Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier.index');
    Route::get('/categorie', [CategoriesController::class, 'index'])->name('categories.index');
    Route::get('/sale', [SaleController::class, 'index'])->name('sales.index');
});
require __DIR__.'/auth.php';
