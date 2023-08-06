<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AssessController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CalendarController;

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

Route::get('/maintenance', function () {
    return view('error.maintenance', ['title' => 'Semangkamedia']);
});

Route::resource('/pengguna', UserController::class)->middleware('auth');
Route::resource('/admin/akun', AccountController::class)->middleware('auth');
Route::resource('/admin/keuangan', FinanceController::class)->middleware('auth');
Route::resource('/admin/tabungan', SavingController::class)->middleware('auth');
Route::resource('/admin/siswa', StudentController::class)->middleware('auth');
Route::resource('/admin/guru', TeacherController::class)->middleware('maintenance');

Route::post('/admin/siswa/image/{id}', [StudentController::class, 'image_upload'])->middleware('auth');
Route::get('/admin/alumni', [StudentController::class, 'alumni'])->middleware('auth');

Route::get('/admin/akun/no/{num}', [AccountController::class, 'search'])->middleware('auth');
Route::get('/admin/keuangan/inv/{inv}', [FinanceController::class, 'detail'])->middleware('auth');
Route::get('/admin/keuangan/view/{inv}', [FinanceController::class, 'preview'])->middleware('auth');
Route::get('/admin/tabungan/view/{ids}', [SavingController::class, 'preview'])->middleware('auth');
Route::get('/admin/tabungan/rekap/all', [SavingController::class, 'rekap'])->middleware('auth');

Route::get('/admin/tagihan', [BillingController::class, 'index'])->middleware('auth');
Route::post('/admin/tagihan', [BillingController::class, 'save'])->middleware('auth');
Route::get('/admin/tagihan/0', [BillingController::class, 'preview'])->middleware('auth');
Route::get('/admin/tagihan/{id}', [BillingController::class, 'show'])->middleware('auth');
Route::get('/admin/tagihan/{year}/{category}', [BillingController::class, 'preview'])->middleware('auth');
Route::delete('/admin/tagihan/{year}/{category}', [BillingController::class, 'delete_all'])->middleware('auth');
Route::get('/admin/tagihan/search/ids/{ids}', [BillingController::class, 'billing_search'])->middleware('auth');

Route::get('/admin/pembayaran', [PaymentController::class, 'index'])->middleware('auth');
Route::post('/admin/pembayaran', [PaymentController::class, 'store'])->middleware('auth');
Route::delete('/admin/pembayaran/{id}', [PaymentController::class, 'destroy'])->middleware('auth');
Route::get('/admin/pembayaran/inv/{inv}', [PaymentController::class, 'detail'])->middleware('auth');
Route::get('/admin/pembayaran/view/{inv}', [PaymentController::class, 'preview'])->middleware('auth');
Route::get('/admin/pembayaran/index/{ids}', [PaymentController::class, 'rekap'])->middleware('auth');

Route::get('/', [AuthController::class, 'home1'])->middleware('auth');
Route::get('/home', [AuthController::class, 'home2'])->middleware('auth');
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/lockscreen', [AuthController::class, 'lockscreen'])->name('lockscreen')->middleware('auth');
Route::post('/lockscreen', [AuthController::class, 'unlockscreen']);

Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth');
Route::post('/image', [ProfileController::class, 'image_upload'])->middleware('auth');
Route::post('/password', [ProfileController::class, 'password_change'])->middleware('auth');

Route::get('/admin/sekolah', [SchoolController::class, 'index'])->middleware('auth');
Route::post('/admin/sekolah', [SchoolController::class, 'save'])->middleware('auth');




Route::get('/admin/kalendar', [CalendarController::class, 'index'])->middleware('auth', 'maintenance');

Route::get('/admin/konfirmasi', [PaymentController::class, 'confirm'])->middleware('auth');

// Route::get('/data/pelajaran', [LessonController::class, 'index'])->middleware('auth');
// Route::get('/data/nilai', [AssessController::class, 'index'])->middleware('auth');
// Route::get('/data/personal', [AssessController::class, 'detail'])->middleware('auth');