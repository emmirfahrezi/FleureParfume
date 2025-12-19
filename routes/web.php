<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return Auth::check() ? view('home.user') : view('home');
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

// Debug route to inspect authentication/session state (local only)
if (app()->environment('local')) {
    Route::get('/_debug_auth', function () {
        return response()->json([
            'auth' => Auth::check(),
            'user' => Auth::user(),
            'session_id' => session()->getId(),
            'session' => session()->all(),
            'cookies' => request()->cookie(),
        ]);
    });
}
