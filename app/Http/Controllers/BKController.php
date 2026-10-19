<?php

namespace App\Http\Controllers;

use App\Models\BKQuestion;
use App\Models\BKSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Support\SekolahResolver;

class BKController extends Controller
{
    /**
     * =========================================================
     * RIWAYAT PENGISIAN BK
     * =========================================================
     */
    public function index()
    {
        $submissions = BKSubmission::latest()
            ->paginate(10);

        return view(
            'bk.index',
            compact('submissions')
        );
    }
    /**
     * =========================================================
     * FORM PENGISIAN INSTRUMEN BK
     * =========================================================
     */
    public function create()
    {
        $questions = BKQuestion::where('aktif', true)
            ->orderBy('urutan')
            ->get();

        return view(
            'bk.create',
            compact('questions')
        );
    }
    /**
     * =========================================================
     * SIMPAN PENGISIAN INSTRUMEN BK
     * =========================================================
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | AMBIL SEMUA PERTANYAAN AKTIF
        |--------------------------------------------------------------------------
        */
        $questions = BKQuestion::where('aktif', true)
            ->orderBy('urutan')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | VALIDASI DATA
        |--------------------------------------------------------------------------
        */
        $validated = $request->validate([

            'nama_petugas_monev' => [
                'required',
                'string',
                'max:255',
            ],
            'instansi_petugas' => [
                'nullable',
                'string',
                'max:255',
            ],
            'lokasi_monev' => [
                'nullable',
                'string',
                'max:255',
            ],
            'tanggal_pelaksanaan' => [
                'nullable',
                'date',
            ],
            'nama_responden' => [
                'required',
                'string',
                'max:255',
            ],
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
            'satuan_pendidikan' => [
                'required',
                'string',
                'max:255',
            ],
            'masa_kerja' => [
                'required',
                'integer',
                'min:0',
                'max:100',
            ],
            'nama_pelatihan' => [
                'required',
                'string',
                'max:255',
            ],
            'tanggal_pengisian' => [
                'required',
                'date',
            ],
            'jawaban' => [
                'required',
                'array',
            ],
            'jawaban.*' => [
                'required',
                'in:0,1',
            ],

            'essay' => [
                'nullable',
                'array',
            ],

            'essay.*.pertanyaan' => [
                'nullable',
                'string',
            ],

            'essay.*.jawaban' => [
                'nullable',
                'string',
            ],

        ]);
        /*
        |--------------------------------------------------------------------------
        | PASTIKAN SEMUA INDIKATOR DIJAWAB
        |--------------------------------------------------------------------------
        */
        foreach ($questions as $question) {
            if (
                !array_key_exists(
                    $question->id,
                    $validated['jawaban']
                )
            ) {
                return back()
                    ->withErrors([
                        'jawaban' =>
                            "Pernyataan nomor {$question->nomor} belum dijawab.",
                    ])
                    ->withInput();
            }
        }
        /*
        |--------------------------------------------------------------------------
        | SIMPAN SEMUA DATA DALAM TRANSAKSI
        |--------------------------------------------------------------------------
        */
        $submission = DB::transaction(function () use ($validated, $questions) {
            /*
            |--------------------------------------------------------------------------
            | HITUNG JUMLAH SOAL
            |--------------------------------------------------------------------------
            */
            $jumlahSoal = $questions->count();
            /*
            |--------------------------------------------------------------------------
            | HITUNG JAWABAN YA
            |--------------------------------------------------------------------------
            */
            $jumlahYa = collect(
                $validated['jawaban']
            )
                ->filter(
                    fn($jawaban) =>
                        (string) $jawaban === '1'
                )
                ->count();
            /*
            |--------------------------------------------------------------------------
            | HITUNG JAWABAN TIDAK
            |--------------------------------------------------------------------------
            */
            $jumlahTidak =
                $jumlahSoal - $jumlahYa;
            /*
            |--------------------------------------------------------------------------
            | HITUNG NILAI AKHIR
            |--------------------------------------------------------------------------
            |
            | Ya     = 1
            | Tidak  = 0
            |
            | Nilai = jumlah Ya / jumlah soal × 100
            |--------------------------------------------------------------------------
            */

            $skorPersentase = $jumlahSoal > 0
                ? round(
                    ($jumlahYa / $jumlahSoal) * 100,
                    2
                )
                : 0;
            /*
            |--------------------------------------------------------------------------
            | TENTUKAN KATEGORI
            |--------------------------------------------------------------------------
            */
            $kategori = $skorPersentase >= 50
                ? 'Baik / Kategori Tinggi'
                : 'Kurang / Kategori Rendah';
            /*
            |--------------------------------------------------------------------------
            | SIMPAN DATA PENGISIAN
            |--------------------------------------------------------------------------
            */
            $submission = BKSubmission::create([
                'sekolah_id' => SekolahResolver::resolve(
                    $validated['satuan_pendidikan'] ?? null
                )?->id,

                'nama_petugas_monev' =>
                    $validated['nama_petugas_monev'],

                'instansi_petugas' =>
                    $validated['instansi_petugas'] ?? null,

                'lokasi_monev' =>
                    $validated['lokasi_monev'] ?? null,

                'tanggal_pelaksanaan' =>
                    $validated['tanggal_pelaksanaan'] ?? null,

                'nama_responden' =>
                    $validated['nama_responden'],

                'jabatan_responden' =>
                    $validated['jabatan_responden'],

                'jabatan_lainnya' =>
                    $validated['jabatan_lainnya'] ?? null,

                'satuan_pendidikan' =>
                    $validated['satuan_pendidikan'],

                'masa_kerja' =>
                    $validated['masa_kerja'],

                'nama_pelatihan' =>
                    $validated['nama_pelatihan'],

                'tanggal_pengisian' =>
                    $validated['tanggal_pengisian'],

                'jumlah_soal' =>
                    $jumlahSoal,

                'jumlah_ya' =>
                    $jumlahYa,

                'jumlah_tidak' =>
                    $jumlahTidak,

                'skor_persentase' =>
                    $skorPersentase,

                'kategori' =>
                    $kategori,

                'status' =>
                    'Selesai',

            ]);
            /*
            |--------------------------------------------------------------------------
            | SIMPAN JAWABAN YA / TIDAK
            |--------------------------------------------------------------------------
            */
            foreach ($questions as $question) {

                $submission->answers()->create([

                    'bk_question_id' =>
                        $question->id,

                    'jawaban' =>
                        (string) 
                        $validated['jawaban'][$question->id]
                        === '1',
                ]);
            }
            /*
            |--------------------------------------------------------------------------
            | SIMPAN JAWABAN URAIAN
            |--------------------------------------------------------------------------
            */
            if (
                !empty($validated['essay'])
                && is_array($validated['essay'])
            ) {
                foreach (
                    $validated['essay']
                    as $nomor => $essay
                ) {
                    /*
                    |--------------------------------------------------------------------------
                    | LEWATI JIKA KOSONG
                    |--------------------------------------------------------------------------
                    */
                    if (
                        empty($essay['pertanyaan'])
                        && empty($essay['jawaban'])
                    ) {
                        continue;
                    }
                    /*
                    |--------------------------------------------------------------------------
                    | SIMPAN ESSAY
                    |--------------------------------------------------------------------------
                    */

                    $submission->essayAnswers()->create([

                        'nomor' =>
                            (int) $nomor,

                        'pertanyaan' =>
                            $essay['pertanyaan'] ?? '',

                        'jawaban' =>
                            $essay['jawaban'] ?? null,

                    ]);

                }

            }


            return $submission;

        });


