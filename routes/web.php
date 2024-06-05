<?php

use App\Http\Controllers\AA\AAController;
use App\Http\Controllers\AA\AaStudentController;
use App\Http\Controllers\AA\ClassController;
use App\Http\Controllers\AA\MajorController;
use App\Http\Controllers\AA\PointController;
use App\Http\Controllers\AA\SubjectBKController;
use App\Http\Controllers\AA\SubjectBTECController;
use App\Http\Controllers\AA\ClassSubjectController;
use App\Http\Controllers\AA\CSSController;
use App\Http\Controllers\Student\StudentController;
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

// Auth::routes();

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/home', function () { return view('admin/index'); })->name('admin-home');
Route::get('/admin/acount-customer', function () { return view('admin/acount-customer/index'); })->name('admin-acount-customer');
Route::get('/customer/home', function () { return view('customer/index'); })->name('customer-home');
Route::get('/admin/color', function () { return view('admin/color/index'); })->name('admin-color');
