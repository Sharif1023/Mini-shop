<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StoreController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminCategoryController;

// =====================
// Public Store Routes
// =====================
Route::get('/', [StoreController::class, 'index'])->name('store.index');
Route::get('/p/{slug}', [StoreController::class, 'show'])->name('store.show');

// =====================
// Cart Routes
// =====================
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// =====================
// Checkout Routes
// =====================
Route::get('/checkout', [CheckoutController::class, 'form'])->name('checkout.form');
Route::post('/checkout', [CheckoutController::class, 'place'])->name('checkout.place');
Route::get('/thanks/{orderId}', [CheckoutController::class, 'thanks'])->name('checkout.thanks');

// =====================
// Admin Auth Routes
// =====================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});

// =====================
// Admin Protected Routes
// =====================
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {

    Route::get('/', fn () => redirect()->route('admin.products.index'))->name('home');

    // Categories CRUD
    Route::resource('categories', AdminCategoryController::class)->except(['show']);

    // Quick Category Add (from product page)
    Route::post('categories/quick', [AdminCategoryController::class, 'quickStore'])
        ->name('categories.quick');

    // Products CRUD
    Route::resource('products', AdminProductController::class)->except(['show']);

    // Orders
    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::post('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status');
});
