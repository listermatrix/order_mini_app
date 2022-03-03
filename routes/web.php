<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TRANS\CurrencyController;
use App\Http\Controllers\TRANS\AccountController;
use App\Http\Controllers\TRANS\ExchangeController;
use App\Http\Controllers\TRANS\TransactionController;
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


Route::group(['middleware'=> ['guest']], function() {
    Route::get('login', [LoginController::class, 'getLogin'])->name('login');
    Route::post('login', [LoginController::class, 'postLogin'])->name('post_login');
});

Route::middleware(['auth'])->group(function (){

    Route::group(['prefix'=>'dashboard'],function (){

        Route::get('/', [AdminController::class, 'index'])->name('dashboard.index');
        Route::get('/exit', [LoginController::class, 'logout'])->name('dashboard.logout');

        Route::prefix('e_tran')->namespace('TRANS')->group(function (){


            Route::prefix('transaction')->group(function (){
                Route::get('index', [TransactionController::class, 'index'])->name('transactions.index');
                Route::any('create', [TransactionController::class, 'create'])->name('transactions.create');
            });



            Route::prefix('exchange')->group(function (){
                Route::get('index', [ExchangeController::class, 'index'])->name('trans.exchange.index');
                Route::any('create', [ExchangeController::class, 'create'])->name('trans.exchange.create');
            });


            Route::prefix('currency')->group(function (){
                Route::get('index', [CurrencyController::class, 'index'])->name('trans.currency.index');
                Route::any('create', [CurrencyController::class, 'create'])->name('trans.currency.create');
            });



            Route::prefix('accounts')->group(function (){
                Route::get('index', [AccountController::class, 'index'])->name('trans.account.index');
                Route::any('create', [AccountController::class, 'create'])->name('trans.account.create');
            });


        });





    });

});
