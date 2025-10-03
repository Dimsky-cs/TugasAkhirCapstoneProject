<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\KonselingController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController; 
use App\Http\Controllers\Admin\KonselingController as AdminKonselingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/layanan', function () {
    return view('layanan'); // Ini akan menampilkan file resources/views/layanan.blade.php
})->name('layanan'); // Ini memberikan NAMA 'layanan' pada route

Route::get('/kontak', function () {
    return view('kontak'); // Ini akan menampilkan file resources/views/layanan.blade.php
})->name('kontak'); // Ini memberikan NAMA 'layanan' pada route

Route::get('/tentang-kami', function () {
    return view('tentang'); // Ini akan menampilkan file resources/views/layanan.blade.php
})->name('tentang'); // Ini memberikan NAMA 'layanan' pada route

Route::get('/redirect-after-login', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('user.dashboard');
})->middleware('auth');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/konseling/create', [KonselingController::class, 'create'])->name('konseling.create');
    Route::post('/user/konseling', [KonselingController::class, 'store'])->name('konseling.store');
});

// User routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    Route::get('/user/konseling/create', [KonselingController::class, 'create'])->name('konseling.create');
    Route::post('/user/konseling', [KonselingController::class, 'store'])->name('konseling.store');
    Route::get('/user/konseling', [KonselingController::class, 'indexUser'])->name('konseling.indexUser');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::get('/admin/konseling', [KonselingController::class, 'indexAdmin'])->name('konseling.indexAdmin');

Route::middleware(['auth'])->group(function () {
    Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Route untuk menampilkan halaman riwayat
    Route::get('/user/konseling', [KonselingController::class, 'index'])->name('user.konseling.index');
    
    // Route untuk menampilkan form pembuatan
    Route::get('/user/konseling/create', [KonselingController::class, 'create'])->name('user.konseling.create');
    
    // Route untuk MENYIMPAN data dari form (INI YANG HILANG)
    Route::post('/user/konseling', [KonselingController::class, 'store'])->name('user.konseling.store');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Route CRUD untuk Manajemen Konseling
    Route::get('/konseling', [AdminKonselingController::class, 'index'])->name('konseling.index');
    Route::get('/konseling/create', [AdminKonselingController::class, 'create'])->name('konseling.create');
    Route::post('/konseling', [AdminKonselingController::class, 'store'])->name('konseling.store');
    Route::get('/konseling/{konseling}/edit', [AdminKonselingController::class, 'edit'])->name('konseling.edit');
    Route::patch('/konseling/{konseling}', [AdminKonselingController::class, 'update'])->name('konseling.update');
    Route::delete('/konseling/{konseling}', [AdminKonselingController::class, 'destroy'])->name('konseling.destroy');

});

