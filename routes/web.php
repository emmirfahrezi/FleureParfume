<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Dedoc\Scramble\Scramble;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CategoryPageController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// HOME
Route::get('/', function () {
    return view('home');
})->name('home');

// BUY PERFUMES (PAGINATION DI SINI)
Route::get('/buy', [BuyController::class, 'index'])->name('buy');

// DETAIL PRODUK
Route::get('/detailProduk/{id}', function ($id) {
    $product = \App\Models\Product::with('category')->findOrFail($id);
    return view('detailProduk', compact('product'));
});

// fallback lama
Route::get('/detailProduk', function () {
    $product = \App\Models\Product::with('category')->firstOrFail();
    return redirect('/detailProduk/' . $product->id);
});

// ABOUT & CONTACT
Route::get('/about', function () {
    return view('about');
});
Route::view('/contact', 'contact');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// GOOGLE LOGIN
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

/*
|--------------------------------------------------------------------------
| CATEGORY PAGES
|--------------------------------------------------------------------------
*/

Route::get('/woman', [CategoryPageController::class, 'woman'])->name('woman.index');
Route::get('/man', [CategoryPageController::class, 'man'])->name('man.index');
Route::get('/unisex', [CategoryPageController::class, 'unisex'])->name('unisex.index');
Route::get('/exclusive', [CategoryPageController::class, 'exclusive'])->name('exclusive.index');

/*
|--------------------------------------------------------------------------
| USER AREA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'user'])->group(function () {

    // DASHBOARD USER
    Route::get('/user', function () {
        return view('user');
    })->name('user.dashboard');

    // PESANAN (INI FIX ERROR NAVBAR)
    Route::get('/pesanan', [OrderController::class, 'index'])->name('pesanan.index');

    // ORDERS (ALIAS INGGRIS, BOLEH DIPAKE JUGA)
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/success/{orderId}', [OrderController::class, 'success'])->name('orders.success');

    // CHECKOUT
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::post('/orders/prepare', [OrderController::class, 'prepare'])->name('orders.prepare');

    // CART
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/remove/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    // PROFILE
    Route::get('/profile', function () {
        $user = Auth::user();
        return view('profile', compact('user'));
    })->name('profile.show');
});

/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('dashboard')->group(function () {
        Route::resource('products', ProductController::class);
    });

    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    // REPORTS
    Route::get('/admin/report-user', [ReportController::class, 'downloadUserReport'])
        ->name('reports.users.download');

    Route::get('/admin/report-product', [ReportController::class, 'downloadProductReport'])
        ->name('reports.products.download');

    // ADMIN USERS
    Route::patch('/admin/users/{id}/role', [AdminUserController::class, 'updateRole'])
        ->name('admin.users.updateRole');

    Route::delete('/admin/users/{id}', [AdminUserController::class, 'destroy'])
        ->name('admin.users.destroy');
});

/*
|--------------------------------------------------------------------------
| API & PAYMENT
|--------------------------------------------------------------------------
*/

// API WILAYAH
Route::get('/wilayah/provinsi', [WilayahController::class, 'provinsi']);
Route::get('/wilayah/kabupaten/{id}', [WilayahController::class, 'kabupaten']);

// MIDTRANS
Route::post('/payments/midtrans/notification', [PaymentController::class, 'midtransNotification'])
    ->name('payments.midtrans.notification');

Route::middleware(['auth', 'user'])->get(
    '/payments/midtrans/finish',
    [PaymentController::class, 'midtransFinish']
)->name('payments.midtrans.finish');

/*
|--------------------------------------------------------------------------
| SCRAMBLE DOCS

*/

Scramble::registerUiRoute('/docs');
Scramble::registerJsonSpecificationRoute('/openapi.json');
Scramble::routes(fn () => true);
