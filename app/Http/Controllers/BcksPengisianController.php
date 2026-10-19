<?php

namespace App\Http\Controllers;

use App\Models\BcksPengisian;
use Illuminate\Http\Request;
use App\Support\SekolahResolver;

class BcksPengisianController extends Controller
{
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
        $request->validate([
            'nama_bcks' => ['required', 'string', 'max:255'],
            'unit_kerja' => ['nullable', 'string', 'max:255'],
            'angkatan_pelatihan' => ['nullable', 'string', 'max:255'],

            'nama_responden' => ['required', 'string', 'max:255'],
            'unit_kerja_responden' => ['nullable', 'string', 'max:255'],

            'status_responden' => [
                'required',
                'in:BCKS,Atasan Langsung / Pengawas Sekolah,Perwakilan Guru / Tenaga Kependidikan',
            ],

            'nama_petugas_monev' => ['required', 'string', 'max:255'],
            'unit_kerja_petugas' => ['nullable', 'string', 'max:255'],
            'tanggal_evaluasi' => ['required', 'date'],

            'skor' => ['required', 'array'],

            'skor.1_1' => ['required', 'integer', 'between:1,4'],
            'skor.1_2' => ['required', 'integer', 'between:1,4'],
            'skor.1_3' => ['required', 'integer', 'between:1,4'],
            'skor.1_4' => ['required', 'integer', 'between:1,4'],

            'skor.2_1' => ['required', 'integer', 'between:1,4'],
            'skor.2_2' => ['required', 'integer', 'between:1,4'],
            'skor.2_3' => ['required', 'integer', 'between:1,4'],
            'skor.2_4' => ['required', 'integer', 'between:1,4'],

            'skor.3_1' => ['required', 'integer', 'between:1,4'],
            'skor.3_2' => ['required', 'integer', 'between:1,4'],
            'skor.3_3' => ['required', 'integer', 'between:1,4'],
            'skor.3_4' => ['required', 'integer', 'between:1,4'],
            'skor.3_5' => ['required', 'integer', 'between:1,4'],
            'skor.3_6' => ['required', 'integer', 'between:1,4'],
            'skor.3_7' => ['required', 'integer', 'between:1,4'],
            'skor.3_8' => ['required', 'integer', 'between:1,4'],
            'skor.3_9' => ['required', 'integer', 'between:1,4'],
            'skor.3_10' => ['required', 'integer', 'between:1,4'],
            'skor.3_11' => ['required', 'integer', 'between:1,4'],
            'skor.3_12' => ['required', 'integer', 'between:1,4'],

            'skor.4_1' => ['required', 'integer', 'between:1,4'],
            'skor.4_2' => ['required', 'integer', 'between:1,4'],
            'skor.4_3' => ['required', 'integer', 'between:1,4'],
            'skor.4_4' => ['required', 'integer', 'between:1,4'],
            'skor.4_5' => ['required', 'integer', 'between:1,4'],
            'skor.4_6' => ['required', 'integer', 'between:1,4'],
            'skor.4_7' => ['required', 'integer', 'between:1,4'],

            // 'dampak_implementasi_rptks' => ['nullable', 'string'],
            // 'kendala_strategi_mitigasi' => ['nullable', 'string'],
            // 'perubahan_pengambilan_keputusan' => ['nullable', 'string'],
            // 'dukungan_lingkungan_sekolah' => ['nullable', 'string'],
            // 'keberlanjutan_program_inovasi' => ['nullable', 'string'],
        ]);


        $indikator = $this->prepareIndikator($request->input('skor'));

        $totalSkor = collect($indikator)->sum('skor');

        $nilaiAkhir = ($totalSkor / 108) * 100;

        $predikat = $this->getPredikat($totalSkor);


        $pengisian = BcksPengisian::create([
            'sekolah_id' => SekolahResolver::resolve(
                $request->input('unit_kerja_responden')
            )?->id,
            'nama_bcks' => $request->nama_bcks,
            'unit_kerja' => $request->unit_kerja,
            'angkatan_pelatihan' => $request->angkatan_pelatihan,

            'nama_responden' => $request->nama_responden,
            'unit_kerja_responden' => $request->unit_kerja_responden,
            'status_responden' => $request->status_responden,

            'nama_petugas_monev' => $request->nama_petugas_monev,
            'unit_kerja_petugas' => $request->unit_kerja_petugas,
            'tanggal_evaluasi' => $request->tanggal_evaluasi,

            'total_skor' => $totalSkor,
            'nilai_akhir' => round($nilaiAkhir, 2),
            'predikat' => $predikat,

            // 'dampak_implementasi_rptks' => $request->dampak_implementasi_rptks,
            // 'kendala_strategi_mitigasi' => $request->kendala_strategi_mitigasi,
            // 'perubahan_pengambilan_keputusan' => $request->perubahan_pengambilan_keputusan,
            // 'dukungan_lingkungan_sekolah' => $request->dukungan_lingkungan_sekolah,
            // 'keberlanjutan_program_inovasi' => $request->keberlanjutan_program_inovasi,

            'status_pengisian' => 'Selesai',
        ]);


