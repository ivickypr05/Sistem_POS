<?php

use App\Models\Inproduct;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InproductController;
use App\Http\Controllers\IncartController;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//category
Route::get('/category/data', [CategoryController::class, 'data'])->name('category.data');
Route::resource('/category', CategoryController::class);

//product
Route::get('/product/data', [ProductController::class, 'data'])->name('product.data');
Route::resource('/product', ProductController::class);

//inproduct
Route::get('/inproduct/data', [InproductController::class, 'data'])->name('inproduct.data');
Route::resource('/inproduct', InproductController::class);

//inproductdetail
Route::get('/incart/data', [IncartController::class, 'data'])->name('incart.data');
Route::resource('/incart', IncartController::class);
