<?php

use App\Http\Controllers\API\SavingAPI;
use App\Http\Controllers\API\FinanceAPI;
use App\Http\Controllers\API\BillingAPI;
use App\Http\Controllers\API\PaymentAPI;
use App\Http\Controllers\API\StudentAPI;
use App\Http\Controllers\API\UserAPI;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('user', UserAPI::class);
Route::apiResource('student', StudentAPI::class);
Route::apiResource('payment', PaymentAPI::class);
Route::apiResource('billing', BillingAPI::class);
Route::apiResource('finance', FinanceAPI::class);
Route::apiResource('saving', SavingAPI::class);
