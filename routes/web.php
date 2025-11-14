<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\KonselingController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\KonselingController as AdminKonselingController;
use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\PsikologController; // Pastikan ini ada

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- HALAMAN PUBLIK (GUEST) ---
Route::get('/', function () {
    return view('home');
})->name('home');

// --- LOGIKA REDIRECT SETELAH LOGIN (3 ROLE) ---
Route::get('/dashboard', function () {
    $role = Auth::user()->role;

    if ($role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    // --- INI PERBAIKANNYA ---
    if ($role === 'psikolog') {
        return redirect()->route('psikolog.dashboard'); // <-- INI YANG KURANG
    }
    // -------------------------

    // Default untuk 'user'
    return redirect()->route('user.dashboard');

})->middleware(['auth', 'verified'])->name('dashboard');


// --- GRUP UNTUK ADMIN (TETAP AMAN) ---
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Rute manajemen konseling
    Route::get('/konseling', [AdminKonselingController::class, 'index'])->name('konseling.index');
    Route::get('/konseling/create', [AdminKonselingController::class, 'create'])->name('konseling.create');
    Route::post('/konseling', [AdminKonselingController::class, 'store'])->name('konseling.store');
    Route::get('/konseling/{konseling}/edit', [AdminKonselingController::class, 'edit'])->name('konseling.edit');
    Route::patch('/konseling/{konseling}', [AdminKonselingController::class, 'update'])->name('konseling.update');
    Route::delete('/konseling/{konseling}', [AdminKonselingController::class, 'destroy'])->name('konseling.destroy');
});

// --- GRUP UNTUK USER (KLIEN) ---
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

    // Rute booking & riwayat
    Route::get('/konseling', [KonselingController::class, 'index'])->name('konseling.index');
    Route::get('/konseling/create', [KonselingController::class, 'create'])->name('konseling.create');
    Route::post('/konseling', [KonselingController::class, 'store'])->name('konseling.store');
});

// --- [BARU] GRUP UNTUK PSIKOLOG ---
Route::middleware(['auth', 'role:psikolog'])->prefix('psikolog')->name('psikolog.')->group(function () {
    Route::get('/dashboard', [PsikologController::class, 'index'])->name('dashboard');
    Route::get('/sesi/{konseling}/edit', [PsikologController::class, 'edit'])->name('sesi.edit');
    Route::patch('/sesi/{konseling}', [PsikologController::class, 'update'])->name('sesi.update');
});


// --- RUTE PROFIL (UMUM) ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- RUTE AUTENTIKASI (LOGIN, GOOGLE, DLL) ---
Route::get('/auth/{provider}/redirect', [SocialLoginController::class, 'redirectToProvider'])->name('social.redirect');
Route::get('/auth/{provider}/callback', [SocialLoginController::class, 'handleProviderCallback']);

// API UNTUK FORM BOOKING (Sudah Benar)
Route::prefix('api')->group(function () {
    Route::get('/psikologs-by-service', [\App\Http\Controllers\Api\BookingController::class, 'getPsikologsByService']);
    Route::get('/available-times', [\App\Http\Controllers\Api\BookingController::class, 'getAvailableTimes']);
});

require __DIR__.'/auth.php';
