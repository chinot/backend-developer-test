<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Supply\SupplyController;
use App\Http\Controllers\Supply\SupplyTradeController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\CustomerSupplyController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/trade-supplies', [SupplyTradeController::class, 'trade']);

Route::get('/supplies', [SupplyController::class, 'index']);
Route::post('/supplies', [SupplyController::class, 'store']);
Route::get('/supplies/{supplyId}', [SupplyController::class, 'show']);
Route::put('/supplies/{supplyId}', [SupplyController::class, 'update']);

Route::get('/customers', [CustomerController::class, 'index']);
Route::post('/customers', [CustomerController::class, 'store']);
Route::get('/customers/{customerId}', [CustomerController::class, 'show']);
Route::put('/customers/{customerId}', [CustomerController::class, 'update']);

Route::get('/customer-supplies/{customerId}', [CustomerSupplyController::class, 'show']);
Route::post('/customer-supplies', [CustomerSupplyController::class, 'store']);
Route::put('/supplies/{customerSupplyId}', [CustomerSupplyController::class, 'update']);
