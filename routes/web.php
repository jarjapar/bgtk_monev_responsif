<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\InstrumenController;
use App\Http\Controllers\WawancaraController;
use App\Http\Controllers\TindakLanjutController;
use App\Http\Controllers\BKController;
use App\Http\Controllers\BcksPengisianController;
use App\Http\Controllers\TendikController;
use App\Http\Controllers\ManajemenAkunController;


// ============================================================
// AUTHENTICATION
// ============================================================

Route::get('/login', [
    LoginController::class,
    'showLoginForm'
])->name('login');

Route::post('/login', [
    LoginController::class,
    'login'
])->name('login.process');

Route::post('/logout', [
    LoginController::class,
    'logout'
])->name('logout');


// ============================================================
// AREA YANG MEMERLUKAN LOGIN
// ============================================================

Route::middleware('auth')->group(function () {

    // ========================================================
    // DASHBOARD
    // ========================================================

    Route::get('/', [
        DashboardController::class,
        'index'
    ]);

    Route::get('/dashboard', [
        DashboardController::class,
        'index'
    ])->name('dashboard');


    // ========================================================
    // INSTRUMEN PEMANTAUAN
    // ========================================================

    Route::resource('instrumen', InstrumenController::class)
        ->parameters([
            'instrumen' => 'instrumen',
        ]);


    // ========================================================
    // BCKS
    // ========================================================

    Route::resource('bcks', BcksPengisianController::class)
        ->parameters([
            'bcks' => 'bcksPengisian',
        ]);

    Route::get(
        'bcks/{bcksPengisian}/cetak',
        [BcksPengisianController::class, 'cetak']
    )->name('bcks.cetak');


    // ========================================================
    // INSTRUMEN PEMANTAUAN TENAGA KEPENDIDIKAN
    // ========================================================

    Route::resource('tendik', TendikController::class);

    Route::get('tendik/{tendik}/cetak', [
        TendikController::class,
        'cetak'
    ])->name('tendik.cetak');

    // ========================================================
    // INSTRUMEN BK
    // ========================================================

    Route::get('/bk', [
        BKController::class,
        'index'
    ])->name('bk.index');

    Route::get('/bk/create', [
        BKController::class,
        'create'
    ])->name('bk.create');

    Route::post('/bk', [
        BKController::class,
        'store'
    ])->name('bk.store');

    Route::get('/bk/{submission}', [
        BKController::class,
        'show'
    ])->name('bk.show');

    Route::get('/bk/{submission}/edit', [
        BKController::class,
        'edit'
    ])->name('bk.edit');

    Route::get('/bk/{submission}/cetak', [
        BKController::class,
        'cetak'
    ])->name('bk.cetak');

    Route::put('/bk/{submission}', [
        BKController::class,
        'update'
    ])->name('bk.update');

    Route::delete('/bk/{submission}', [
        BKController::class,
        'destroy'
    ])->name('bk.destroy');


    // ========================================================
    // DATA SEKOLAH
    // ========================================================

    Route::resource('sekolah', SekolahController::class);


    // ========================================================
    // LEMBAR WAWANCARA
    // ========================================================

    // Form wawancara BCKS.
    Route::get('/wawancara/bcks', [
        WawancaraController::class,
        'createBcks'
    ])->name('wawancara.bcks.create');


    // Form dan penyimpanan wawancara BK.
    Route::get('/wawancara/bk', [
        WawancaraController::class,
        'createBk'
    ])->name('wawancara.bk.create');

    Route::post('/wawancara/bk', [
        WawancaraController::class,
        'storeBk'
    ])->name('wawancara.bk.store');


    // Form dan penyimpanan wawancara TENDIK.
    Route::get('/wawancara/tendik', [
        WawancaraController::class,
        'createTendik'
    ])->name('wawancara.tendik.create');

    Route::post('/wawancara/tendik', [
        WawancaraController::class,
        'storeTendik'
    ])->name('wawancara.tendik.store');

    Route::get('/wawancara/{wawancara}/cetak-bcks', [
        \App\Http\Controllers\WawancaraController::class,
        'cetakBcks',
    ])->name('wawancara.cetak-bcks');

    Route::get('/wawancara/{wawancara}/cetak', [
        WawancaraController::class,
        'cetak',
    ])->name('wawancara.cetak');

    // Riwayat, detail, edit, dan hapus wawancara.
    // Letakkan setelah route khusus BCKS, BK, dan TENDIK.
    Route::resource('wawancara', WawancaraController::class)
        ->parameters([
            'wawancara' => 'wawancara',
        ]);


    // ========================================================
    // RENCANA TINDAK LANJUT
    // ========================================================

    Route::resource(
        'tindak-lanjut',
        TindakLanjutController::class
    )->parameters([
                'tindak-lanjut' => 'tindakLanjut',
            ]);


    // ========================================================
    // PANDUAN PENGISIAN
    // ========================================================

    Route::get('/panduan', function () {
        return view('panduan.index');
    });


    // ========================================================
    // PROFIL SAYA
    // ========================================================

    Route::get('/profil', function () {
        return view('profil.index');
    });
    Route::middleware('admin')->group(function () {
        Route::resource('manajemen-akun', ManajemenAkunController::class)
            ->parameters(['manajemen-akun' => 'manajemen_akun']);
    });

});