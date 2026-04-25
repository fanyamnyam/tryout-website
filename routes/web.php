<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| 1. Public Routes (Halaman Tanpa Login)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('pilih-role');
})->name('landing');

Route::get('/pilih-role', function () {
    return view('pilih-role');
})->name('pilih-role');

Route::get('/login/{role}', function ($role) {
    return view('auth.login', ['role' => $role]);
})->name('login.role');


/*
|--------------------------------------------------------------------------
| 2. Protected Routes (Harus Login & Cek Role)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    
    // Rute Profil (Bisa diakses semua role yang login)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /* --- GROUP ADMIN (Hanya Role: admin) --- */
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard', [
                'siswaCount'   => \App\Models\User::where('role', 'siswa')->count(),
                'guruCount'    => \App\Models\User::where('role', 'guru')->count(),
                'adminCount'   => \App\Models\User::where('role', 'admin')->count(),
                'ortuCount'    => \App\Models\User::where('role', 'orang_tua')->count(),
            ]);
        })->name('dashboard');

        Route::resource('users', UserController::class);
    });

    /* --- GROUP SISWA --- */
    Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/dashboard', function () {
            // Pastikan kamu punya file: resources/views/siswa/dashboard.blade.php
            return view('siswa.dashboard'); 
        })->name('dashboard');
    });

    /* --- GROUP GURU --- */
    Route::middleware(['auth', 'role:guru'])->prefix('guru')->name('guru.')->group(function () {
        Route::get('/dashboard', function () {
            // Pastikan kamu punya file: resources/views/guru/dashboard.blade.php
            return view('guru.dashboard');
        })->name('dashboard');
    });

    /* --- GROUP ORANG TUA --- */
    Route::middleware(['auth', 'role:orang_tua,ortu'])->prefix('ortu')->name('ortu.')->group(function () {
        Route::get('/dashboard', function () {
            // Pastikan kamu punya file: resources/views/ortu/dashboard.blade.php
            return view('ortu.dashboard');
        })->name('dashboard');
    });
});

/*
|--------------------------------------------------------------------------
| 3. Breeze Auth Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';