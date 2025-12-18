<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return redirect('/dashboard/products');
})->name('dashboard');

Route::prefix('dashboard')->group(function () {
    Route::resource('products', ProductController::class);
});
