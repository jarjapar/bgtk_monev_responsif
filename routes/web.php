<?php

use Illuminate\Support\Facades\Route;

// ============================================================
// CONTROLLERS
// ============================================================

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
use App\Http\Controllers\GembiraController;
use App\Http\Controllers\PkgsdMbiController;


// ============================================================
// AUTENTIKASI
// ============================================================

Route::get('/login', [
    LoginController::class,
    'showLoginForm',
])->name('login');

Route::post('/login', [
    LoginController::class,
    'login',
])->name('login.process');

Route::post('/logout', [
    LoginController::class,
    'logout',
])->name('logout');


// ============================================================
// AREA APLIKASI - WAJIB LOGIN
// ============================================================

Route::middleware('auth')->group(function () {

    // ========================================================
    // DASHBOARD
    // ========================================================

    Route::get('/', [
        DashboardController::class,
        'index',
    ]);

    Route::get('/dashboard', [
        DashboardController::class,
        'index',
    ])->name('dashboard');


    // ========================================================
    // RIWAYAT INSTRUMEN PEMANTAUAN
    // ========================================================

    Route::resource('instrumen', InstrumenController::class)
        ->parameters([
            'instrumen' => 'instrumen',
        ]);


    // ========================================================
    // INSTRUMEN BCKS
    // ========================================================

    Route::resource('bcks', BcksPengisianController::class)
        ->parameters([
            'bcks' => 'bcksPengisian',
        ]);

    Route::get(
        '/bcks/{bcksPengisian}/cetak',
        [BcksPengisianController::class, 'cetak']
    )->name('bcks.cetak');


    // ========================================================
    // INSTRUMEN BIMBINGAN DAN KONSELING (BK)
    // ========================================================

    Route::get('/bk', [
        BKController::class,
        'index',
    ])->name('bk.index');

    Route::get('/bk/create', [
        BKController::class,
        'create',
    ])->name('bk.create');

    Route::post('/bk', [
        BKController::class,
        'store',
    ])->name('bk.store');

    Route::get('/bk/{submission}', [
        BKController::class,
        'show',
    ])->name('bk.show');

    Route::get('/bk/{submission}/edit', [
        BKController::class,
        'edit',
    ])->name('bk.edit');

    Route::get('/bk/{submission}/cetak', [
        BKController::class,
        'cetak',
    ])->name('bk.cetak');

    Route::put('/bk/{submission}', [
        BKController::class,
        'update',
    ])->name('bk.update');

    Route::delete('/bk/{submission}', [
        BKController::class,
        'destroy',
    ])->name('bk.destroy');


    // ========================================================
    // INSTRUMEN TENAGA KEPENDIDIKAN (TENDIK)
    // ========================================================

    Route::resource('tendik', TendikController::class);

    Route::get('/tendik/{tendik}/cetak', [
        TendikController::class,
        'cetak',
    ])->name('tendik.cetak');


    // ========================================================
    // INSTRUMEN MATEMATIKA GEMBIRA
    // ========================================================

    Route::resource('gembira', GembiraController::class);

    Route::get('/gembira/{gembira}/cetak', [
        GembiraController::class,
        'cetak',
    ])->name('gembira.cetak');


    // ========================================================
    // INSTRUMEN PKGSD MBI
    // ========================================================

    Route::resource('pkgsd-mbi', PkgsdMbiController::class)
        ->parameters([
            'pkgsd-mbi' => 'pkgsdMbi',
        ]);

    // Cetak hasil PKGSD MBI
    Route::get('/pkgsd-mbi/{pkgsdMbi}/cetak', [PkgsdMbiController::class, 'cetak'])
        ->name('pkgsd-mbi.cetak');

    // Pengelolaan instrumen PKGSD MBI

    // ========================================================
    // DATA SEKOLAH
    // ========================================================

    Route::resource('sekolah', SekolahController::class);


    // ========================================================
    // LEMBAR WAWANCARA
    // ========================================================

    // --------------------------------------------------------
    // Wawancara BCKS
    // --------------------------------------------------------

    Route::get('/wawancara/bcks', [
        WawancaraController::class,
        'createBcks',
    ])->name('wawancara.bcks.create');

    Route::get('/wawancara/{wawancara}/cetak-bcks', [
        WawancaraController::class,
        'cetakBcks',
    ])->name('wawancara.cetak-bcks');


    // --------------------------------------------------------
    // Wawancara BK
    // --------------------------------------------------------

    Route::get('/wawancara/bk', [
        WawancaraController::class,
        'createBk',
    ])->name('wawancara.bk.create');

    Route::post('/wawancara/bk', [
        WawancaraController::class,
        'storeBk',
    ])->name('wawancara.bk.store');


    // --------------------------------------------------------
    // Wawancara TENDIK
    // --------------------------------------------------------

    Route::get('/wawancara/tendik', [
        WawancaraController::class,
        'createTendik',
    ])->name('wawancara.tendik.create');

    Route::post('/wawancara/tendik', [
        WawancaraController::class,
        'storeTendik',
    ])->name('wawancara.tendik.store');


    // --------------------------------------------------------
    // Wawancara Matematika GEMBIRA
    // --------------------------------------------------------

    Route::get('/wawancara/gembira', [
        WawancaraController::class,
        'createGembira',
    ])->name('wawancara.gembira.create');

    Route::post('/wawancara/gembira', [
        WawancaraController::class,
        'storeGembira',
    ])->name('wawancara.gembira.store');


    // --------------------------------------------------------
    // Cetak dan pengelolaan wawancara umum
    // --------------------------------------------------------

    Route::get('/wawancara/{wawancara}/cetak', [
        WawancaraController::class,
        'cetak',
    ])->name('wawancara.cetak');

    // Riwayat, detail, tambah, edit, dan hapus wawancara.
    // Route khusus wawancara diletakkan sebelum resource ini.
    Route::resource('wawancara', WawancaraController::class)
        ->parameters([
            'wawancara' => 'wawancara',
        ]);


    // ========================================================
    // RENCANA TINDAK LANJUT
    // ========================================================

    Route::resource('tindak-lanjut', TindakLanjutController::class)
        ->parameters([
            'tindak-lanjut' => 'tindakLanjut',
        ]);


    // ========================================================
    // PANDUAN PENGISIAN
    // ========================================================

    Route::get('/panduan', function () {
        return view('panduan.index');
    });


    // ========================================================
    // PROFIL PENGGUNA
    // ========================================================

    Route::get('/profil', function () {
        return view('profil.index');
    });


    // ========================================================
    // ADMINISTRASI AKUN - KHUSUS ADMIN
    // ========================================================

    Route::middleware('admin')->group(function () {

        Route::resource('manajemen-akun', ManajemenAkunController::class)
            ->parameters([
                'manajemen-akun' => 'manajemen_akun',
            ]);

    });

});
