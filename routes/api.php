<?php

use App\Http\Controllers\Order\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group( function () {

    Route::prefix('order')->group(function (){
        Route::any('create', [OrderController::class, 'create'])->name('api.order.create');
        Route::any('cancel/{order_id}', [OrderController::class, 'cancel'])->name('api.order.cancel');
    });
});







