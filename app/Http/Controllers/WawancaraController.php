<?php

namespace App\Http\Controllers;

use App\Models\Instrumen;
use App\Models\Sekolah;
use App\Models\Wawancara;
use App\Support\SekolahResolver;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class WawancaraController extends Controller
{
    /**
     * Daftar wawancara, pencarian, filter, dan statistik.
     */
    public function index(Request $request)
    {
        $query = Wawancara::with(['instrumen', 'sekolah']);

        // Filter jenis wawancara.
        if ($request->filled('jenis_instrumen')) {
            $jenis = $request->jenis_instrumen;

            $query->where(function ($q) use ($jenis) {
                $q->where('jenis_wawancara', $jenis)
                    ->orWhere(function ($legacy) use ($jenis) {
                        $legacy->whereNull('jenis_wawancara')
                            ->whereHas('instrumen', function ($i) use ($jenis) {
                                if ($jenis === 'BCKS') {
                                    $i->where(function ($sub) {
                                        $sub->where(
                                            'nama_instrumen',
                                            'like',
                                            '%BCKS%'
                                        )->orWhere(
                                                'kode_instrumen',
                                                'like',
                                                '%BCKS%'
                                            );
                                    });
                                } elseif ($jenis === 'BK') {
                                    $i->where(function ($sub) {
                                        $sub->where(
                                            'nama_instrumen',
                                            'like',
                                            '%BK%'
                                        )->orWhere(
                                                'kode_instrumen',
                                                'like',
                                                '%BK%'
                                            );
                                    })
                                        ->where(function ($sub) {
                                            $sub->whereNull('nama_instrumen')
                                                ->orWhere(
                                                    'nama_instrumen',
                                                    'not like',
                                                    '%BCKS%'
                                                );
                                        })
                                        ->where(function ($sub) {
                                            $sub->whereNull('kode_instrumen')
                                                ->orWhere(
                                                    'kode_instrumen',
                                                    'not like',
                                                    '%BCKS%'
                                                );
                                        });
                                } elseif ($jenis === 'TENDIK') {
                                    $i->where(function ($sub) {
                                        $sub->where(
                                            'nama_instrumen',
                                            'like',
                                            '%TENDIK%'
                                        )->orWhere(
                                                'kode_instrumen',
                                                'like',
                                                '%TENDIK%'
                                            );
                                    });
                                }
                            });
                    });
            });
        }

        // Filter status.
        if ($request->filled('status')) {
            $status = $request->status;

            if (in_array($status, ['Draft', 'Dalam Proses'], true)) {
                $query->where('status', 'Belum Dilaksanakan');
            } elseif ($status === 'Final') {
                $query->where('status', 'Selesai');
            } elseif (
                in_array(
                    $status,
                    ['Belum Dilaksanakan', 'Selesai'],
                    true
                )
            ) {
                $query->where('status', $status);
            }
        }

        // Pencarian.
        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $fields = [
                    'jenis_wawancara',
                    'nama_bcks',
                    'unit_kerja_bcks',
                    'angkatan_pelatihan_bcks',
                    'nama_responden',
                    'unit_kerja_responden',
                    'status_responden',
                    'nama_petugas_monev',
                    'unit_kerja_petugas',
                    'nama_narasumber',
                    'jabatan_narasumber',
                    'nama_pewawancara',
                    'hasil_wawancara',
                    'catatan',
                ];

                foreach ($fields as $field) {
                    $q->orWhere($field, 'like', "%{$search}%");
                }

                $q->orWhereHas('instrumen', function ($i) use ($search) {
                    $i->where('nama_instrumen', 'like', "%{$search}%")
                        ->orWhere(
                            'kode_instrumen',
                            'like',
                            "%{$search}%"
                        );
                });

                $q->orWhereHas('sekolah', function ($s) use ($search) {
                    $s->where('nama_sekolah', 'like', "%{$search}%")
                        ->orWhere('npsn', 'like', "%{$search}%");
                });
            });
        }

        $wawancaras = (clone $query)
            ->latest('tanggal_wawancara')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        $totalWawancara = (clone $query)->count();

        $selesai = (clone $query)
            ->where('status', 'Selesai')
            ->count();

        $belumDilaksanakan = (clone $query)
            ->where('status', 'Belum Dilaksanakan')
            ->count();

        $sekolahTerlibat = (clone $query)
            ->whereNotNull('sekolah_id')
            ->distinct()
            ->count('sekolah_id');

        return view('wawancara.index', compact(
            'wawancaras',
            'totalWawancara',
            'selesai',
            'belumDilaksanakan',
            'sekolahTerlibat'
        ));
    }

    /**
     * Form tambah wawancara BCKS.
     */
    public function create()
    {
        return $this->formBcks();
    }

    public function createBcks()
    {
        return $this->formBcks();
    }

    /**
     * Form khusus wawancara BK.
     */
    public function createBk()
    {
        return view('wawancara.create-bk');
    }

    /**
     * Form khusus wawancara TENDIK.
     */
    public function createTendik()
    {
        return view('wawancara.create-tendik');
    }
    /**
     * Form wawancara Matematika GEMBIRA.
     */
    public function createGembira()
    {
        return view('wawancara.create-gembira');
    }

    /**
     * Menyimpan wawancara terbuka Matematika GEMBIRA.
     */
    public function storeGembira(Request $request)
    {
        $validated = $request->validate([
            'nama_guru' => ['required', 'string', 'max:255'],
            'nama_sekolah' => ['required', 'string', 'max:255'],
            'kelas_fase' => ['nullable', 'string', 'max:255'],
            'topik_materi' => ['nullable', 'string', 'max:255'],

            'nama_petugas_monev' => ['required', 'string', 'max:255'],
            'jabatan_penilai' => [
                'required',
                'string',
                'in:Peserta Matematika GEMBIRA,Rekan sejawat,Atasan langsung/Kepala Sekolah',
            ],
            'tanggal_monev' => ['required', 'date'],
            'sumber_data_bukti' => ['nullable', 'string'],
            'catatan' => ['nullable', 'string'],

            'jawaban_1' => ['required', 'string'],
            'jawaban_2' => ['required', 'string'],
            'jawaban_3' => ['required', 'string'],
            'jawaban_4' => ['required', 'string'],
            'jawaban_5_a' => ['required', 'string'],
            'jawaban_5_b' => ['required', 'string'],
            'jawaban_5_c' => ['required', 'string'],
            'jawaban_5_d' => ['required', 'string'],
            'jawaban_5_e' => ['required', 'string'],
            'jawaban_6' => ['required', 'string'],
            'jawaban_7' => ['required', 'string'],
        ]);

        // Simpan identitas dan seluruh jawaban dalam metadata JSON.
        $metadata = [
            'program' => 'Matematika GEMBIRA',
            'nama_guru' => $validated['nama_guru'],
            'nama_sekolah' => $validated['nama_sekolah'],
            'kelas_fase' => $validated['kelas_fase'] ?? null,
            'topik_materi' => $validated['topik_materi'] ?? null,
            'jabatan_penilai' => $validated['jabatan_penilai'],
            'tanggal_monev' => $validated['tanggal_monev'],
            'sumber_data_bukti' => $validated['sumber_data_bukti'] ?? null,

            'jawaban_terbuka' => [
                '1' => $validated['jawaban_1'],
                '2' => $validated['jawaban_2'],
                '3' => $validated['jawaban_3'],
                '4' => $validated['jawaban_4'],
                '5' => [
                    'a' => $validated['jawaban_5_a'],
                    'b' => $validated['jawaban_5_b'],
                    'c' => $validated['jawaban_5_c'],
                    'd' => $validated['jawaban_5_d'],
                    'e' => $validated['jawaban_5_e'],
                ],
                '6' => $validated['jawaban_6'],
                '7' => $validated['jawaban_7'],
            ],
        ];

        $sekolah = SekolahResolver::resolve($validated['nama_sekolah']);

        $wawancara = Wawancara::create([
            'jenis_wawancara' => 'GEMBIRA',
            'instrumen_id' => null,
            'sekolah_id' => $sekolah?->id,

            'tanggal_wawancara' => $validated['tanggal_monev'],
            'tanggal_evaluasi' => $validated['tanggal_monev'],
            'status' => 'Selesai',

            'nama_petugas_monev' => $validated['nama_petugas_monev'],
            'unit_kerja_petugas' => '-',
            'nama_pewawancara' => $validated['nama_petugas_monev'],

            'nama_responden' => $validated['nama_guru'],
            'unit_kerja_responden' => $validated['nama_sekolah'],
            'status_responden' => $validated['jabatan_penilai'],

            'nama_narasumber' => $validated['nama_guru'],
            'jabatan_narasumber' => $validated['jabatan_penilai'],

            // Kolom jawaban yang sudah digunakan oleh controller lama.
            'jawaban_1' => $validated['jawaban_1'],
            'jawaban_2' => $validated['jawaban_2'],
            'jawaban_3' => $validated['jawaban_3'],
            'jawaban_4' => $validated['jawaban_4'],
            'jawaban_5' => json_encode([
                'a' => $validated['jawaban_5_a'],
                'b' => $validated['jawaban_5_b'],
                'c' => $validated['jawaban_5_c'],
                'd' => $validated['jawaban_5_d'],
                'e' => $validated['jawaban_5_e'],
            ], JSON_UNESCAPED_UNICODE),

            'hasil_wawancara' => json_encode(
                $metadata,
                JSON_UNESCAPED_UNICODE
            ),
            'catatan' => $validated['catatan'] ?? null,
        ]);

        return redirect()
            ->route('wawancara.show', $wawancara->id)
            ->with('success', 'Wawancara terbuka Matematika GEMBIRA berhasil disimpan.');
    }

    /**
     * Menyimpan hasil wawancara TENDIK.
     */

    /**
     * Menyimpan hasil wawancara TENDIK.
     */


    public function storeTendik(Request $request)
    {
        $validated = $request->validate([
            'nama_petugas_monev' => ['required', 'string', 'max:255'],
            'instansi_petugas' => ['required', 'string', 'max:255'],
            'lokasi_monev' => ['required', 'string', 'max:255'],

            'tanggal_pelaksanaan' => ['required', 'date'],
            'tanggal_wawancara' => ['required', 'date'],

            'nama_responden' => ['required', 'string', 'max:255'],
            'jabatan_responden' => [
                'required',
                'string',
                'in:Tendik,Operator,Bendahara,Kepala Sekolah,Rekan Sejawat/Guru',
            ],

            'satuan_pendidikan' => ['required', 'string', 'max:255'],
            'masa_kerja' => ['required', 'numeric', 'min:0', 'max:100'],
            'nama_pelatihan' => ['required', 'string', 'max:255'],

            'jawaban_1' => ['required', 'string'],
            'jawaban_2' => ['required', 'string'],
            'jawaban_3' => ['required', 'string'],
            'jawaban_4' => ['required', 'string'],
            'jawaban_5' => ['required', 'string'],
        ]);

        $metadata = [
            'instansi_petugas' => $validated['instansi_petugas'],
            'lokasi_monev' => $validated['lokasi_monev'],
            'tanggal_pelaksanaan' => $validated['tanggal_pelaksanaan'],
            'jabatan_responden' => $validated['jabatan_responden'],
            'satuan_pendidikan' => $validated['satuan_pendidikan'],
            'masa_kerja' => $validated['masa_kerja'],
            'nama_pelatihan' => $validated['nama_pelatihan'],
        ];

        $wawancara = Wawancara::create([
            'jenis_wawancara' => 'TENDIK',
            'instrumen_id' => null,

            'sekolah_id' => SekolahResolver::resolve(
                $validated['satuan_pendidikan']
            )?->id,

            'tanggal_wawancara' => $validated['tanggal_wawancara'],
            'tanggal_evaluasi' => $validated['tanggal_pelaksanaan'],
            'status' => 'Selesai',

            'nama_petugas_monev' => $validated['nama_petugas_monev'],
            'unit_kerja_petugas' => $validated['instansi_petugas'],
            'nama_pewawancara' => $validated['nama_petugas_monev'],

            'nama_responden' => $validated['nama_responden'],
            'unit_kerja_responden' => $validated['satuan_pendidikan'],
            'status_responden' => $validated['jabatan_responden'],

            // Mempertahankan kolom lama agar kompatibel dengan data sebelumnya.
            'nama_narasumber' => $validated['nama_responden'],
            'jabatan_narasumber' => $validated['jabatan_responden'],

            'jawaban_1' => $validated['jawaban_1'],
            'jawaban_2' => $validated['jawaban_2'],
            'jawaban_3' => $validated['jawaban_3'],
            'jawaban_4' => $validated['jawaban_4'],
            'jawaban_5' => $validated['jawaban_5'],

            'hasil_wawancara' => json_encode(
                $metadata,
                JSON_UNESCAPED_UNICODE
            ),
        ]);

        return redirect()
            ->route('wawancara.show', $wawancara->id)
            ->with('success', 'Data wawancara TENDIK berhasil disimpan.');
    }




    /**
     * Form BCKS.
     */
    private function formBcks()
    {
        return view('wawancara.create');
    }

    /**
     * Menyimpan wawancara BCKS.
     */
    public function store(Request $request)
    {
        $validated = $this->validasiBcksBaru($request);

        Wawancara::create($validated);

        return redirect()
            ->route('wawancara.index')
            ->with('success', 'Data wawancara BCKS berhasil disimpan.');
    }

    /**
     * Validasi dan persiapan data BCKS.
     */
    private function validasiBcksBaru(Request $request): array
    {
        $validated = $request->validate([
            'tanggal_evaluasi' => ['required', 'date'],

            'nama_bcks' => ['required', 'string', 'max:255'],
            'unit_kerja_bcks' => ['required', 'string', 'max:255'],
            'angkatan_pelatihan_bcks' => [
                'required',
                'string',
                'max:255',
            ],

            'nama_responden' => ['required', 'string', 'max:255'],
            'unit_kerja_responden' => [
                'required',
                'string',
                'max:255',
            ],
            'status_responden' => [
                'required',
                'string',
                Rule::in([
                    'BCKS',
                    'Atasan Langsung / Pengawas Sekolah',
                    'Perwakilan Guru / Tenaga Kependidikan',
                ]),
            ],

            'nama_petugas_monev' => [
                'required',
                'string',
                'max:255',
            ],
            'unit_kerja_petugas' => [
                'required',
                'string',
                'max:255',
            ],

            'jawaban_1' => ['nullable', 'string'],
            'jawaban_2' => ['nullable', 'string'],
            'jawaban_3' => ['nullable', 'string'],
            'jawaban_4' => ['nullable', 'string'],
            'jawaban_5' => ['nullable', 'string'],

            'hasil_wawancara' => ['nullable', 'string'],
            'catatan' => ['nullable', 'string'],
        ]);

        $validated['jenis_wawancara'] = 'BCKS';
        $validated['instrumen_id'] = null;
        $validated['sekolah_id'] = SekolahResolver::resolve(
            $validated['unit_kerja_responden']
        )?->id;

        $validated['tanggal_wawancara'] =
            $validated['tanggal_evaluasi'];

        $validated['nama_narasumber'] =
            $validated['nama_responden'];

        $validated['jabatan_narasumber'] =
            $validated['status_responden'];

        $validated['nama_pewawancara'] =
            $validated['nama_petugas_monev'];

        $validated['status'] = 'Selesai';

        return $validated;
    }

    /**
     * Menyimpan wawancara BK.
     */

    public function storeBk(Request $request)
    {
        $validated = $request->validate([
            // Identitas petugas Monev
            'nama_petugas_monev' => ['required', 'string', 'max:255'],
            'instansi_petugas' => ['nullable', 'string', 'max:255'],
            'lokasi_monev' => ['nullable', 'string', 'max:255'],
            'tanggal_wawancara' => ['required', 'date'],

            // Identitas responden
            'nama_responden' => ['required', 'string', 'max:255'],
            'jabatan' => [
                'required',
                'string',
                Rule::in([
                    'BK',
                    'Kepala Sekolah',
                    'Rekan Sejawat',
                    'Peserta Didik',
                ]),
            ],
            'satuan_pendidikan' => ['required', 'string', 'max:255'],
            'masa_kerja' => ['required', 'numeric', 'min:0', 'max:100'],
            'nama_kegiatan' => ['required', 'string', 'max:255'],
            'tanggal_pengisian' => ['required', 'date'],

            // Jawaban wawancara
            'jawaban_wawancara' => ['required', 'array'],
            'jawaban_wawancara.1' => ['required', 'string'],
            'jawaban_wawancara.2' => ['required', 'string'],
            'jawaban_wawancara.3' => ['required', 'string'],
        ]);

        $namaPetugas = $validated['nama_petugas_monev'];
        $namaResponden = $validated['nama_responden'];
        $tanggal = $validated['tanggal_wawancara'];

        $instansiPetugas = $validated['instansi_petugas'] ?? '-';
        $satuanPendidikan = $validated['satuan_pendidikan'];

        // Metadata tambahan disimpan dalam JSON.
        $metadata = [
            'instansi_petugas' => $instansiPetugas,
            'lokasi_monev' => $validated['lokasi_monev'] ?? null,
            'jabatan' => $validated['jabatan'],
            'satuan_pendidikan' => $satuanPendidikan,
            'masa_kerja' => $validated['masa_kerja'],
            'nama_kegiatan' => $validated['nama_kegiatan'],
            'tanggal_pengisian' => $validated['tanggal_pengisian'],
        ];

        Wawancara::create([
            'jenis_wawancara' => 'BK',
            'instrumen_id' => null,

            'sekolah_id' => SekolahResolver::resolve(
                $satuanPendidikan
            )?->id,

            'tanggal_wawancara' => $tanggal,
            'tanggal_evaluasi' => $tanggal,
            'status' => 'Selesai',

            // Identitas petugas Monev
            'nama_petugas_monev' => $namaPetugas,
            'unit_kerja_petugas' => $instansiPetugas,
            'nama_pewawancara' => $namaPetugas,

            // Identitas responden pada kolom yang tersedia
            'nama_responden' => $namaResponden,
            'unit_kerja_responden' => $satuanPendidikan,
            'status_responden' => $validated['jabatan'],

            // Kompatibilitas dengan kolom lama
            'nama_narasumber' => $namaResponden,
            'jabatan_narasumber' => $validated['jabatan'],

            // Tiga jawaban wawancara
            'jawaban_1' => $validated['jawaban_wawancara'][1],
            'jawaban_2' => $validated['jawaban_wawancara'][2],
            'jawaban_3' => $validated['jawaban_wawancara'][3],

            'hasil_wawancara' => json_encode(
                $metadata,
                JSON_UNESCAPED_UNICODE
            ),
        ]);

        return redirect()
            ->route('wawancara.index')
            ->with('success', 'Data wawancara BK berhasil disimpan.');
    }


    /**
     * Menampilkan detail wawancara.
     */

    public function show(Wawancara $wawancara)
    {
        $wawancara->load([
            'instrumen',
            'sekolah',
            'tindakLanjut',
        ]);

        $jenis = strtoupper(trim($wawancara->jenis_wawancara ?? ''));

        // Detail wawancara Matematika GEMBIRA.
        if ($jenis === 'GEMBIRA') {
            $metadata = json_decode(
                $wawancara->hasil_wawancara ?? '{}',
                true
            );

            if (!is_array($metadata)) {
                $metadata = [];
            }

            return view(
                'wawancara.show-gembira',
                compact('wawancara', 'metadata')
            );
        }

        // Detail TENDIK.
        if ($jenis === 'TENDIK') {
            return view('wawancara.show-tendik', compact('wawancara'));
        }

        // Detail BK.
        if ($jenis === 'BK') {
            return view('wawancara.show-bk', compact('wawancara'));
        }

        // Detail BCKS dan wawancara lama.
        return view('wawancara.show', compact('wawancara'));
    }


    /**
     * Form edit wawancara.
     */
    public function edit(Wawancara $wawancara)
    {
        $wawancara->load([
            'instrumen',
            'sekolah',
            'tindakLanjut',
        ]);

        $jenis = strtoupper(trim($wawancara->jenis_wawancara ?? ''));
        if ($jenis === 'GEMBIRA') {
            $metadata = json_decode(
                $wawancara->hasil_wawancara ?? '{}',
                true
            );

            if (!is_array($metadata)) {
                $metadata = [];
            }

            return view(
                'wawancara.edit-gembira',
                compact('wawancara', 'metadata')
            );
        }
        // Form edit TENDIK.
        if ($jenis === 'TENDIK') {
            $metadata = json_decode(
                $wawancara->hasil_wawancara ?? '{}',
                true
            );

            if (!is_array($metadata)) {
                $metadata = [];
            }

            return view(
                'wawancara.edit-tendik',
                compact('wawancara', 'metadata')
            );
        }

        // Form edit BK.
        if ($jenis === 'BK') {
            return view('wawancara.edit-bk', compact('wawancara'));
        }

        // Form edit BCKS dan wawancara lama.
        $instrumens = Instrumen::orderBy('nama_instrumen')->get();
        $sekolahs = Sekolah::orderBy('nama_sekolah')->get();

        return view('wawancara.edit', compact(
            'wawancara',
            'instrumens',
            'sekolahs'
        ));

    }

    /**
     * Memperbarui data wawancara.
     */

    public function update(Request $request, Wawancara $wawancara)
    {
        $jenis = strtoupper(trim($wawancara->jenis_wawancara ?? ''));

        if ($jenis === 'GEMBIRA') {
            $validated = $request->validate([
                'nama_guru' => ['required', 'string', 'max:255'],
                'nama_sekolah' => ['required', 'string', 'max:255'],
                'kelas_fase' => ['nullable', 'string', 'max:255'],
                'topik_materi' => ['nullable', 'string', 'max:255'],

                'nama_petugas_monev' => ['required', 'string', 'max:255'],
                'jabatan_penilai' => [
                    'required',
                    'string',
                    'in:Peserta Matematika GEMBIRA,Rekan sejawat,Atasan langsung/Kepala Sekolah',
                ],
                'tanggal_monev' => ['required', 'date'],
                'sumber_data_bukti' => ['nullable', 'string'],
                'catatan' => ['nullable', 'string'],

                'jawaban_1' => ['required', 'string'],
                'jawaban_2' => ['required', 'string'],
                'jawaban_3' => ['required', 'string'],
                'jawaban_4' => ['required', 'string'],
                'jawaban_5_a' => ['required', 'string'],
                'jawaban_5_b' => ['required', 'string'],
                'jawaban_5_c' => ['required', 'string'],
                'jawaban_5_d' => ['required', 'string'],
                'jawaban_5_e' => ['required', 'string'],
                'jawaban_6' => ['required', 'string'],
                'jawaban_7' => ['required', 'string'],
            ]);

            // Ambil metadata sebelumnya agar informasi yang tidak diubah tetap terjaga.
            $metadata = json_decode(
                $wawancara->hasil_wawancara ?? '{}',
                true
            );

            if (!is_array($metadata)) {
                $metadata = [];
            }

            $jawabanTerbuka = [
                '1' => $validated['jawaban_1'],
                '2' => $validated['jawaban_2'],
                '3' => $validated['jawaban_3'],
                '4' => $validated['jawaban_4'],
                '5' => [
                    'a' => $validated['jawaban_5_a'],
                    'b' => $validated['jawaban_5_b'],
                    'c' => $validated['jawaban_5_c'],
                    'd' => $validated['jawaban_5_d'],
                    'e' => $validated['jawaban_5_e'],
                ],
                '6' => $validated['jawaban_6'],
                '7' => $validated['jawaban_7'],
            ];

            $metadata = array_merge($metadata, [
                'program' => 'Matematika GEMBIRA',
                'nama_guru' => $validated['nama_guru'],
                'nama_sekolah' => $validated['nama_sekolah'],
                'kelas_fase' => $validated['kelas_fase'] ?? null,
                'topik_materi' => $validated['topik_materi'] ?? null,
                'jabatan_penilai' => $validated['jabatan_penilai'],
                'tanggal_monev' => $validated['tanggal_monev'],
                'sumber_data_bukti' => $validated['sumber_data_bukti'] ?? null,
                'jawaban_terbuka' => $jawabanTerbuka,
            ]);

            $sekolah = SekolahResolver::resolve($validated['nama_sekolah']);

            $wawancara->update([
                'jenis_wawancara' => 'GEMBIRA',
                'sekolah_id' => $sekolah?->id,
                'tanggal_wawancara' => $validated['tanggal_monev'],
                'tanggal_evaluasi' => $validated['tanggal_monev'],
                'status' => 'Selesai',

                'nama_petugas_monev' => $validated['nama_petugas_monev'],
                'nama_pewawancara' => $validated['nama_petugas_monev'],
                'nama_responden' => $validated['nama_guru'],
                'unit_kerja_responden' => $validated['nama_sekolah'],
                'status_responden' => $validated['jabatan_penilai'],
                'nama_narasumber' => $validated['nama_guru'],
                'jabatan_narasumber' => $validated['jabatan_penilai'],

                'jawaban_1' => $validated['jawaban_1'],
                'jawaban_2' => $validated['jawaban_2'],
                'jawaban_3' => $validated['jawaban_3'],
                'jawaban_4' => $validated['jawaban_4'],
                'jawaban_5' => json_encode(
                    $jawabanTerbuka['5'],
                    JSON_UNESCAPED_UNICODE
                ),

                'hasil_wawancara' => json_encode(
                    $metadata,
                    JSON_UNESCAPED_UNICODE
                ),
                'catatan' => $validated['catatan'] ?? null,
            ]);

            return redirect()
                ->route('wawancara.show', $wawancara->id)
                ->with('success', 'Wawancara Matematika GEMBIRA berhasil diperbarui.');
        }

        /*
        |--------------------------------------------------------------------------
        | 1. UPDATE WAWANCARA TENDIK
        |--------------------------------------------------------------------------
        */
        if ($jenis === 'TENDIK') {
            $validated = $request->validate([
                'nama_petugas_monev' => ['required', 'string', 'max:255'],
                'instansi_petugas' => ['required', 'string', 'max:255'],
                'lokasi_monev' => ['required', 'string', 'max:255'],
                'tanggal_pengisian' => ['required', 'date'],

                'nama_responden' => ['required', 'string', 'max:255'],
                'jabatan_responden' => [
                    'required',
                    'string',
                    'in:Tendik,Operator,Bendahara,Kepala Sekolah,Rekan Sejawat/Guru',
                ],
                'jabatan_lainnya' => [
                    'required_if:jabatan_responden,Lainnya',
                    'nullable',
                    'string',
                    'max:255',
                ],

                'satuan_pendidikan' => ['required', 'string', 'max:255'],
                'masa_kerja' => ['required', 'numeric', 'min:0', 'max:100'],
                'nama_pelatihan' => ['required', 'string', 'max:255'],

                'jawaban_1' => ['required', 'string'],
                'jawaban_2' => ['required', 'string'],
                'jawaban_3' => ['required', 'string'],
                'jawaban_4' => ['required', 'string'],
                'jawaban_5' => ['required', 'string'],
            ], [
                'jabatan_lainnya.required_if' => 'Tuliskan jabatan lainnya.',
            ]);

            $jabatanFinal = $validated['jabatan_responden'] === 'Lainnya'
                ? trim($validated['jabatan_lainnya'])
                : $validated['jabatan_responden'];

            // Ambil metadata lama agar informasi lain tidak hilang.
            $metadata = json_decode(
                $wawancara->hasil_wawancara ?? '{}',
                true
            );

            if (!is_array($metadata)) {
                $metadata = [];
            }

            // Perbarui metadata identitas TENDIK.
            $metadata = array_merge($metadata, [
                'instansi_petugas' => $validated['instansi_petugas'],
                'lokasi_monev' => $validated['lokasi_monev'],
                'tanggal_pengisian' => $validated['tanggal_pengisian'],

                'jabatan_responden' => $validated['jabatan_responden'],
                'jabatan_lainnya' => $validated['jabatan_responden'] === 'Lainnya'
                    ? trim($validated['jabatan_lainnya'])
                    : null,

                'satuan_pendidikan' => $validated['satuan_pendidikan'],
                'masa_kerja' => $validated['masa_kerja'],
                'nama_pelatihan' => $validated['nama_pelatihan'],
            ]);

            $tanggal = $validated['tanggal_pengisian'];
            $satuanPendidikan = $validated['satuan_pendidikan'];

            $wawancara->update([
                'jenis_wawancara' => 'TENDIK',

                'tanggal_wawancara' => $tanggal,
                'tanggal_evaluasi' => $tanggal,
                'status' => 'Selesai',

                // Identitas petugas.
                'nama_petugas_monev' => $validated['nama_petugas_monev'],
                'unit_kerja_petugas' => $validated['instansi_petugas'],
                'nama_pewawancara' => $validated['nama_petugas_monev'],

                // Identitas responden.
                'nama_responden' => $validated['nama_responden'],
                'unit_kerja_responden' => $satuanPendidikan,
                'status_responden' => $jabatanFinal,

                // Sinkronisasi kolom lama.
                'nama_narasumber' => $validated['nama_responden'],
                'jabatan_narasumber' => $jabatanFinal,

                // Lima jawaban wawancara.
                'jawaban_1' => $validated['jawaban_1'],
                'jawaban_2' => $validated['jawaban_2'],
                'jawaban_3' => $validated['jawaban_3'],
                'jawaban_4' => $validated['jawaban_4'],
                'jawaban_5' => $validated['jawaban_5'],

                // Simpan metadata identitas dan data tambahan.
                'hasil_wawancara' => json_encode(
                    $metadata,
                    JSON_UNESCAPED_UNICODE
                ),
            ]);

            // Sinkronkan sekolah jika satuan pendidikan ditemukan.
            $sekolah = SekolahResolver::resolve($satuanPendidikan);

            if ($sekolah) {
                $wawancara->update([
                    'sekolah_id' => $sekolah->id,
                ]);
            }

            return redirect()
                ->route('wawancara.show', $wawancara->id)
                ->with(
                    'success',
                    'Data wawancara TENDIK berhasil diperbarui.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | 2. UPDATE WAWANCARA BK
        |--------------------------------------------------------------------------
        */
        if ($jenis === 'BK') {
            $validated = $request->validate([
                'tanggal_wawancara' => ['required', 'date'],

                'nama_responden' => ['required', 'string', 'max:255'],
                'jabatan' => ['required', 'string', 'max:255'],
                'satuan_pendidikan' => ['required', 'string', 'max:255'],
                'masa_kerja' => ['required', 'numeric', 'min:0', 'max:100'],
                'nama_kegiatan' => ['required', 'string', 'max:255'],
                'tanggal_pengisian' => ['required', 'date'],

                'nama_petugas_monev' => ['required', 'string', 'max:255'],
                'instansi_petugas' => ['nullable', 'string', 'max:255'],
                'lokasi_monev' => ['nullable', 'string', 'max:255'],

                'jawaban_wawancara' => ['required', 'array'],
                'jawaban_wawancara.1' => ['required', 'string'],
                'jawaban_wawancara.2' => ['required', 'string'],
                'jawaban_wawancara.3' => ['required', 'string'],
            ]);

            $metadata = json_decode(
                $wawancara->hasil_wawancara ?? '{}',
                true
            );

            if (!is_array($metadata)) {
                $metadata = [];
            }

            $instansiPetugas = $validated['instansi_petugas'] ?? '-';
            $satuanPendidikan = $validated['satuan_pendidikan'];
            $namaResponden = $validated['nama_responden'];
            $namaPetugas = $validated['nama_petugas_monev'];
            $tanggal = $validated['tanggal_wawancara'];

            $metadata = array_merge($metadata, [
                'instansi_petugas' => $instansiPetugas,
                'lokasi_monev' => $validated['lokasi_monev'] ?? null,
                'jabatan' => $validated['jabatan'],
                'satuan_pendidikan' => $satuanPendidikan,
                'masa_kerja' => $validated['masa_kerja'],
                'nama_kegiatan' => $validated['nama_kegiatan'],
                'tanggal_pengisian' => $validated['tanggal_pengisian'],
            ]);

            $wawancara->update([
                'tanggal_wawancara' => $tanggal,
                'tanggal_evaluasi' => $tanggal,
                'status' => 'Selesai',

                'nama_petugas_monev' => $namaPetugas,
                'unit_kerja_petugas' => $instansiPetugas,
                'nama_pewawancara' => $namaPetugas,

                'nama_responden' => $namaResponden,
                'unit_kerja_responden' => $satuanPendidikan,
                'status_responden' => $validated['jabatan'],

                'nama_narasumber' => $namaResponden,
                'jabatan_narasumber' => $validated['jabatan'],

                'jawaban_1' => $validated['jawaban_wawancara'][1],
                'jawaban_2' => $validated['jawaban_wawancara'][2],
                'jawaban_3' => $validated['jawaban_wawancara'][3],

                'hasil_wawancara' => json_encode(
                    $metadata,
                    JSON_UNESCAPED_UNICODE
                ),
            ]);

            $sekolah = SekolahResolver::resolve($satuanPendidikan);

            if ($sekolah) {
                $wawancara->update(['sekolah_id' => $sekolah->id]);
            }

            return redirect()
                ->route('wawancara.show', $wawancara->id)
                ->with('success', 'Data wawancara BK berhasil diperbarui.');
        }

        /*
        |--------------------------------------------------------------------------
        | 3. UPDATE WAWANCARA BCKS
        |--------------------------------------------------------------------------
        */
        $fieldBcks = [
            'nama_bcks',
            'unit_kerja_bcks',
            'angkatan_pelatihan_bcks',
            'nama_responden',
            'unit_kerja_responden',
            'status_responden',
            'nama_petugas_monev',
            'unit_kerja_petugas',
            'jawaban_1',
            'jawaban_2',
            'jawaban_3',
            'jawaban_4',
            'jawaban_5',
        ];

        $isBcks = $jenis === 'BCKS';

        if (!$isBcks) {
            foreach ($fieldBcks as $field) {
                if ($request->exists($field)) {
                    $isBcks = true;
                    break;
                }
            }
        }

        if ($isBcks) {
            $validated = $request->validate([
                'nama_bcks' => ['required', 'string', 'max:255'],
                'unit_kerja_bcks' => ['required', 'string', 'max:255'],
                'angkatan_pelatihan_bcks' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'nama_responden' => ['required', 'string', 'max:255'],
                'unit_kerja_responden' => [
                    'required',
                    'string',
                    'max:255',
                ],
                'status_responden' => [
                    'required',
                    'string',
                    Rule::in([
                        'BCKS',
                        'Atasan Langsung / Pengawas Sekolah',
                        'Perwakilan Guru / Tenaga Kependidikan',
                    ]),
                ],

                'nama_petugas_monev' => [
                    'required',
                    'string',
                    'max:255',
                ],
                'unit_kerja_petugas' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'tanggal_evaluasi' => ['sometimes', 'required', 'date'],

                'jawaban_1' => ['nullable', 'string'],
                'jawaban_2' => ['nullable', 'string'],
                'jawaban_3' => ['nullable', 'string'],
                'jawaban_4' => ['nullable', 'string'],
                'jawaban_5' => ['nullable', 'string'],

                'hasil_wawancara' => ['nullable', 'string'],
                'catatan' => ['nullable', 'string'],
            ]);

            $validated['instrumen_id'] = $wawancara->instrumen_id;
            $validated['sekolah_id'] = $wawancara->sekolah_id;

            $tanggalEvaluasi = $validated['tanggal_evaluasi']
                ?? $wawancara->tanggal_evaluasi
                ?? $wawancara->tanggal_wawancara;

            if ($tanggalEvaluasi instanceof \DateTimeInterface) {
                $tanggalEvaluasi = $tanggalEvaluasi->format('Y-m-d');
            }

            $validated['tanggal_evaluasi'] = $tanggalEvaluasi;
            $validated['tanggal_wawancara'] = $tanggalEvaluasi;
            $validated['status'] = 'Selesai';
            $validated['jenis_wawancara'] = 'BCKS';

            $validated['nama_narasumber'] = $validated['nama_responden'];
            $validated['jabatan_narasumber'] = $validated['status_responden'];
            $validated['nama_pewawancara'] = $validated['nama_petugas_monev'];

            $wawancara->update($validated);

            return redirect()
                ->route('wawancara.show', $wawancara->id)
                ->with(
                    'success',
                    'Data wawancara BCKS berhasil diperbarui.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | 4. UPDATE WAWANCARA LAMA
        |--------------------------------------------------------------------------
        */
        $validated = $request->validate([
            'instrumen_id' => [
                'required',
                'integer',
                Rule::exists('instrumens', 'id'),
            ],
            'sekolah_id' => [
                'required',
                'integer',
                Rule::exists('sekolahs', 'id'),
            ],
            'tanggal_wawancara' => ['required', 'date'],
            'nama_narasumber' => ['required', 'string', 'max:255'],
            'jabatan_narasumber' => ['nullable', 'string', 'max:255'],
            'nama_pewawancara' => ['required', 'string', 'max:255'],
            'status' => [
                'required',
                Rule::in(['Belum Dilaksanakan', 'Selesai']),
            ],
            'hasil_wawancara' => ['nullable', 'string'],
            'catatan' => ['nullable', 'string'],
        ]);

        $wawancara->update($validated);

        return redirect()
            ->route('wawancara.show', $wawancara->id)
            ->with(
                'success',
                'Data wawancara berhasil diperbarui.'
            );
    }
    public function cetakBcks(\App\Models\Wawancara $wawancara)
    {
        abort_unless(
            strtoupper(trim($wawancara->jenis_wawancara ?? '')) === 'BCKS',
            404
        );

        return view('wawancara.cetak-bcks', compact('wawancara'));
    }

    public function cetak(Wawancara $wawancara)
    {
        $jenis = strtoupper(trim($wawancara->jenis_wawancara ?? ''));
        if ($jenis === 'GEMBIRA') {
            $metadata = json_decode(
                $wawancara->hasil_wawancara ?? '{}',
                true
            );

            if (!is_array($metadata)) {
                $metadata = [];
            }

            return view(
                'wawancara.cetak-gembira',
                compact('wawancara', 'metadata')
            );
        }
        if ($jenis === 'TENDIK') {
            $metadata = json_decode(
                $wawancara->hasil_wawancara ?? '{}',
                true
            );

            if (!is_array($metadata)) {
                $metadata = [];
            }

            return view(
                'wawancara.cetak-tendik',
                compact('wawancara', 'metadata')
            );
        }

        if ($jenis === 'BK') {
            return view('wawancara.cetak-bk', compact('wawancara'));
        }

        abort(404);
    }

    /**
     * Menghapus wawancara.
     */
    public function destroy(Wawancara $wawancara)
    {
        $wawancara->delete();

        return redirect()
            ->route('wawancara.index')
            ->with('success', 'Data wawancara berhasil dihapus.');
    }
}