        /*
        |--------------------------------------------------------------------------
        | LANGSUNG KE HALAMAN HASIL PENILAIAN BK
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'bk.show',
                $submission
            )
            ->with(
                'success',
                'Pengisian instrumen BK berhasil disimpan.'
            );
    }


    /**
     * =========================================================
     * FORM EDIT PENGISIAN BK
     * =========================================================
     */
    public function edit(BKSubmission $submission)
    {
        /*
        |--------------------------------------------------------------------------
        | LOAD DATA LAMA
        |--------------------------------------------------------------------------
        */

        $submission->load([
            'answers.question',
            'essayAnswers',
        ]);


        /*
        |--------------------------------------------------------------------------
        | AMBIL SEMUA PERTANYAAN AKTIF
        |--------------------------------------------------------------------------
        */

        $questions = BKQuestion::where('aktif', true)
            ->orderBy('urutan')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | SUSUN JAWABAN BERDASARKAN ID PERTANYAAN
        |--------------------------------------------------------------------------
        */

        $answers = $submission->answers
            ->keyBy('bk_question_id');


        /*
        |--------------------------------------------------------------------------
        | SUSUN ESSAY BERDASARKAN NOMOR
        |--------------------------------------------------------------------------
        */

        $essayAnswers = $submission->essayAnswers
            ->keyBy('nomor');


        /*
        |--------------------------------------------------------------------------
        | TAMPILKAN FORM EDIT
        |--------------------------------------------------------------------------
        */

        return view(
            'bk.edit',
            compact(
                'submission',
                'questions',
                'answers',
                'essayAnswers'
            )
        );
    }


