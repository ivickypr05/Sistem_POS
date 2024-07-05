<?php

use GuzzleHttp\Middleware;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IncartController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InproductController;
use App\Http\Controllers\TransactionController;

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

Route::view('mail', 'mail.mail');

Auth::routes();
Route::match(['get', 'post'], '/register', function () {
    return redirect('/');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// route midleware pemilik
Route::middleware(['auth', 'pemilik'])->group(function () {
    //category
    Route::get('/category/data', [CategoryController::class, 'data'])->name('category.data');
    Route::resource('/category', CategoryController::class);

    //product
    Route::get('/product/data', [ProductController::class, 'data'])->name('product.data');
    Route::resource('/product', ProductController::class);

    //PRODUK MASUK
    //incart
    Route::get('/incart/data', [IncartController::class, 'data'])->name('incart.data');
    Route::resource('/incart', IncartController::class);

    //inproduct
    Route::get('/inproduct/data', [InproductController::class, 'data'])->name('inproduct.data');
    Route::resource('/inproduct', InproductController::class);

    //user
    Route::get('/user/data', [UserController::class, 'data'])->name('user.data');
    Route::resource('/user', UserController::class);


    //Report
    Route::get('/report/data', [ReportController::class, 'data'])->name('report.data');
    Route::resource('/report', ReportController::class);
    Route::post('/report', [ReportController::class, 'index'])->name('report.index');
    Route::post('/export-pdf', [ReportController::class, 'exportPDF'])->name('export-pdf');

    // PENJUALAN
    //cart
    Route::get('/cart/data', [CartController::class, 'data'])->name('cart.data');
    Route::resource('/cart', CartController::class);

    //transaction
    Route::get('/transaction/all', [TransactionController::class, 'transactionall'])->name('transaction.all');
    Route::get('/transaction/small-pdf/{id}', [TransactionController::class, 'smallPDF'])->name('small-pdf');
    Route::get('/transaction/big-pdf/{id}', [TransactionController::class, 'bigPDF'])->name('big-pdf');
});

// route midleware kasir
Route::middleware(['auth'])->group(function () {
    // PENJUALAN
    //cart
    Route::get('/cart/data', [CartController::class, 'data'])->name('cart.data');
    Route::resource('/cart', CartController::class);

    //transaction
    Route::get('/transaction/data', [TransactionController::class, 'data'])->name('transaction.data');
    Route::resource('/transaction', TransactionController::class);
    Route::get('/transaction/small-pdf/{id}', [TransactionController::class, 'smallPDF'])->name('small-pdf');
    Route::get('/transaction/big-pdf/{id}', [TransactionController::class, 'bigPDF'])->name('big-pdf');
});
