<?php

namespace App\Http\Controllers;

use App\Models\Tendik;
use App\Support\SekolahResolver;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TendikController extends Controller
{
    private const JABATAN_TENDIK = [
        'Tendik',
        'Operator',
        'Bendahara',
        'Kepala Sekolah',
        'Rekan Sejawat/Guru',
    ];

    /**
     * Pembagian nomor indikator berdasarkan level.
     */
    private function kelompokLevel(): array
    {
        return [
            1 => range(1, 15),
            2 => range(16, 33),
            3 => range(34, 38),
            4 => range(39, 43),
        ];
    }

    /**
     * Tendik memperoleh semua level.
     * Jabatan lainnya hanya memperoleh Level 3 dan 4.
     */
    private function levelBerlaku(string $jabatan): array
    {
        return $jabatan === 'Tendik'
            ? [1, 2, 3, 4]
            : [3, 4];
    }

    /**
     * Mengambil nomor indikator yang berlaku untuk jabatan.
     */
    private function nomorIndikatorBerlaku(string $jabatan): array
    {
        $kelompok = $this->kelompokLevel();
        $nomor = [];

        foreach ($this->levelBerlaku($jabatan) as $level) {
            $nomor = array_merge($nomor, $kelompok[$level]);
        }

        return $nomor;
    }

    public function index()
    {
        $tendiks = Tendik::latest()->paginate(10);

        $total = Tendik::count();

        $rataRata = round(
            (float) Tendik::whereNotNull('skor_keseluruhan')
                ->avg('skor_keseluruhan'),
            2
        );

        $sangatBaik = Tendik::where('predikat', 'Sangat Baik')->count();
        $baik = Tendik::where('predikat', 'Baik')->count();
        $cukup = Tendik::where('predikat', 'Cukup')->count();
        $kurang = Tendik::where('predikat', 'Kurang')->count();

        return view('tendik.index', compact(
            'tendiks',
            'total',
            'rataRata',
            'sangatBaik',
            'baik',
            'cukup',
            'kurang'
        ));
    }

    public function create()
    {
        return view('tendik.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validasiDanHitungSkor($request);

        $sekolah = SekolahResolver::resolve(
            $validated['satuan_pendidikan'] ?? null
        );

        $validated['sekolah_id'] = $sekolah?->id;

        $tendik = Tendik::create($validated);

        return redirect()
            ->route('tendik.show', $tendik->id)
            ->with('success', 'Data evaluasi TENDIK berhasil disimpan.');
    }

    public function show(Tendik $tendik)
    {
        return view('tendik.show', compact('tendik'));
    }

    public function cetak(Tendik $tendik)
    {
        return view('tendik.cetak', compact('tendik'));
    }

    public function edit(Tendik $tendik)
    {
        return view('tendik.edit', compact('tendik'));
    }

    public function update(Request $request, Tendik $tendik)
    {
        $validated = $this->validasiDanHitungSkor($request);

        $sekolah = SekolahResolver::resolve(
            $validated['satuan_pendidikan'] ?? null
        );

        $validated['sekolah_id'] = $sekolah?->id;

        $tendik->update($validated);

        return redirect()
            ->route('tendik.show', $tendik->id)
            ->with('success', 'Data evaluasi TENDIK berhasil diperbarui.');
    }

    public function destroy(Tendik $tendik)
    {
        $tendik->delete();

        return redirect()
            ->route('instrumen.index')
            ->with('success', 'Data evaluasi TENDIK berhasil dihapus.');
    }

    /**
     * Memvalidasi identitas dan hanya indikator yang berlaku,
     * kemudian menghitung skor berdasarkan level yang berlaku.
     */
    private function validasiDanHitungSkor(Request $request): array
    {
        $request->validate([
            'jabatan_responden' => [
                'required',
                Rule::in(self::JABATAN_TENDIK),
            ],
        ], [
            'jabatan_responden.required' => 'Jabatan responden wajib dipilih.',
            'jabatan_responden.in' => 'Pilih jabatan responden yang tersedia.',
        ]);

        $jabatan = $request->input('jabatan_responden');
        $nomorBerlaku = $this->nomorIndikatorBerlaku($jabatan);

        $rules = [
            'nama_petugas_monev' => ['required', 'string', 'max:255'],
            'instansi_petugas' => ['required', 'string', 'max:255'],
            'lokasi_monev' => ['required', 'string', 'max:255'],
            'nama_responden' => ['required', 'string', 'max:255'],
            'jabatan_responden' => [
                'required',
                Rule::in(self::JABATAN_TENDIK),
            ],
            'satuan_pendidikan' => ['required', 'string', 'max:255'],
            'masa_kerja' => ['required', 'integer', 'min:0', 'max:100'],
            'nama_pelatihan' => ['required', 'string', 'max:255'],
            'tanggal_pengisian' => ['required', 'date'],
        ];

        foreach ($nomorBerlaku as $nomor) {
            $rules['jawaban_' . $nomor] = [
                'required',
                'integer',
                'between:1,4',
            ];
        }

        $validated = $request->validate($rules, [
            'required' => 'Bagian ini wajib diisi.',
            'integer' => 'Jawaban harus berupa angka.',
            'between' => 'Pilih salah satu jawaban dengan skor 1 sampai 4.',
        ]);

        // Hitung skor hanya dari indikator yang berlaku.
        $kelompok = $this->kelompokLevel();
        $skorLevel = [];

        foreach ($this->levelBerlaku($jabatan) as $level) {
            $nilai = [];

            foreach ($kelompok[$level] as $nomor) {
                $nilai[] = (int) $validated['jawaban_' . $nomor];
            }

            $skorLevel[$level] = round(
                array_sum($nilai) / count($nilai),
                2
            );

            $validated['skor_level_' . $level] = $skorLevel[$level];
        }

        // Level yang tidak berlaku tidak dimasukkan ke rata-rata.
        // Nilai null memerlukan kolom database yang mengizinkan NULL.
        foreach ([1, 2, 3, 4] as $level) {
            if (!array_key_exists($level, $skorLevel)) {
                $validated['skor_level_' . $level] = null;
            }
        }

        // Setiap level yang berlaku memiliki bobot yang sama.
        $skorKeseluruhan = round(
            array_sum($skorLevel) / count($skorLevel),
            2
        );

        $validated['skor_keseluruhan'] = $skorKeseluruhan;

        $validated['predikat'] = match (true) {
            $skorKeseluruhan >= 3.26 => 'Sangat Baik',
            $skorKeseluruhan >= 2.51 => 'Baik',
            $skorKeseluruhan >= 1.76 => 'Cukup',
            default => 'Kurang',
        };

        // Field lama tidak lagi diperlukan karena jabatan sudah ditentukan.
        $validated['jabatan_lainnya'] = null;

        return $validated;
    }
}
