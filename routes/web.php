<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShoppingCart;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

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
    return redirect()->route('home');
})->middleware('auth')->name('home');

Route::controller(HomeController::class)->group(function () {
    Route::get('/home', 'index')->name('home');
    Route::get('/detalhes/{id}', 'details')->name('details')->middleware('auth');;
});

Route::get('/carrinho', [ShoppingCart::class, 'index'])->name('cart.index');
Route::get('/carrinho/store', function () {
    return redirect()->route('home');
});
Route::post('/carrinho/store', [ShoppingCart::class, 'store'])->name('cart.store');


Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login.index');
    Route::post('/login', 'store')->name('login.store');
    Route::get('/logout', 'destroy')->name('login.destroy');
});

Route::resource('/produto', ProductController::class)->except('show');

Route::resource('/user', UserController::class)->except('show');
