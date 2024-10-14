<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SchoolController;

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

Route::get("/laravel", function () {
    return view("welcome");
});

Route::get("/maintenance", function () {
    return view("error.maintenance", ["title" => "Semangkamedia"]);
});

// Authentication Routes
Route::get("/login", [AuthController::class, "index"])
    ->name("login")
    ->middleware("guest");
Route::post("/login", [AuthController::class, "login"]);
Route::get("/logout", [AuthController::class, "logout"]);

// Authenticated Routes
Route::middleware("auth")->group(function () {
    Route::get("/", [AuthController::class, "home2"]);
    Route::get("/home", [AuthController::class, "home1"]);

    // User Management
    Route::resource("/pengguna", UserController::class);

    // Admin Panel
    Route::prefix("admin")->group(function () {
        Route::resource("akun", AccountController::class);
        Route::resource("keuangan", FinanceController::class);
        Route::resource("tabungan", SavingController::class);
        Route::resource("siswa", StudentController::class);
        Route::resource("guru", TeacherController::class);
        Route::resource("kalendar", CalendarController::class);
        Route::resource("potongan", DiscountController::class);

        // Special Routes
        Route::get("siswa/asesmen/{amy}", [
            StudentController::class,
            "dataAsesmen",
        ]);
        Route::post("siswa/image/{id}", [
            StudentController::class,
            "image_upload",
        ]);
        Route::post("guru/image/{id}", [
            TeacherController::class,
            "image_upload",
        ]);
        Route::get("alumni", [StudentController::class, "alumni"]);
        Route::get("akun/no/{num}", [AccountController::class, "search"]);
        Route::get("keuangan/inv/{inv}", [FinanceController::class, "detail"]);
        Route::get("keuangan/view/{inv}", [
            FinanceController::class,
            "preview",
        ]);
        Route::get("tabungan/view/{ids}", [SavingController::class, "preview"]);
        Route::get("tabungan/rekap/all", [SavingController::class, "rekap"]);

        // Billing and Payment
        Route::get("tagihan", [BillingController::class, "index"]);
        Route::post("tagihan", [BillingController::class, "save"]);
        Route::get("tagihan/0", [BillingController::class, "preview"]);
        Route::get("tagihan/{id}", [BillingController::class, "show"]);
        Route::get("tagihan/sisa/{id}/{ids}/{name}", [
            BillingController::class,
            "show_balance",
        ]);
        Route::get("tagihan/{year}/{category}", [
            BillingController::class,
            "preview",
        ]);
        Route::delete("tagihan/{year}/{category}", [
            BillingController::class,
            "delete_all",
        ]);
        Route::get("tagihan/search/ids/{ids}", [
            BillingController::class,
            "billing_search",
        ]);

        Route::get("pembayaran", [PaymentController::class, "index"]);
        Route::post("pembayaran", [PaymentController::class, "store"]);
        Route::delete("pembayaran/{id}", [PaymentController::class, "destroy"]);
        Route::get("pembayaran/inv/{inv}", [
            PaymentController::class,
            "detail",
        ]);
        Route::get("pembayaran/view/{inv}", [
            PaymentController::class,
            "preview",
        ]);
        Route::get("pembayaran/rekap", [
            PaymentController::class,
            "rekapitulasi",
        ]);
        Route::get("pembayaran/rekap/{ids}/{year}", [
            PaymentController::class,
            "rekap",
        ]);
        Route::get("konfirmasi", [PaymentController::class, "confirm"]);

        // School Management
        Route::get("sekolah", [SchoolController::class, "index"]);
        Route::post("sekolah", [SchoolController::class, "save"]);
    });

    // Data Management
    Route::resource("/data/kursus", CourseController::class);
    Route::get("/data/kursus/{id}/editItem", [
        CourseController::class,
        "editItem",
    ]);
    Route::resource("/data/pelajaran", SubjectController::class);
    Route::resource("/data/kompetensi", CompetenceController::class);
    Route::resource("/data/project", ProjectController::class);
    Route::resource("/data/task", TaskController::class);
    Route::post("/data/task/acc/{id}", [TaskController::class, "acc"]);
    Route::get("/data/nilai", [ScoreController::class, "index"]);
    Route::get("/data/nilai/create", [ScoreController::class, "create"]);
    Route::get("/data/nilai/{num}/edit", [ScoreController::class, "edit"]);
    Route::post("/data/nilai", [ScoreController::class, "store"]);
    Route::get("/data/destroy/nilai/{id}", [ScoreController::class, "destroy"]);
    Route::get("/data/rapor", [ScoreController::class, "rapor"]);
    Route::get("/data/rapor/{num}/{ids}", [
        ScoreController::class,
        "rapor_view",
    ]);
    Route::resource("/data/award", AwardController::class);
    Route::get("/data/kompetensi/semester/{id}", [
        CompetenceController::class,
        "findBySemester",
    ]);

    // Profile and Password Change
    Route::get("/profile", [ProfileController::class, "index"]);
    Route::post("/image", [ProfileController::class, "image_upload"]);
    Route::post("/password", [ProfileController::class, "password_change"]);

    // Lockscreen
    Route::get("/lockscreen", [AuthController::class, "lockscreen"])->name(
        "lockscreen"
    );
    Route::post("/lockscreen", [AuthController::class, "unlockscreen"]);
});
