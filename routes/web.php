<?php

use App\Http\Controllers\ColorController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role == 1) {
            return redirect()->route('admin-home');
        } else {
            return redirect()->route('customer-home');
        }
    } else {
        return redirect()->route('customer-home'); // Nếu chưa đăng nhập, mặc định chuyển hướng đến trang customer-home
    }
});


Auth::routes();
//ADMIN
Route::middleware('auth', 'web', 'role:1,2')->group(function () {
    Route::get('/admin/home', function () { return view('admin/home'); })->name('admin-home');
    Route::get('/admin/order', [OrderController::class, 'index'])->name('admin-order');
    Route::get('/admin/order/{order_detail}', [OrderDetailController::class, 'show'])->name('admin-order-detail');
    Route::post('/admin/order/quick-approve', [OrderController::class, 'quickApprove'])->name('admin-orders-quick-approve');
    Route::post('/admin/order/approve/{id}', [OrderController::class, 'approveOrder'])->name('admin-orders-approve');
    Route::post('/admin/order/cancel/{id}', [OrderController::class, 'cancelOrder'])->name('admin-order-cancel');
    Route::get('/admin/cart', [OrderDetailController::class, 'cart'])->name('admin-cart');
    Route::post('/admin/product/{product_detail}', [OrderDetailController::class, 'addToCart'])->name('cart.add');
    Route::delete('/admin/cart/{product_detail}', [OrderDetailController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/admin/cart/update-quantity', [OrderDetailController::class, 'updateQuantity'])->name('cart.updateQuantity');
    Route::post('/admin/cart', [OrderController::class, 'store'])->name('orders-store');
    Route::get('/admin/acount-customer', [UserController::class, 'index'])->name('admin-account-customer');
    Route::get('/admin/acount-employee', [UserController::class, 'index'])->name('admin-account-employee');
    Route::get('/admin/color', [ColorController::class, 'index'])->name('admin-color');
    Route::get('/admin/size', [SizeController::class, 'index'])->name('admin-size');
    Route::get('/admin/brand', [BrandController::class, 'index'])->name('admin-brand');
    Route::get('/admin/pay', [PaymentMethodController::class, 'index'])->name('admin-pay');
    Route::get('/admin/product', [ProductController::class, 'index'])->name('admin-product');
    Route::get('/admin/product/{product_detail}', [ProductDetailController::class, 'show'])->name('admin-product-detail');
    Route::get('/admin/category', [CategoryController::class, 'index'])->name('admin-category');
    Route::get('/admin/image', [ImageProductController::class, 'index'])->name('admin-image');
});

//CUSTOMER

//login
Route::get('/customer/login', function () {
    return view('customer/login');
})->name('customer-login');
Route::get('/customer/register', function () {
    return view('customer/register');
})->name('customer-register');

Route::get('/customer/logout', [CustomerController::class, 'logout'])->name('customer-logout');
Route::post('/customer/login', [CustomerController::class, 'login']);
Route::post('/customer/register', [CustomerController::class, 'register']);

Route::get('/customer/home', [HomeController::class, 'indexCustomer'])->name('customer-home');
Route::get('/customer/product', [ProductController::class, 'indexCustomer'])->name('customer-product');
Route::get('/customer/product/{product_detail}', [ProductDetailController::class, 'showCustomer'])->name('customer-product-detail');
// routes/web.php
Route::post('/save-selection-to-session', [App\Http\Controllers\ProductDetailController::class, 'saveSelectionToSession'])->name('save-selection-to-session');

Route::get('/cart', [OrderDetailController::class, 'cartCustomer'])->name('customer-shopping-cart');
Route::post('/customer/product/{product_detail}', [OrderDetailController::class, 'addToCart'])->name('customer-cart-add');
Route::post('/cart', [OrderController::class, 'storeCustomer'])->name('customer-cart-store');
Route::delete('/customer/cart/{product_detail}', [OrderDetailController::class, 'removeFromCart'])->name('customer-cart-remove');
Route::post('/cart/updated', [OrderDetailController::class, 'updateQuantity'])->name('customer-cart-updateQuantity');


Route::middleware(['auth', 'web', 'role:0'])->group(function () {
    Route::get('/account',  [OrderController::class, 'indexCustomer'])->name('customer-account');
    Route::get('/account/{order_detail}', [OrderDetailController::class, 'showCustomer'])->name('customer-order-detail');
});
