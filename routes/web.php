<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardPegawaiController;
use App\Http\Controllers\DashboardKasubagController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\KasubagAttendence;
use App\Http\Controllers\AttendenceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'check.role:superadmin'])->prefix('superadmin')->group(function () {
    Route::get('/', [DashboardAdminController::class, 'viewAdmin'])->name('superadmin.dashboard');
    Route::get('/Profiles', [DashboardAdminController::class, 'Profiles'])->name('superadmin.profiles');
    Route::prefix('/')->group(function () {
        Route::get('/users', [UserController::class, 'index']);
        Route::get('/users/create', [UserController::class, 'create']);
        Route::post('/users/store', [UserController::class, 'store']);
        Route::get('/users/edit/{id}', [UserController::class, 'edit']);
        Route::put('/users/{id}/update', [UserController::class, 'update']);
        Route::delete('/users/delete/{id}', [UserController::class, 'destroy']);
        Route::get('/users/data', [UserController::class, 'getUsersData'])->name('users.data');
    });
    Route::prefix('/')->group(function () {
        Route::get('/Files', [FileController::class, 'index']);
        Route::post('/Files/store', [FileController::class, 'store']);
        Route::get('/Files/json', [FileController::class, 'json'])->name('files.json');
        Route::delete('/Files/private/files/delete/{id}', [FileController::class, 'deleteFile'])->name('files.delete');
        Route::get('/Files/edit/{id}', [FileController::class, 'edit']);
        Route::put('/Files/update/{id}', [FileController::class, 'update']);
        Route::get('/Files/private/files/{id}', [FileController::class, 'serveFile'])->name('files.serve');
    });
});
Route::middleware(['auth', 'check.role:pegawai'])->prefix('pegawai')->group(function () {
    // Route::get('/', [DashboardPegawaiController::class, 'ViewPegawai'])->name('pegawai.dashboard');
    Route::get('/', [FileController::class, 'indexPegawai'])->name('pegawai.dashboard');
    Route::get('/Profiles', [DashboardPegawaiController::class, 'Profiles'])->name('pegawai.profiles');
    Route::prefix('/')->group(function () {
        Route::get('/absensi', [AttendenceController::class, 'index']);
        Route::post('/absensi/store', [AttendenceController::class, 'store']);
    });
    Route::prefix('/')->group(function () {
        Route::get('/rekap', [AttendenceController::class, 'recapAttendence']);
        Route::get('/rekap/data', [AttendenceController::class, 'getRecapAttendence'])->name('get.recap.attendance');
        Route::delete('/rekap/delete/{id}', [AttendenceController::class, 'destroy']);
    });
    Route::prefix('/')->group(function () {
        Route::get('/Files/private/files/{id}', [FileController::class, 'serveFile'])->name('files.serve');
    });
});

Route::middleware(['auth', 'check.role:kasubag'])->prefix('kasubag')->group(function () {
    // Route::get('/', [DashboardKasubagController::class, 'ViewKasubag'])->name('kasubag.dashboard');
    Route::get('/', [FileController::class, 'indexKasubag'])->name('kasubag.dashboard');
    Route::get('/Profiles', [DashboardKasubagController::class, 'Profiles'])->name('kasubag.profiles');
    Route::prefix('/')->group(function () {
        Route::get('/Rekap_absensi', [KasubagAttendence::class, 'index']);
        Route::get('/Rekap_absensi/data/{userId}', [KasubagAttendence::class, 'json'])->name('get.recap.attendance.kasubag');
        Route::get('/accept/{id}', [KasubagAttendence::class, 'acceptAttendance'])->name('attendances.accept');
        Route::get('/reject/{id}', [KasubagAttendence::class, 'rejectAttendance'])->name('attendances.reject');
    });
    Route::prefix('/')->group(function () {
        Route::get('/Files/private/files/{id}', [FileController::class, 'serveFile'])->name('files.serve');
    });
});
