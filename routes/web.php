<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Dedoc\Scramble\Scramble;
use Illuminate\Support\Str;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CategoryPageController;
use App\Http\Controllers\OrderController;
use App\Models\Order;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/buy', function () {
    $products = \App\Models\Product::with('category')->inRandomOrder()->get();
    return view('buy', compact('products'));
});

Route::get('/detailProduk/{id}', function ($id) {
    $product = \App\Models\Product::with('category')->findOrFail($id);
    return view('detailProduk', compact('product'));
});


Route::view('/checkout', 'formCheckout');

// Fallback for old /detailProduk route without ID
Route::get('/detailProduk', function () {
    $product = \App\Models\Product::with('category')->firstOrFail();
    return redirect('/detailProduk/' . $product->id);
});

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin area (dashboard, products, reports)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('dashboard')->group(function () {
        Route::resource('products', ProductController::class);
    });

    // Delete product (restrict to admin)
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Route untuk laporan PDF (admin only)
    Route::get('/admin/report-user', [ReportController::class, 'downloadUserReport'])->name('reports.users.download');
    Route::get('/admin/report-product', [ReportController::class, 'downloadProductReport'])->name('reports.products.download');

    // Admin orders list view
    Route::view('/admin/orders', 'dashboard.orders.index')->name('admin.orders.index');
});

Route::get('/about', function () {
    return view('about');
});



Route::view('/contact', 'contact');




// Grup untuk user area
Route::middleware(['auth', 'user'])->prefix('user')->group(function () {
    Route::get('/', function () {
        return view('user');
    })->name('user.dashboard');
});

// Register Scramble documentation routes
Scramble::registerUiRoute('/docs');
Scramble::registerJsonSpecificationRoute('/openapi.json');

// Include only API routes (URIs starting with 'api') in documentation

Scramble::routes(function ($route) {
    return true; // include every route
});

//CATEGORIES\\
// Route Halaman Women
Route::get('/woman', [CategoryPageController::class, 'woman'])->name('woman.index');

// Route Halaman Man
Route::get('/man', [CategoryPageController::class, 'man'])->name('man.index');

// Route Halaman Unisex
Route::get('/unisex', [CategoryPageController::class, 'unisex'])->name('unisex.index');

// Route Halaman Unisex
Route::get('/exclusive', [CategoryPageController::class, 'exclusive'])->name('exclusive.index');

// User-only: orders, profile, cart
Route::middleware(['auth', 'user'])->group(function () {
    // Pesanan / orders for buyers
    Route::get('/pesanan', [OrderController::class, 'index'])->name('pesanan.index');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/success/{orderId}', [OrderController::class, 'success'])->name('orders.success');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

    // Profile
    Route::get('/profile', function () {
        $user = auth()->user();
        return view('profile', compact('user'));
    })->name('profile.show');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/remove/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
});