    /**
     * =========================================================
     * UPDATE PENGISIAN BK
     * =========================================================
     */
    public function update(
        Request $request,
        BKSubmission $submission
    ) {

        /*
        |--------------------------------------------------------------------------
        | AMBIL SEMUA PERTANYAAN AKTIF
        |--------------------------------------------------------------------------
        */

        $questions = BKQuestion::where('aktif', true)
            ->orderBy('urutan')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | VALIDASI DATA
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'nama_petugas_monev' => [
                'required',
                'string',
                'max:255',
            ],

            'instansi_petugas' => [
                'nullable',
                'string',
                'max:255',
            ],

            'lokasi_monev' => [
                'nullable',
                'string',
                'max:255',
            ],

            'tanggal_pelaksanaan' => [
                'nullable',
                'date',
            ],

            'nama_responden' => [
                'required',
                'string',
                'max:255',
            ],

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

            'satuan_pendidikan' => [
                'required',
                'string',
                'max:255',
            ],

            'masa_kerja' => [
                'required',
                'integer',
                'min:0',
                'max:100',
            ],

            'nama_pelatihan' => [
                'required',
                'string',
                'max:255',
            ],

            'tanggal_pengisian' => [
                'required',
                'date',
            ],

            'jawaban' => [
                'required',
                'array',
            ],

            'jawaban.*' => [
                'required',
                'in:0,1',
            ],

            'essay' => [
                'nullable',
                'array',
            ],

            'essay.*.pertanyaan' => [
                'nullable',
                'string',
            ],

            'essay.*.jawaban' => [
                'nullable',
                'string',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN SEMUA INDIKATOR DIJAWAB
        |--------------------------------------------------------------------------
        */

        foreach ($questions as $question) {

            if (
                !array_key_exists(
                    $question->id,
                    $validated['jawaban']
                )
            ) {

                return back()
                    ->withErrors([
                        'jawaban' =>
                            "Pernyataan nomor {$question->nomor} belum dijawab.",
                    ])
                    ->withInput();

            }

        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE DALAM TRANSAKSI
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use ($validated, $questions, $submission) {

            /*
            |--------------------------------------------------------------------------
            | HITUNG ULANG HASIL
            |--------------------------------------------------------------------------
            */

            $jumlahSoal = $questions->count();


            $jumlahYa = collect(
                $validated['jawaban']
            )
                ->filter(
                    fn($jawaban) =>
                        (string) $jawaban === '1'
                )
                ->count();


            $jumlahTidak =
                $jumlahSoal - $jumlahYa;


            $skorPersentase = $jumlahSoal > 0
                ? round(
                    ($jumlahYa / $jumlahSoal) * 100,
                    2
                )
                : 0;


            $kategori = $skorPersentase >= 50
                ? 'Baik / Kategori Tinggi'
                : 'Kurang / Kategori Rendah';


            /*
            |--------------------------------------------------------------------------
            | UPDATE DATA UTAMA
            |--------------------------------------------------------------------------
            */

            $submission->update([

                'nama_petugas_monev' =>
                    $validated['nama_petugas_monev'],

                'instansi_petugas' =>
                    $validated['instansi_petugas'] ?? null,

                'lokasi_monev' =>
                    $validated['lokasi_monev'] ?? null,

                'tanggal_pelaksanaan' =>
                    $validated['tanggal_pelaksanaan'] ?? null,

                'nama_responden' =>
                    $validated['nama_responden'],

                'jabatan_responden' =>
                    $validated['jabatan_responden'],

                'jabatan_lainnya' =>
                    $validated['jabatan_lainnya'] ?? null,

                'satuan_pendidikan' =>
                    $validated['satuan_pendidikan'],

                'masa_kerja' =>
                    $validated['masa_kerja'],

                'nama_pelatihan' =>
                    $validated['nama_pelatihan'],

                'tanggal_pengisian' =>
                    $validated['tanggal_pengisian'],

                'jumlah_soal' =>
                    $jumlahSoal,

                'jumlah_ya' =>
                    $jumlahYa,

                'jumlah_tidak' =>
                    $jumlahTidak,

                'skor_persentase' =>
                    $skorPersentase,

                'kategori' =>
                    $kategori,

                'status' =>
                    'Selesai',

            ]);


            /*
            |--------------------------------------------------------------------------
            | UPDATE JAWABAN YA / TIDAK
            |--------------------------------------------------------------------------
            */

            foreach ($questions as $question) {

                $submission->answers()->updateOrCreate(

                    [
                        'bk_question_id' =>
                            $question->id,
                    ],

                    [
                        'jawaban' =>
                            (string) 
                            $validated['jawaban'][$question->id]
                            === '1',
                    ]

                );

            }


            /*
            |--------------------------------------------------------------------------
            | HAPUS ESSAY LAMA
            |--------------------------------------------------------------------------
            |
            | Kemudian kita simpan kembali essay terbaru.
            |--------------------------------------------------------------------------
            */

            $submission->essayAnswers()->delete();


            /*
            |--------------------------------------------------------------------------
            | SIMPAN ESSAY TERBARU
            |--------------------------------------------------------------------------
            */

            if (
                !empty($validated['essay'])
                && is_array($validated['essay'])
            ) {

                foreach (
                    $validated['essay']
                    as $nomor => $essay
                ) {

                    if (
                        empty($essay['pertanyaan'])
                        && empty($essay['jawaban'])
                    ) {
                        continue;
                    }


                    $submission->essayAnswers()->create([

                        'nomor' =>
                            (int) $nomor,

                        'pertanyaan' =>
                            $essay['pertanyaan'] ?? '',

                        'jawaban' =>
                            $essay['jawaban'] ?? null,

                    ]);

                }

            }

        });


        /*
        |--------------------------------------------------------------------------
        | KEMBALI KE HASIL BK
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'bk.show',
                $submission
            )
            ->with(
                'success',
                'Data pengisian BK berhasil diperbarui.'
            );
    }

    /**
     * =========================================================
     * HAPUS DATA BK
     * =========================================================
     */
    public function destroy(BKSubmission $submission)
    {
        $submission->delete();

        return redirect()
            ->route('instrumen.index')
            ->with('success', 'Data BK berhasil dihapus.');
    }
    /**
     * =========================================================
     * HASIL PENILAIAN BK
     * =========================================================
     */
    public function show(BKSubmission $submission)
    {
        /*
        |--------------------------------------------------------------------------
        | LOAD RELASI
        |--------------------------------------------------------------------------
        */

        $submission->load([
            'answers.question',
            'essayAnswers',
        ]);


        /*
        |--------------------------------------------------------------------------
        | URUTKAN JAWABAN SESUAI URUTAN INSTRUMEN
        |--------------------------------------------------------------------------
        */

        $answers = $submission->answers
            ->sortBy(function ($answer) {

                return $answer->question?->urutan ?? 999999;

            })
            ->values();


        /*
        |--------------------------------------------------------------------------
        | PASANG KEMBALI RELASI ANSWERS
        |--------------------------------------------------------------------------
        */

        $submission->setRelation(
            'answers',
            $answers
        );


        /*
        |--------------------------------------------------------------------------
        | URUTKAN ESSAY
        |--------------------------------------------------------------------------
        */

        $essayAnswers = $submission->essayAnswers
            ->sortBy('nomor')
            ->values();


        $submission->setRelation(
            'essayAnswers',
            $essayAnswers
        );


        /*
        |--------------------------------------------------------------------------
        | TAMPILKAN HASIL
        |--------------------------------------------------------------------------
        */

        return view(
            'bk.show',
            compact('submission')
        );
    }

    /**
     * =========================================================
     * CETAK HASIL PENILAIAN BK
     * =========================================================
     */
    public function cetak(BKSubmission $submission)
    {
        $submission->load([
            'answers.question',
            'essayAnswers',
        ]);

        $answers = $submission->answers
            ->sortBy(function ($answer) {

                return $answer->question?->urutan ?? 999999;
            })
            ->values();
        $submission->setRelation(
            'answers',
            $answers
        );
        return view(
            'bk.cetak',
            compact('submission')
        );
    }
}