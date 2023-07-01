<?php

use App\Http\Controllers\SavingController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
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

Route::apiResource('user', UserController::class);
Route::apiResource('student', StudentController::class);
Route::apiResource('payment', PaymentController::class);
Route::apiResource('billing', BillingController::class);
Route::apiResource('finance', FinanceController::class);
Route::apiResource('saving', SavingController::class);
