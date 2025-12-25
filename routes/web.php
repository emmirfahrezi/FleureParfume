<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Dedoc\Scramble\Scramble;
use Illuminate\Support\Str;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CategoryPageController;

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

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Products
Route::prefix('dashboard')->group(function () {
    Route::resource('products', ProductController::class);
});

Route::get('/about', function () {
    return view('about');
});



Route::view('/contact', 'contact');

// Delete product (public endpoint pointing to dashboard resource action)
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

// Cart routes
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
});

// Order routes
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/success/{order}', [OrderController::class, 'success'])->name('orders.success');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});




//hapus
// Perhatikan ada parameter {id} dan method-nya delete
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
// Delete product
Route::delete('/products/{id}', [ProductController::class, 'destroy'])
    ->name('products.destroy');
    
// Grup untuk admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});

// Grup untuk user
Route::middleware(['auth', 'user'])->prefix('user')->group(function () {
    Route::get('/', function () {
        return view('user');
    })->name('user.dashboard');
});

// Route untuk laporan PDF
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/report-user', [ReportController::class, 'downloadUserReport'])->name('reports.users.download');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/report-product', [ReportController::class, 'downloadProductReport'])->name('reports.products.download');
});

// Register Scramble documentation routes
Scramble::registerUiRoute('/docs');
Scramble::registerJsonSpecificationRoute('/openapi.json');

// Include only API routes (URIs starting with 'api') in documentation

Scramble::routes(function ($route) {
    return true; // include every route
});

Route::get('/profile', function () {
    return view('profile');
})->middleware('auth')->name('profile');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
});

Route::get('/reset-password', function () {
    return view('auth.reset-password');
});
