<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\AuthAPI;
use App\Http\Controllers\API\TaskAPI;
use App\Http\Controllers\API\UserAPI;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\EventAPI;
use App\Http\Controllers\API\ScoreAPI;
use App\Http\Controllers\API\SavingAPI;
use App\Http\Controllers\API\BillingAPI;
use App\Http\Controllers\API\FinanceAPI;
use App\Http\Controllers\API\PaymentAPI;
use App\Http\Controllers\API\ProjectAPI;
use App\Http\Controllers\API\StudentAPI;
use App\Http\Controllers\API\SubjectAPI;
use App\Http\Controllers\API\TeacherAPI;
use App\Http\Controllers\API\CompetenceAPI;

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

Route::post('register', [AuthAPI::class, 'register']);
Route::post('login', [AuthAPI::class, 'login']);
Route::get('list/student', [StudentAPI::class, 'index']);
Route::get('list/user', [UserAPI::class, 'index']);

Route::middleware('auth:sanctum')->group(function (){
    Route::post('logout', [AuthAPI::class, 'logout']);

    Route::apiResource('user', UserAPI::class);
    Route::apiResource('student', StudentAPI::class);
    Route::apiResource('payment', PaymentAPI::class);
    Route::apiResource('billing', BillingAPI::class);
    Route::apiResource('finance', FinanceAPI::class);
    Route::apiResource('saving', SavingAPI::class);

    Route::apiResource('event', EventAPI::class);
    Route::apiResource('teacher', TeacherAPI::class);
    Route::apiResource('subject', SubjectAPI::class);
    Route::apiResource('competence', CompetenceAPI::class);
    Route::apiResource('score', ScoreAPI::class);
    Route::apiResource('project', ProjectAPI::class);
    Route::apiResource('task', TaskAPI::class);
});
