<?php

namespace App\Support;

use App\Models\Sekolah;

class SekolahResolver
{
    /**
     * Cari sekolah berdasarkan nama.
     * Jika belum ditemukan, buat sekolah baru.
     *
     * Metadata yang belum diketahui dibiarkan null.
     */
    public static function resolve(?string $namaSekolah): ?Sekolah
    {
        $namaSekolah = trim((string) $namaSekolah);

        // Abaikan nama kosong atau placeholder.
        if (
            $namaSekolah === '' ||
            in_array(mb_strtolower($namaSekolah), [
                '-',
                'tidak ada',
                'tidak diketahui',
                'n/a',
            ], true)
        ) {
            return null;
        }

        // Rapikan spasi berulang tanpa mengubah nama asli lainnya.
        $namaSekolah = preg_replace('/\s+/u', ' ', $namaSekolah);

        // Gunakan sekolah yang sudah ada jika namanya cocok.
        $sekolah = Sekolah::query()
            ->whereRaw('LOWER(TRIM(nama_sekolah)) = ?', [
                mb_strtolower($namaSekolah),
            ])
            ->first();

        if ($sekolah) {
            return $sekolah;
        }

        // Buat sekolah baru tanpa mengarang metadata.
        return Sekolah::create([
            'nama_sekolah' => $namaSekolah,
            'npsn' => null,
            'jenjang' => null,
            'kabupaten_kota' => null,
            'status_monitoring' => 'Belum Dimonitor',
        ]);
    }
}