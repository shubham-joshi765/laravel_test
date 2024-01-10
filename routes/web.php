<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
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
    return view('welcome');
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::group(['prefix' => 'home', 'middleware' => 'auth'], function () {
    Route::resource('/orders', OrderController::class);
    Route::resource('/products', ProductController::class);
    Route::resource('/customers', CustomerController::class);
    Route::get('/download-pdf', [OrderController::class, 'downloadPDF'])->name('orders.downloadPDF');

});
