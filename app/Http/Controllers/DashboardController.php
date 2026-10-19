<?php

namespace App\Http\Controllers;

use App\Models\Instrumen;
use App\Models\Sekolah;
use App\Models\TindakLanjut;
use App\Models\Wawancara;

class DashboardController extends Controller
{
    public function index()
    {
        // =========================
        // DATA SEKOLAH
        // =========================

        $totalSekolah = Sekolah::count();

        $sekolahSudahDimonitor = Sekolah::where(
            'status_monitoring',
            'Sudah Dimonitor'
        )->count();

        $sekolahBelumDimonitor = Sekolah::where(
            'status_monitoring',
            'Belum Dimonitor'
        )->count();


        // =========================
        // DATA INSTRUMEN
        // =========================

        $totalInstrumen = Instrumen::count();

        $instrumenAktif = Instrumen::where(
            'status',
            'Aktif'
        )->count();


        // =========================
        // DATA WAWANCARA
        // =========================

        $totalWawancara = Wawancara::count();

        $wawancaraSelesai = Wawancara::where(
            'status',
            'Selesai'
        )->count();

        $wawancaraBelum = Wawancara::where(
            'status',
            'Belum Dilaksanakan'
        )->count();


        // =========================
        // DATA TINDAK LANJUT
        // =========================

        $totalTindakLanjut = TindakLanjut::count();

        $tindakLanjutSelesai = TindakLanjut::where(
            'status',
            'Selesai'
        )->count();

        $tindakLanjutDalamProses = TindakLanjut::where(
            'status',
            'Dalam Proses'
        )->count();

        $tindakLanjutBelum = TindakLanjut::where(
            'status',
            'Belum Dimulai'
        )->count();


        // =========================
        // RATA-RATA CAPAIAN
        // =========================

        $rataCapaian = (float) (
            Instrumen::avg('capaian') ?? 0
        );


        // =========================
        // DATA TERBARU
        // =========================

        $instrumenTerbaru = Instrumen::latest()
            ->take(5)
            ->get();

        $tindakLanjutTerbaru = TindakLanjut::with(
            'sekolah'
        )
            ->latest()
            ->take(5)
            ->get();


        // =========================
        // KIRIM DATA KE DASHBOARD
        // =========================

        return view('dashboard.index', compact(
            'totalSekolah',
            'sekolahSudahDimonitor',
            'sekolahBelumDimonitor',

            'totalInstrumen',
            'instrumenAktif',

            'totalWawancara',
            'wawancaraSelesai',
            'wawancaraBelum',

            'totalTindakLanjut',
            'tindakLanjutSelesai',
            'tindakLanjutDalamProses',
            'tindakLanjutBelum',

            'rataCapaian',

            'instrumenTerbaru',
            'tindakLanjutTerbaru'
        ));
    }
}