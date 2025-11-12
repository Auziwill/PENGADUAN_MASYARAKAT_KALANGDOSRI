<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

// Halaman utama
Route::get('/', [PengaduanController::class, 'statistik'])->name('home');

// Login & Logout
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Rute untuk Lupa Kata Sandi (Email-Based Reset) - TIDAK DILINDUNGI AUTH
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


// Registrasi user
Route::get('/register', function () {
    return view('register');
})->name('register');
Route::post('/register', [UserController::class, 'store']);

// Halaman pengaduan untuk user (Membutuhkan Login)
Route::middleware(['auth', 'masyarakat'])->group(function () {
    Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan');
    Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
});

// Halaman dashboard admin (Membutuhkan Login)
Route::middleware(['auth', 'admin'])->group(function () {
    // Existing Pengaduan routes
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/pengaduan/{id}', [AdminController::class, 'show'])->name('admin.pengaduan.show');
    Route::post('/admin/pengaduan/{id}/update-status', [AdminController::class, 'updateStatus'])->name('admin.pengaduan.updateStatus');
    Route::delete('/admin/pengaduan/{id}', [AdminController::class, 'destroy'])->name('admin.pengaduan.destroy');

    // New User Management Routes
    Route::prefix('admin/users')->name('admin.users.')->group(function () {
        Route::get('/', [AdminController::class, 'usersIndex'])->name('index');
        Route::get('/create', [AdminController::class, 'usersCreate'])->name('create');
        Route::post('/', [AdminController::class, 'usersStore'])->name('store');
        Route::get('/{id}/edit', [AdminController::class, 'usersEdit'])->name('edit');
        Route::put('/{id}', [AdminController::class, 'usersUpdate'])->name('update');
        Route::delete('/{id}', [AdminController::class, 'usersDestroy'])->name('destroy');
    });

    // New Tanggapan Management Routes
    Route::prefix('admin/tanggapans')->name('admin.tanggapans.')->group(function () {
        Route::get('/', [AdminController::class, 'tanggapansIndex'])->name('index');
        Route::get('/create', [AdminController::class, 'tanggapansCreate'])->name('create');
        Route::post('/', [AdminController::class, 'tanggapansStore'])->name('store');
        Route::get('/{id}/edit', [AdminController::class, 'tanggapansEdit'])->name('edit');
        Route::put('/{id}', [AdminController::class, 'tanggapansUpdate'])->name('update');
        Route::delete('/{id}', [AdminController::class, 'tanggapansDestroy'])->name('destroy');
    });

    // New Password Reset Token Management Routes
    // Note: 'email' is typically the primary key for password_reset_tokens table.
    Route::prefix('admin/password_resets')->name('admin.password_resets.')->group(function () {
        Route::get('/', [AdminController::class, 'passwordResetsIndex'])->name('index');
        Route::delete('/{email}', [AdminController::class, 'passwordResetsDestroy'])->name('destroy');
    });
});

// Halaman untuk Ubah Kata Sandi (Pengguna Sudah Login)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/change-password', [UserController::class, 'showChangePasswordForm'])->name('user.change-password.form');
    Route::post('/profile/change-password', [UserController::class, 'updatePassword'])->name('user.change-password.update');

     // New Export Route for Pengaduan (PDF only)
    Route::get('/admin/pengaduan/export/pdf', [AdminController::class, 'exportPdfPengaduan'])->name('admin.pengaduan.export.pdf');
    Route::get('/export-users', [UserController::class, 'exportExcel'])->name('users.export');
    Route::get('/admin/pengaduan/export/excel', [PengaduanController::class, 'exportExcel'])
    ->name('admin.pengaduan.export.excel');

   Route::get('user/excel', [AdminController::class, 'Excel'])->name('UserExcel');
  

});
