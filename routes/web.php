<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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
    return view('buy');
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


Route::get('/exclusive', function () {
    return view('exclusive');
});

Route::view('/contact', 'contact');


//hapus
// Perhatikan ada parameter {id} dan method-nya delete
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
// Delete product
Route::delete('/products/{id}', [ProductController::class, 'destroy'])
    ->name('products.destroy');



// Dummy FE Najran
Route::get('/pesanan', function () {
    return view('pesanan.index');
})->name('pesanan.index');

Route::view('/show', 'pesanan.show');

Route::get('/update', function () {
    return view('dashboard.products.update', [
        'product' => (object)[
            'id' => 1,
            'name' => 'Parfum Dummy',
            'category' => 'Unisex',
            'price' => 150000,
            'stock' => 20,
            'image' => null
        ]
    ]);
});

// end dummy FE Najran
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

//CATEGORIES\\
// Route Halaman Women
Route::get('/woman', [CategoryPageController::class, 'woman'])->name('woman.index');

// Route Halaman Man
Route::get('/man', [CategoryPageController::class, 'man'])->name('man.index');

// Route Halaman Unisex
Route::get('/unisex', [CategoryPageController::class, 'unisex'])->name('unisex.index');
