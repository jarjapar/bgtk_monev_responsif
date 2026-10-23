<?php

namespace App\Http\Controllers;

use App\Models\PkgsdMbiPengisian;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PkgsdMbiController extends Controller
{
    public function index()
    {
        $pengisian = PkgsdMbiPengisian::latest('tanggal_monev')
            ->latest('id')
            ->paginate(10);

        return view('pkgsd-mbi.index', compact('pengisian'));
    }

    public function create()
    {
        return view('pkgsd-mbi.create');
    }

    public function store(Request $request)
    {
        // Validasi menerima data array dari Request.
        $validated = $this->validasiPengisian($request->all());

        // Validasi dan rapikan jawaban setiap level.
        $jawaban = $this->ambilJawabanLevel($request);

        $namaSekolah = preg_replace(
            '/\s+/',
            ' ',
            trim($validated['nama_sekolah'])
        );

        $sekolah = $this->cariAtauBuatSekolah($namaSekolah);

        $validated['nama_sekolah'] = $namaSekolah;
        $validated['sekolah_id'] = $sekolah->id;

        $item = PkgsdMbiPengisian::create(array_merge(
            $validated,
            $jawaban,
            ['status' => 'Selesai']
        ));

        return redirect()
            ->route('pkgsd-mbi.show', $item)
            ->with('success', 'Pengisian PKGSD MBI berhasil disimpan.');
    }

    public function cetak(PkgsdMbiPengisian $pkgsdMbi)
    {
        return view('pkgsd-mbi.cetak', compact('pkgsdMbi'));
    }

    public function show(PkgsdMbiPengisian $pkgsdMbi)
    {
        return view('pkgsd-mbi.show', compact('pkgsdMbi'));
    }

    public function edit(PkgsdMbiPengisian $pkgsdMbi)
    {
        return view('pkgsd-mbi.edit', compact('pkgsdMbi'));
    }

    public function update(
        Request $request,
        PkgsdMbiPengisian $pkgsdMbi
    ) {
        $validated = $this->validasiPengisian($request->all());
        $jawaban = $this->ambilJawabanLevel($request);

        $namaSekolah = preg_replace(
            '/\s+/',
            ' ',
            trim($validated['nama_sekolah'])
        );

        $sekolah = $this->cariAtauBuatSekolah($namaSekolah);

        $validated['nama_sekolah'] = $namaSekolah;
        $validated['sekolah_id'] = $sekolah->id;

        $pkgsdMbi->update(array_merge(
            $validated,
            $jawaban
        ));

        return redirect()
            ->route('pkgsd-mbi.show', $pkgsdMbi)
            ->with('success', 'Pengisian PKGSD MBI berhasil diperbarui.');
    }

    public function destroy(PkgsdMbiPengisian $pkgsdMbi)
    {
        $pkgsdMbi->delete();

        return redirect()
            ->route('pkgsd-mbi.index')
            ->with('success', 'Pengisian PKGSD MBI berhasil dihapus.');
    }

    /**
     * Validasi biodata dan semua skor indikator aktif.
     */
    private function validasiPengisian(array $data): array
    {
        $rules = [
            'nama_guru' => ['required', 'string', 'max:255'],
            'nama_sekolah' => ['required', 'string', 'max:255'],
            'kelas_fase' => ['nullable', 'string', 'max:100'],
            'topik_materi' => ['nullable', 'string', 'max:255'],
            'nama_petugas_monev' => ['required', 'string', 'max:255'],

            'jabatan_penilai' => [
                'required',
                'in:Peserta PKGSD MBI,Rekan sejawat,Atasan langsung/Kepala Sekolah',
            ],

            'tanggal_monev' => ['required', 'date'],
            'sumber_data_bukti' => ['nullable', 'string'],
        ];

        $messages = [
            'required' => ':attribute wajib diisi.',
            'in' => 'Pilihan pada :attribute tidak valid.',
            'array' => 'Format jawaban :attribute tidak valid.',
            'size' => 'Jumlah indikator pada :attribute tidak lengkap.',
            'string' => ':attribute harus berupa teks.',
            'date' => ':attribute harus berupa tanggal yang valid.',
        ];

        $attributes = [
            'nama_guru' => 'Nama Guru',
            'nama_sekolah' => 'Nama Sekolah',
            'kelas_fase' => 'Kelas / Fase',
            'topik_materi' => 'Topik / Materi',
            'nama_petugas_monev' => 'Nama Petugas Monev',
            'jabatan_penilai' => 'Jabatan Penilai',
            'tanggal_monev' => 'Tanggal Monev',
            'sumber_data_bukti' => 'Sumber Data / Bukti',
        ];

        $jabatan = $data['jabatan_penilai'] ?? null;
        $peserta = $jabatan === 'Peserta PKGSD MBI';

        // Level 1 dan 2 hanya untuk peserta PKGSD MBI.
        $levelAktif = $peserta
            ? [1 => 29, 2 => 10, 3 => 22, 4 => 12]
            : [3 => 22, 4 => 12];

        foreach ($levelAktif as $level => $jumlah) {
            $field = "level_{$level}_jawaban";

            $rules[$field] = [
                'required',
                'array',
                "size:{$jumlah}",
            ];

            for ($i = 1; $i <= $jumlah; $i++) {
                $skorField = "{$field}.{$i}.skor";

                $rules[$skorField] = $level === 3
                    ? ['required', 'in:1,2,3,4,TD']
                    : ['required', 'in:1,2,3,4'];

                $attributes[$skorField] =
                    "Skor Level {$level}, indikator {$i}";

                // Bukti wajib untuk skor 3 atau 4 pada Level 3 dan 4.
                if (in_array($level, [3, 4], true)) {
                    $buktiField = "{$field}.{$i}.bukti";

                    $rules[$buktiField] = [
                        'nullable',
                        'string',
                        "required_if:{$skorField},3,4",
                    ];

                    $messages["{$buktiField}.required_if"] =
                        "Bukti indikator {$i} pada Level {$level} wajib diisi jika skor 3 atau 4.";

                    $attributes[$buktiField] =
                        "Bukti Level {$level}, indikator {$i}";
                }
            }
        }

        return Validator::make(
            $data,
            $rules,
            $messages,
            $attributes
        )->validate();
    }

    /**
     * Ambil dan bersihkan jawaban level aktif.
     */
    private function ambilJawabanLevel(Request $request): array
    {
        $peserta = $request->input('jabatan_penilai')
            === 'Peserta PKGSD MBI';

        $levelAktif = $peserta
            ? [1, 2, 3, 4]
            : [3, 4];

        $jumlahIndikator = [
            1 => 29,
            2 => 10,
            3 => 22,
            4 => 12,
        ];

        $hasil = [];
        $errors = [];

        foreach ($levelAktif as $level) {
            $field = "level_{$level}_jawaban";
            $jawaban = $request->input($field, []);

            if (!is_array($jawaban)) {
                $errors[$field] =
                    "Format jawaban Level {$level} tidak valid.";
                continue;
            }

            $skorDiizinkan = $level === 3
                ? ['1', '2', '3', '4', 'TD']
                : ['1', '2', '3', '4'];

            $jawabanBersih = [];

            for (
                $nomor = 1;
                $nomor <= $jumlahIndikator[$level];
                $nomor++
            ) {
                $item = $jawaban[$nomor] ?? [];

                if (!is_array($item)) {
                    $item = ['skor' => $item];
                }

                $skor = $item['skor'] ?? null;
                $bukti = trim((string) ($item['bukti'] ?? ''));
                $alasanTd = trim((string) ($item['alasan_td'] ?? ''));

                if ($skor === null || $skor === '') {
                    $errors["{$field}.{$nomor}.skor"] =
                        "Skor indikator {$nomor} Level {$level} wajib dipilih.";
                    continue;
                }

                $skor = strtoupper((string) $skor);

                if (!in_array($skor, $skorDiizinkan, true)) {
                    $errors["{$field}.{$nomor}.skor"] =
                        "Skor indikator {$nomor} Level {$level} tidak valid.";
                    continue;
                }

                if (
                    in_array($level, [3, 4], true)
                    && in_array($skor, ['3', '4'], true)
                    && $bukti === ''
                ) {
                    $errors["{$field}.{$nomor}.bukti"] =
                        "Bukti indikator {$nomor} Level {$level} wajib diisi untuk skor {$skor}.";
                }

                $jawabanBersih[$nomor] = [
                    'skor' => $skor,
                ];

                if (in_array($level, [3, 4], true)) {
                    $jawabanBersih[$nomor]['bukti'] = $bukti;
                }

                // Alasan TD tetap opsional.
                if ($level === 3 && $skor === 'TD') {
                    $jawabanBersih[$nomor]['alasan_td'] = $alasanTd;
                }
            }

            $hasil[$field] = $jawabanBersih;
        }

        if ($errors) {
            throw ValidationException::withMessages($errors);
        }

        return $hasil;
    }

    /**
     * Cari sekolah berdasarkan nama atau buat jika belum tersedia.
     */
    private function cariAtauBuatSekolah(string $namaSekolah): Sekolah
    {
        $sekolah = Sekolah::query()
            ->whereRaw('LOWER(TRIM(nama_sekolah)) = ?', [
                mb_strtolower($namaSekolah),
            ])
            ->first();

        if (!$sekolah) {
            $sekolah = Sekolah::create([
                'nama_sekolah' => $namaSekolah,
                'status_monitoring' => 'Belum Dimonitor',
                'tahun_monitoring' => now()->year,
            ]);
        }

        return $sekolah;
    }
}
