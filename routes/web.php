<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

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
