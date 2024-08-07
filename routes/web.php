<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\AssessController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\CompetenceController;

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
Route::resource('/admin/guru', TeacherController::class)->middleware('auth');
Route::resource('/admin/kalendar', CalendarController::class)->middleware('auth');
Route::resource('/admin/potongan', DiscountController::class)->middleware('auth');

Route::get('/admin/siswa/asesmen/{amy}', [StudentController::class, 'dataAsesmen'])->middleware('auth');

Route::resource('/data/pelajaran', SubjectController::class)->middleware('auth');
Route::resource('/data/kompetensi', CompetenceController::class)->middleware('auth');
Route::resource('/data/project', ProjectController::class)->middleware('auth');
Route::resource('/data/task', TaskController::class)->middleware('auth');
Route::post('/data/task/acc/{id}', [TaskController::class, 'acc'])->middleware('auth');

Route::get('/data/nilai', [ScoreController::class, 'index'])->middleware('auth');
Route::get('/data/nilai/create', [ScoreController::class, 'create'])->middleware('auth');
Route::get('/data/nilai/{num}/edit', [ScoreController::class, 'edit'])->middleware('auth');
Route::post('/data/nilai', [ScoreController::class, 'store'])->middleware('auth');
Route::get('/data/destroy/nilai/{id}', [ScoreController::class, 'destroy'])->middleware('auth');
Route::get('/data/rapor', [ScoreController::class, 'rapor'])->middleware('auth');
Route::get('/data/rapor/{num}/{ids}', [ScoreController::class, 'rapor_view'])->middleware('auth');

Route::resource('/data/award', AwardController::class)->middleware('auth');

Route::get('/data/kompetensi/semester/{id}', [CompetenceController::class, 'findBySemester'])->middleware('auth');

Route::post('/admin/siswa/image/{id}', [StudentController::class, 'image_upload'])->middleware('auth');
Route::post('/admin/guru/image/{id}', [TeacherController::class, 'image_upload'])->middleware('auth');
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
Route::get('/admin/tagihan/sisa/{id}/{ids}/{name}', [BillingController::class, 'show_balance'])->middleware('auth');
Route::get('/admin/tagihan/{year}/{category}', [BillingController::class, 'preview'])->middleware('auth');
Route::delete('/admin/tagihan/{year}/{category}', [BillingController::class, 'delete_all'])->middleware('auth');
Route::get('/admin/tagihan/search/ids/{ids}', [BillingController::class, 'billing_search'])->middleware('auth');

Route::get('/admin/pembayaran', [PaymentController::class, 'index'])->middleware('auth');
Route::post('/admin/pembayaran', [PaymentController::class, 'store'])->middleware('auth');
Route::delete('/admin/pembayaran/{id}', [PaymentController::class, 'destroy'])->middleware('auth');
Route::get('/admin/pembayaran/inv/{inv}', [PaymentController::class, 'detail'])->middleware('auth');
Route::get('/admin/pembayaran/view/{inv}', [PaymentController::class, 'preview'])->middleware('auth');
Route::get('/admin/pembayaran/rekap', [PaymentController::class, 'rekapitulasi'])->middleware('auth');
Route::get('/admin/pembayaran/rekap/{ids}/{year}', [PaymentController::class, 'rekap'])->middleware('auth');

Route::get('/', [AuthController::class, 'home2'])->middleware('auth');
Route::get('/home', [AuthController::class, 'home1'])->middleware('auth');
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

Route::get('/admin/konfirmasi', [PaymentController::class, 'confirm'])->middleware('auth');
