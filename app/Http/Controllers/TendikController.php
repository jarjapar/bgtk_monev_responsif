<?php

namespace App\Http\Controllers;

use App\Models\Tendik;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Support\SekolahResolver;

class TendikController extends Controller
{
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
        $validated = $request->validate([
            'nama_petugas_monev' => ['required', 'string', 'max:255'],
            'instansi_petugas' => ['required', 'string', 'max:255'],
            'lokasi_monev' => ['required', 'string', 'max:255'],

            'nama_responden' => ['required', 'string', 'max:255'],

            'jabatan_responden' => [
                'required',
                Rule::in([
                    'Operator Sekolah',
                    'Bendahara Sekolah',
                    'Lainnya',
                ]),
            ],

            'jabatan_lainnya' => [
                'nullable',
                'required_if:jabatan_responden,Lainnya',
                'string',
                'max:255',
            ],

            'satuan_pendidikan' => ['required', 'string', 'max:255'],
            'masa_kerja' => ['required', 'integer', 'min:0', 'max:100'],
            'nama_pelatihan' => ['required', 'string', 'max:255'],
            'tanggal_pengisian' => ['required', 'date'],

            ...array_fill_keys(
                array_map(
                    fn($i) => 'jawaban_' . $i,
                    range(1, 43)
                ),
                ['required', 'integer', 'between:1,4']
            ),
        ], [
            'required' => 'Bagian ini wajib diisi.',
            'between' => 'Pilih salah satu jawaban dengan skor 1 sampai 4.',
            'jabatan_responden.in' => 'Pilih jabatan yang tersedia.',
            'jabatan_lainnya.required_if' => 'Tuliskan jabatan lainnya.',
        ]);

        $validated = $this->hitungSkor($validated);

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
        $validated = $request->validate([
            'nama_petugas_monev' => ['required', 'string', 'max:255'],
            'instansi_petugas' => ['required', 'string', 'max:255'],
            'lokasi_monev' => ['required', 'string', 'max:255'],

            'nama_responden' => ['required', 'string', 'max:255'],

            'jabatan_responden' => [
                'required',
                Rule::in([
                    'Operator Sekolah',
                    'Bendahara Sekolah',
                    'Lainnya',
                ]),
            ],

            'jabatan_lainnya' => [
                'nullable',
                'required_if:jabatan_responden,Lainnya',
                'string',
                'max:255',
            ],

            'satuan_pendidikan' => ['required', 'string', 'max:255'],
            'masa_kerja' => ['required', 'integer', 'min:0', 'max:100'],
            'nama_pelatihan' => ['required', 'string', 'max:255'],
            'tanggal_pengisian' => ['required', 'date'],

            ...array_fill_keys(
                array_map(
                    fn($i) => 'jawaban_' . $i,
                    range(1, 43)
                ),
                ['required', 'integer', 'between:1,4']
            ),
        ], [
            'required' => 'Bagian ini wajib diisi.',
            'between' => 'Pilih salah satu jawaban dengan skor 1 sampai 4.',
            'jabatan_responden.in' => 'Pilih jabatan yang tersedia.',
            'jabatan_lainnya.required_if' => 'Tuliskan jabatan lainnya.',
        ]);

        $validated = $this->hitungSkor($validated);

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
            ->route('tendik.index')
            ->with('success', 'Data evaluasi TENDIK berhasil dihapus.');
    }

    private function hitungSkor(array $data): array
    {
        $kelompok = [
            1 => range(1, 15),
            2 => range(16, 33),
            3 => range(34, 38),
            4 => range(39, 43),
        ];

        $skorLevel = [];

        foreach ($kelompok as $level => $nomorSoal) {
            $nilai = [];

            foreach ($nomorSoal as $nomor) {
                $nilai[] = (int) $data['jawaban_' . $nomor];
            }

            $skorLevel[$level] = round(
                array_sum($nilai) / count($nilai),
                2
            );

            $data['skor_level_' . $level] = $skorLevel[$level];
        }

        // Setiap level memiliki bobot yang sama.
        $skorKeseluruhan = round(
            array_sum($skorLevel) / count($skorLevel),
            2
        );

        $data['skor_keseluruhan'] = $skorKeseluruhan;

        $data['predikat'] = match (true) {
            $skorKeseluruhan >= 3.26 => 'Sangat Baik',
            $skorKeseluruhan >= 2.51 => 'Baik',
            $skorKeseluruhan >= 1.76 => 'Cukup',
            default => 'Kurang',
        };

        return $data;
    }
}