        foreach ($indikator as $item) {
            $pengisian->jawaban()->create($item);
        }


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
        $request->validate([
            'nama_bcks' => ['required', 'string', 'max:255'],
            'unit_kerja' => ['nullable', 'string', 'max:255'],
            'angkatan_pelatihan' => ['nullable', 'string', 'max:255'],

            'nama_responden' => ['required', 'string', 'max:255'],
            'unit_kerja_responden' => ['nullable', 'string', 'max:255'],

            'status_responden' => [
                'required',
                'in:BCKS,Atasan Langsung / Pengawas Sekolah,Perwakilan Guru / Tenaga Kependidikan',
            ],

            'nama_petugas_monev' => ['required', 'string', 'max:255'],
            'unit_kerja_petugas' => ['nullable', 'string', 'max:255'],
            'tanggal_evaluasi' => ['required', 'date'],

            'skor' => ['required', 'array'],

            'skor.1_1' => ['required', 'integer', 'between:1,4'],
            'skor.1_2' => ['required', 'integer', 'between:1,4'],
            'skor.1_3' => ['required', 'integer', 'between:1,4'],
            'skor.1_4' => ['required', 'integer', 'between:1,4'],

            'skor.2_1' => ['required', 'integer', 'between:1,4'],
            'skor.2_2' => ['required', 'integer', 'between:1,4'],
            'skor.2_3' => ['required', 'integer', 'between:1,4'],
            'skor.2_4' => ['required', 'integer', 'between:1,4'],

            'skor.3_1' => ['required', 'integer', 'between:1,4'],
            'skor.3_2' => ['required', 'integer', 'between:1,4'],
            'skor.3_3' => ['required', 'integer', 'between:1,4'],
            'skor.3_4' => ['required', 'integer', 'between:1,4'],
            'skor.3_5' => ['required', 'integer', 'between:1,4'],
            'skor.3_6' => ['required', 'integer', 'between:1,4'],
            'skor.3_7' => ['required', 'integer', 'between:1,4'],
            'skor.3_8' => ['required', 'integer', 'between:1,4'],
            'skor.3_9' => ['required', 'integer', 'between:1,4'],
            'skor.3_10' => ['required', 'integer', 'between:1,4'],
            'skor.3_11' => ['required', 'integer', 'between:1,4'],
            'skor.3_12' => ['required', 'integer', 'between:1,4'],

            'skor.4_1' => ['required', 'integer', 'between:1,4'],
            'skor.4_2' => ['required', 'integer', 'between:1,4'],
            'skor.4_3' => ['required', 'integer', 'between:1,4'],
            'skor.4_4' => ['required', 'integer', 'between:1,4'],
            'skor.4_5' => ['required', 'integer', 'between:1,4'],
            'skor.4_6' => ['required', 'integer', 'between:1,4'],
            'skor.4_7' => ['required', 'integer', 'between:1,4'],

            // 'dampak_implementasi_rptks' => ['nullable', 'string'],
            // 'kendala_strategi_mitigasi' => ['nullable', 'string'],
            // 'perubahan_pengambilan_keputusan' => ['nullable', 'string'],
            // 'dukungan_lingkungan_sekolah' => ['nullable', 'string'],
            // 'keberlanjutan_program_inovasi' => ['nullable', 'string'],
        ]);


        $indikator = $this->prepareIndikator($request->input('skor'));

        $totalSkor = collect($indikator)->sum('skor');

        $nilaiAkhir = ($totalSkor / 108) * 100;

        $predikat = $this->getPredikat($totalSkor);


        $bcksPengisian->update([
            'nama_bcks' => $request->nama_bcks,
            'unit_kerja' => $request->unit_kerja,
            'angkatan_pelatihan' => $request->angkatan_pelatihan,

            'nama_responden' => $request->nama_responden,
            'unit_kerja_responden' => $request->unit_kerja_responden,
            'status_responden' => $request->status_responden,

            'nama_petugas_monev' => $request->nama_petugas_monev,
            'unit_kerja_petugas' => $request->unit_kerja_petugas,
            'tanggal_evaluasi' => $request->tanggal_evaluasi,

            'total_skor' => $totalSkor,
            'nilai_akhir' => round($nilaiAkhir, 2),
            'predikat' => $predikat,

            // 'dampak_implementasi_rptks' => $request->dampak_implementasi_rptks,
            // 'kendala_strategi_mitigasi' => $request->kendala_strategi_mitigasi,
            // 'perubahan_pengambilan_keputusan' => $request->perubahan_pengambilan_keputusan,
            // 'dukungan_lingkungan_sekolah' => $request->dukungan_lingkungan_sekolah,
            // 'keberlanjutan_program_inovasi' => $request->keberlanjutan_program_inovasi,

            'status_pengisian' => 'Selesai',
        ]);


        foreach ($indikator as $item) {

            $bcksPengisian->jawaban()->updateOrCreate(
                [
                    'nomor_indikator' => $item['nomor_indikator'],
                ],
                [
                    'level' => $item['level'],
                    'skor' => $item['skor'],
                ]
            );

        }


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


    /*
    |--------------------------------------------------------------------------
    | Helper: Siapkan data 27 indikator
    |--------------------------------------------------------------------------
    */

    private function prepareIndikator(array $skor): array
    {
        $indikator = [];

        foreach ($skor as $kode => $nilai) {

            $kodeAsli = str_replace('_', '.', $kode);

            [$level, $nomor] = explode('.', $kodeAsli);

            $nomorIndikator = match ($level) {
                '1' => (int) $nomor,
                '2' => 4 + (int) $nomor,
                '3' => 8 + (int) $nomor,
                '4' => 20 + (int) $nomor,
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


    /*
    |--------------------------------------------------------------------------
    | Helper: Tentukan predikat
    |--------------------------------------------------------------------------
    */

    private function getPredikat(int $totalSkor): string
    {
        return match (true) {
            $totalSkor >= 92 => 'Sangat Baik',
            $totalSkor >= 76 => 'Baik',
            $totalSkor >= 60 => 'Cukup',
            default => 'Perlu Pembinaan',
        };
    }
}