<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('home');
});

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('dashboard')->group(function () {
    Route::resource('products', ProductController::class);
});

//hapus
// Perhatikan ada parameter {id} dan method-nya delete
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

// dumy FE Najran
Route::get('/pesanan', function () {
    return view('pesanan.index');
})->name('pesanan.index');

Route::view('/show', 'pesanan.show');

// Grup untuk admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});

// Grup untuk user
Route::middleware(['auth', 'user'])->prefix('user')->group(function () {
    Route::get('/dashboard', function () {
        return view('user');
    });
});

// Route untuk laporan PDF
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/report-user', [ReportController::class, 'downloadUserReport'])->name('reports.users.download');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/report-product', [ReportController::class, 'downloadProductReport'])->name('reports.products.download');
});