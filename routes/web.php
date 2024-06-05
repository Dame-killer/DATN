<?php

use App\Http\Controllers\ColorController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\PaymentMethodController;
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

// Route::get('/', function () {
//     return redirect()->route('login');
// });

Auth::routes();
//ADMIN
Route::get('/admin/home', function () { return view('admin/index'); })->name('admin-home');
Route::get('/admin/acount-customer', function () { return view('admin/acount-customer/index'); })->name('admin-acount-customer');
Route::get('/admin/color', [ColorController::class, 'index'])->name('admin-color');
Route::get('/admin/size', [SizeController::class, 'index'])->name('admin-size');
Route::get('/admin/brand', [BrandController::class, 'index'])->name('admin-brand');
Route::get('/admin/pay', [PaymentMethodController::class, 'index'])->name('admin-pay');

//CUSTOMER
Route::get('/customer/home', function () { return view('customer/index'); })->name('customer-home');
