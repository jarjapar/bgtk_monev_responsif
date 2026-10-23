<?php

namespace App\Http\Controllers;

use App\Models\BcksPengisian;
use App\Support\SekolahResolver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class BcksPengisianController extends Controller
{
    private const STATUS_BCKS = 'BCKS';

    private const STATUS_RESPONDEN = [
        'BCKS',
        'Atasan Langsung / Pengawas Sekolah',
        'Perwakilan Guru / Tenaga Kependidikan',
    ];

    public function index()
    {
        $pengisians = BcksPengisian::with('jawaban')
            ->latest('tanggal_evaluasi')
            ->latest('id')
            ->get();

        return view('bcks.index', compact('pengisians'));
    }

    public function create()
    {
        return view('bcks.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validatePengisian($request);

        $skor = $this->filterSkorBerdasarkanStatus(
            $validated['skor'],
            $validated['status_responden']
        );

        $indikator = $this->prepareIndikator($skor);
        [$totalSkor, $nilaiAkhir, $predikat] =
            $this->hitungHasil($indikator);

        $pengisian = DB::transaction(function () use (
            $request,
            $validated,
            $indikator,
            $totalSkor,
            $nilaiAkhir,
            $predikat
        ) {
            $pengisian = BcksPengisian::create([
                'sekolah_id' => SekolahResolver::resolve(
                    $validated['unit_kerja_responden'] ?? null
                )?->id,
                'nama_bcks' => $validated['nama_bcks'],
                'unit_kerja' => $validated['unit_kerja'] ?? null,
                'angkatan_pelatihan' => $validated['angkatan_pelatihan'] ?? null,
                'nama_responden' => $validated['nama_responden'],
                'unit_kerja_responden' => $validated['unit_kerja_responden'] ?? null,
                'status_responden' => $validated['status_responden'],
                'nama_petugas_monev' => $validated['nama_petugas_monev'],
                'unit_kerja_petugas' => $validated['unit_kerja_petugas'] ?? null,
                'tanggal_evaluasi' => $validated['tanggal_evaluasi'],
                'total_skor' => $totalSkor,
                'nilai_akhir' => $nilaiAkhir,
                'predikat' => $predikat,
                'status_pengisian' => 'Selesai',
            ]);

            foreach ($indikator as $item) {
                $pengisian->jawaban()->create($item);
            }

            return $pengisian;
        });

        return redirect()
            ->route('bcks.show', $pengisian)
            ->with('success', 'Pengisian instrumen BCKS berhasil disimpan.');
    }

    public function show(BcksPengisian $bcksPengisian)
    {
        $bcksPengisian->load('jawaban');

        return view('bcks.show', compact('bcksPengisian'));
    }

    public function cetak(BcksPengisian $bcksPengisian)
    {
        $bcksPengisian->load('jawaban');

        return view('bcks.cetak', compact('bcksPengisian'));
    }

    public function edit(BcksPengisian $bcksPengisian)
    {
        $bcksPengisian->load('jawaban');

        return view('bcks.edit', compact('bcksPengisian'));
    }

    public function update(Request $request, BcksPengisian $bcksPengisian)
    {
        $validated = $this->validatePengisian($request);

        $skor = $this->filterSkorBerdasarkanStatus(
            $validated['skor'],
            $validated['status_responden']
        );

        $indikator = $this->prepareIndikator($skor);
        [$totalSkor, $nilaiAkhir, $predikat] =
            $this->hitungHasil($indikator);

        DB::transaction(function () use (
            $validated,
            $bcksPengisian,
            $indikator,
            $totalSkor,
            $nilaiAkhir,
            $predikat
        ) {
            $bcksPengisian->update([
                'sekolah_id' => SekolahResolver::resolve(
                    $validated['unit_kerja_responden'] ?? null
                )?->id,
                'nama_bcks' => $validated['nama_bcks'],
                'unit_kerja' => $validated['unit_kerja'] ?? null,
                'angkatan_pelatihan' => $validated['angkatan_pelatihan'] ?? null,
                'nama_responden' => $validated['nama_responden'],
                'unit_kerja_responden' => $validated['unit_kerja_responden'] ?? null,
                'status_responden' => $validated['status_responden'],
                'nama_petugas_monev' => $validated['nama_petugas_monev'],
                'unit_kerja_petugas' => $validated['unit_kerja_petugas'] ?? null,
                'tanggal_evaluasi' => $validated['tanggal_evaluasi'],
                'total_skor' => $totalSkor,
                'nilai_akhir' => $nilaiAkhir,
                'predikat' => $predikat,
                'status_pengisian' => 'Selesai',
            ]);

            // Hapus jawaban lama, termasuk Level 1–2 jika tidak lagi berlaku.
            $bcksPengisian->jawaban()->delete();

            foreach ($indikator as $item) {
                $bcksPengisian->jawaban()->create($item);
            }
        });

        return redirect()
            ->route('bcks.show', $bcksPengisian)
            ->with('success', 'Data pengisian BCKS berhasil diperbarui.');
    }

    public function destroy(BcksPengisian $bcksPengisian)
    {
        $bcksPengisian->delete();

        return redirect()
            ->route('instrumen.index')
            ->with('success', 'Data pengisian BCKS berhasil dihapus.');
    }

    /**
     * Validasi identitas dan skor berdasarkan status responden.
     */
    private function validatePengisian(Request $request): array
    {
        $status = $request->input('status_responden');

        $rules = [
            'nama_bcks' => ['required', 'string', 'max:255'],
            'unit_kerja' => ['nullable', 'string', 'max:255'],
            'angkatan_pelatihan' => ['nullable', 'string', 'max:255'],
            'nama_responden' => ['required', 'string', 'max:255'],
            'unit_kerja_responden' => ['nullable', 'string', 'max:255'],
            'status_responden' => [
                'required',
                Rule::in(self::STATUS_RESPONDEN),
            ],
            'nama_petugas_monev' => ['required', 'string', 'max:255'],
            'unit_kerja_petugas' => ['nullable', 'string', 'max:255'],
            'tanggal_evaluasi' => ['required', 'date'],
            'skor' => ['required', 'array'],
        ];

        $jumlahIndikator = [
            1 => 4,
            2 => 4,
            3 => 12,
            4 => 7,
        ];

        foreach ($jumlahIndikator as $level => $jumlah) {
            for ($nomor = 1; $nomor <= $jumlah; $nomor++) {
                $key = "skor.{$level}_{$nomor}";

                // Level 1–2 wajib hanya untuk status BCKS.
                $wajib = $status === self::STATUS_BCKS || $level >= 3;

                $rules[$key] = [
                    $wajib ? 'required' : 'nullable',
                    'integer',
                    'between:1,4',
                ];
            }
        }

        $validated = $request->validate($rules);

        // Normalisasi: skor level yang tidak berlaku tidak diproses.
        $validated['skor'] = $this->filterSkorBerdasarkanStatus(
            $validated['skor'],
            $validated['status_responden']
        );

        return $validated;
    }

    /**
     * Mengeluarkan skor Level 1–2 untuk status selain BCKS.
     */
    private function filterSkorBerdasarkanStatus(
        array $skor,
        string $status
    ): array {
        if ($status === self::STATUS_BCKS) {
            return $skor;
        }

        return array_filter(
            $skor,
            fn ($nilai, $kode) => preg_match('/^[34]_\d+$/', (string) $kode),
            ARRAY_FILTER_USE_BOTH
        );
    }

    /**
     * Menyiapkan jawaban hanya dari indikator yang berlaku.
     */
    private function prepareIndikator(array $skor): array
    {
        $indikator = [];

        foreach ($skor as $kode => $nilai) {
            if (!preg_match('/^([1-4])_(\d+)$/', (string) $kode, $match)) {
                continue;
            }

            $level = $match[1];
            $nomor = (int) $match[2];

            $nomorIndikator = match ($level) {
                '1' => $nomor,
                '2' => 4 + $nomor,
                '3' => 8 + $nomor,
                '4' => 20 + $nomor,
            };

            $levelNama = match ($level) {
                '1' => 'Reaction',
                '2' => 'Learning',
                '3' => 'Behavior',
                '4' => 'Results',
            };

            $indikator[] = [
                'nomor_indikator' => $nomorIndikator,
                'level' => $levelNama,
                'skor' => (int) $nilai,
            ];
        }

        return $indikator;
    }

    /**
     * Nilai akhir berupa persentase dari skor maksimum indikator aktif.
     * Predikat menggunakan skala persentase agar adil untuk setiap status.
     */
    private function hitungHasil(array $indikator): array
    {
        $totalSkor = collect($indikator)->sum('skor');
        $skorMaksimum = count($indikator) * 4;

        $nilaiAkhir = $skorMaksimum > 0
            ? round(($totalSkor / $skorMaksimum) * 100, 2)
            : 0;

        $predikat = $this->getPredikat($nilaiAkhir);

        return [$totalSkor, $nilaiAkhir, $predikat];
    }

    private function getPredikat(float $nilaiAkhir): string
    {
        return match (true) {
            $nilaiAkhir >= 85 => 'Sangat Baik',
            $nilaiAkhir >= 70 => 'Baik',
            $nilaiAkhir >= 55 => 'Cukup',
            default => 'Perlu Pembinaan',
        };
    }
}
