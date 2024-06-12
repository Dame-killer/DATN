<?php

use App\Http\Controllers\ColorController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageProductController;
use App\Http\Controllers\OrderController;
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
     return redirect()->route('login');
 });

Auth::routes();
//ADMIN
Route::middleware('auth')->group(function () {
    Route::get('/admin/home', function () { return view('admin/index'); })->name('admin-home');
    Route::get('/admin/account-customer', function () { return view('admin/account-customer/index'); })->name('admin-account-customer');
    Route::get('/admin/account-employee', function () { return view('admin/account-employee/index'); })->name('admin-account-employee');
    // Route::get('/admin/employee', [ColorController::class, 'index'])->name('admin-employee');
    Route::get('/admin/color', [ColorController::class, 'index'])->name('admin-color');
    Route::get('/admin/size', [SizeController::class, 'index'])->name('admin-size');
    Route::get('/admin/brand', [BrandController::class, 'index'])->name('admin-brand');
    Route::get('/admin/pay', [PaymentMethodController::class, 'index'])->name('admin-pay');
    Route::get('/admin/product', [ProductController::class, 'index'])->name('admin-product');
    Route::get('/admin/category', [CategoryController::class, 'index'])->name('admin-category');
    Route::get('/admin/image', [ImageProductController::class, 'index'])->name('admin-image');
    Route::get('/admin/order', [OrderController::class, 'index'])->name('admin-order');
});

//CUSTOMER
Route::get('/customer/home', function () { return view('customer/index'); })->name('customer-home');
