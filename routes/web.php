<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Order\CurrencyController;
use App\Http\Controllers\Order\AccountController;
use App\Http\Controllers\Order\ExchangeController;
use App\Http\Controllers\Order\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::redirect('/','/login');

Route::group(['middleware'=> ['guest']], function() {
    Route::get('login', [LoginController::class, 'getLogin'])->name('login');
    Route::post('login', [LoginController::class, 'postLogin'])->name('post_login');
});

Route::middleware(['auth'])->group(function (){

    Route::group(['prefix'=>'dashboard'],function (){

        Route::get('/exit', [LoginController::class, 'logout'])->name('dashboard.logout');

        Route::prefix('order')->namespace('Order')->group(function (){

            Route::get('index', [OrderController::class, 'index'])->name('order.index');
            Route::any('create', [OrderController::class, 'create'])->name('order.create');

            Route::any('edit/{order}', [OrderController::class, 'edit'])->name('order.edit');
            Route::any('log/{order}', [OrderController::class, 'log'])->name('order.log');

        });
    });
});
