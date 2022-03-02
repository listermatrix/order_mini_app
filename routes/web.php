<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
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

//        Route::get('/','AdminController@index')
        Route::get('/', [AdminController::class, 'index'])->name('dashboard.index');
        Route::get('/exit', [LoginController::class, 'logout'])->name('dashboard.logout');






        Route::prefix('transactions')->namespace('TRANS')->group(function (){

            Route::get('index', [TransactionController::class, 'index'])->name('transactions.index');
            Route::any('create', [TransactionController::class, 'create'])->name('transactions.create');


            Route::any('edit/{request_code}','MScController@edit')->name('transaction.masters.edit');
            Route::post('approval/{request_code}','MScController@approval')->name('transaction.masters.approval');
        });



        Route::prefix('report')->namespace('ADMIN')->group(function (){
            Route::get('index','ReportController@index')->name('report.index');
            Route::any('generate','ReportController@generate')->name('report.generate');
            Route::any('print','ReportController@print')->name('report.print');
        });



    });

    /*** Route Group For Student Archives  ***/
    Route::group(['prefix'=>'archive'],function (){
        Route::group(['prefix'=>'students'],function (){

        });
    });
});
