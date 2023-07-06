<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\AssessController;
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

Route::get('/laravel', function () {
    return view('welcome');
});

Route::get('/', [AuthController::class, 'home1'])->middleware('auth');
Route::get('/home', [AuthController::class, 'home2'])->middleware('auth');
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/lockscreen', [AuthController::class, 'lockscreen'])->name('lockscreen')->middleware('auth');
Route::post('/lockscreen', [AuthController::class, 'unlockscreen']);

Route::get('/pengguna', [UserController::class, 'index'])->middleware('auth');

Route::get('/admin/sekolah', [SchoolController::class, 'index'])->middleware('auth');

Route::get('/admin/kalendar', [CalendarController::class, 'index'])->middleware('auth');

Route::get('/admin/akun', [AccountController::class, 'index'])->middleware('auth');

Route::get('/admin/guru', [TeacherController::class, 'index'])->middleware('auth');

Route::get('/admin/siswa', [StudentController::class, 'student'])->middleware('auth');
Route::get('/admin/alumni', [StudentController::class, 'alumni'])->middleware('auth');

Route::get('/admin/tagihan', [BillingController::class, 'index'])->middleware('auth');

Route::get('/admin/pembayaran', [PaymentController::class, 'index'])->middleware('auth');
Route::get('/admin/konfirmasi', [PaymentController::class, 'confirm'])->middleware('auth');

Route::get('/admin/pengeluaran', [FinanceController::class, 'credit'])->middleware('auth');
Route::get('/admin/pemasukan', [FinanceController::class, 'debit'])->middleware('auth');

Route::get('/admin/tabungan', [SavingController::class, 'index'])->middleware('auth');
Route::get('/admin/simpanan', [SavingController::class, 'saving'])->middleware('auth');

Route::get('/data/pelajaran', [LessonController::class, 'index'])->middleware('auth');

Route::get('/data/nilai', [AssessController::class, 'index'])->middleware('auth');
Route::get('/data/personal', [AssessController::class, 'detail'])->middleware('auth');
