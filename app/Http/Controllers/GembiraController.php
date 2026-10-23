<?php

namespace App\Http\Controllers;

use App\Models\GembiraPengisian;
use Illuminate\Http\Request;

class GembiraController extends Controller
{
    /**
     * Daftar pengisian instrumen Matematika GEMBIRA.
     */
    public function index()
    {
        $pengisian = GembiraPengisian::latest()->paginate(10);

        return view('gembira.index', compact('pengisian'));
    }

    /**
     * Form pengisian baru.
     */
    public function create()
    {
        return view('gembira.create');
    }

    /**
     * Simpan biodata dan jawaban instrumen baru.
     */

    public function store(Request $request)
    {
        $validated = $this->validasiPengisian($request);

        $jawabanLevel = $this->ambilJawabanLevel($request);

        $namaSekolah = preg_replace(
            '/\s+/',
            ' ',
            trim($validated['nama_sekolah'])
        );

        $sekolah = \App\Models\Sekolah::query()
            ->whereRaw('LOWER(TRIM(nama_sekolah)) = ?', [
                mb_strtolower($namaSekolah),
            ])
            ->first();

        if (!$sekolah) {
            $sekolah = \App\Models\Sekolah::create([
                'nama_sekolah' => $namaSekolah,
                'status_monitoring' => 'Belum Dimonitor',
                'tahun_monitoring' => now()->year,
            ]);
        }

        $validated['nama_sekolah'] = $namaSekolah;
        $validated['sekolah_id'] = $sekolah->id;

        $pengisian = GembiraPengisian::create(array_merge(
            $validated,
            $jawabanLevel,
            ['status' => 'Selesai']
        ));

        return redirect()
            ->route('gembira.show', $pengisian)
            ->with('success', 'Pengisian Matematika GEMBIRA berhasil disimpan dan dihubungkan ke Data Sekolah.');
    }


    /**
     * Tampilkan detail pengisian.
     */
    public function show(GembiraPengisian $gembira)
    {
        return view('gembira.show', compact('gembira'));
    }

    /**
     * Tampilkan form edit pengisian.
     */
    public function edit(GembiraPengisian $gembira)
    {
        return view('gembira.edit', compact('gembira'));
    }

    /**
     * Perbarui biodata dan jawaban instrumen.
     */

    public function update(Request $request, GembiraPengisian $gembira)
    {
        $validated = $this->validasiPengisian($request);

        $jawabanLevel = $this->ambilJawabanLevel($request);

        $namaSekolah = preg_replace(
            '/\s+/',
            ' ',
            trim($validated['nama_sekolah'])
        );

        $sekolah = \App\Models\Sekolah::query()
            ->whereRaw('LOWER(TRIM(nama_sekolah)) = ?', [
                mb_strtolower($namaSekolah),
            ])
            ->first();

        if (!$sekolah) {
            $sekolah = \App\Models\Sekolah::create([
                'nama_sekolah' => $namaSekolah,
                'status_monitoring' => 'Belum Dimonitor',
                'tahun_monitoring' => now()->year,
            ]);
        }

        $validated['nama_sekolah'] = $namaSekolah;
        $validated['sekolah_id'] = $sekolah->id;

        $gembira->update(array_merge(
            $validated,
            $jawabanLevel
        ));

        return redirect()
            ->route('gembira.show', $gembira)
            ->with('success', 'Pengisian Matematika GEMBIRA berhasil diperbarui dan dihubungkan ke Data Sekolah.');
    }


    /**
     * Validasi biodata, metadata observasi, dan struktur jawaban.
     */
    private function validasiPengisian(Request $request): array
    {
        return $request->validate([
            'nama_guru' => 'required|string|max:255',
            'nama_sekolah' => 'required|string|max:255',
            'kelas_fase' => 'nullable|string|max:100',
            'topik_materi' => 'nullable|string|max:255',
            'nama_petugas_monev' => 'required|string|max:255',

            'jabatan_penilai' => [
                'required',
                'in:Peserta Matematika GEMBIRA,Rekan sejawat,Atasan langsung/Kepala Sekolah',
            ],

            'tanggal_monev' => 'required|date',
            'sumber_data_bukti' => 'nullable|string',

            'tanggal_observasi' => 'nullable|date',
            'durasi_pembelajaran' => 'nullable|string|max:255',
            'jumlah_murid_hadir' => 'nullable|integer|min:0',
            'observasi_ke' => 'nullable|integer|min:1',

            'level_1_jawaban' => 'nullable|array',
            'level_2_jawaban' => 'nullable|array',
            'level_3_jawaban' => 'nullable|array',
            'level_4_jawaban' => 'nullable|array',
        ]);
    }
    public function cetak(GembiraPengisian $gembira)
    {
        return view('gembira.cetak', compact('gembira'));
    }

    /**
     * Ambil jawaban level yang sesuai dengan jabatan penilai.
     */
    private function ambilJawabanLevel(Request $request): array
    {
        $jabatan = $request->input('jabatan_penilai');

        $levelAktif = $jabatan === 'Peserta Matematika GEMBIRA'
            ? [1, 2, 3, 4]
            : [3, 4];

        $hasil = [];

        foreach ([1, 2, 3, 4] as $level) {
            $kolom = "level_{$level}_jawaban";

            // Level yang tidak aktif tidak diubah saat pengisian diedit.
            if (!in_array($level, $levelAktif, true)) {
                continue;
            }

            $jawaban = $request->input($kolom, []);

            if (!is_array($jawaban)) {
                $jawaban = [];
            }

            foreach ($jawaban as $nomor => $item) {
                if (!is_array($item)) {
                    unset($jawaban[$nomor]);
                    continue;
                }

                $skor = $item['skor'] ?? null;

                // Skor yang diizinkan: 1, 2, 3, 4, atau TD khusus Level 3.
                if ($skor !== null && $skor !== '') {
                    $skorValid = ['1', '2', '3', '4'];

                    if ($level === 3) {
                        $skorValid[] = 'TD';
                    }

                    if (!in_array((string) $skor, $skorValid, true)) {
                        $jawaban[$nomor]['skor'] = null;
                    }
                }

                // Alasan TD hanya berlaku untuk Level 3.
                if ($level !== 3) {
                    unset($jawaban[$nomor]['alasan_td']);
                }
            }

            $hasil[$kolom] = $jawaban;
        }

        return $hasil;
    }

    /**
     * Hapus pengisian.
     */
    public function destroy(GembiraPengisian $gembira)
    {
        $gembira->delete();

        return redirect()
            ->route('instrumen.index')
            ->with('success', 'Pengisian Matematika GEMBIRA berhasil dihapus.');
    }
}
