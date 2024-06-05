<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ImageProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('brands', BrandController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('colors', ColorController::class);
Route::apiResource('image_products', ImageProductController::class);
Route::apiResource('orders', OrderController::class);
Route::apiResource('order_details', OrderDetailController::class);
Route::apiResource('payment_methods', PaymentMethodController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('product_details', ProductDetailController::class);
Route::apiResource('sizes', SizeController::class);
Route::apiResource('users', UserController::class);
