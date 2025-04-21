<?php

use App\Models\Periksa;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;

// Menampilkan halaman login
Route::get('/login', function () {
    return view('auth.login');
});

// Menampilkan halaman register
Route::get('/register', function () {
    return view('auth.register');
});

// Menampilkan form login menggunakan controller
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Proses login
Route::post('/login', [AuthController::class, 'login']);


// Routes dokter

// Menampilkan halaman daftar obat
Route::get('/dokter/obat', [DokterController::class, 'showObat'])->name('dokter.obat');

// Proses menyimpan data obat baru
Route::post('/dokter/obat', [DokterController::class, 'storeObat'])->name('dokter.obatStore');

// Menampilkan form edit obat
Route::get('/dokter/obat/edit/{id}', [DokterController::class, 'editObat'])->name('dokter.obatEdit');

// Proses update data obat
Route::put('/dokter/obat/update/{id}', [DokterController::class, 'updateObat'])->name('dokter.obatUpdate');

// Proses menghapus data obat
Route::delete('/dokter/obat/delete/{id}', [DokterController::class, 'deleteObat'])->name('dokter.obatDelete');

// Menampilkan halaman dashboard dokter
Route::get('/dokter', function () {
    return view('dokter.dashboard');
})->name('dokter.dashboard');

// Menampilkan daftar data pemeriksaan pasien untuk dokter
Route::get('/dokter/periksa', function () {
    $periksas = Periksa::all();
    return view('dokter.periksa', compact('periksas'));
})->name('dokter.periksa');


// Routes pasien

// Halaman dashboard pasien
Route::get('/pasien', [PasienController::class, 'index'])->name('pasien.dashboard');

// Halaman untuk melakukan pemeriksaan
Route::get('/pasien/periksa', [PasienController::class, 'showPeriksa'])->name('pasien.periksa');

// Proses pengisian form periksa oleh pasien
Route::post('/pasien/periksa', [PasienController::class, 'periksa'])->name('pasien.periksaStore');

// Halaman riwayat pemeriksaan pasien
Route::get('/pasien/riwayat', [PasienController::class, 'riwayat'])->name('pasien.riwayat');
