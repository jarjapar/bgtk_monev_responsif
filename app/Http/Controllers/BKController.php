<?php

namespace App\Http\Controllers;

use App\Models\BKQuestion;
use App\Models\BKSubmission;
use App\Support\SekolahResolver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class BKController extends Controller
{
    /**
     * Jabatan yang diizinkan.
     */
    private const JABATAN_BK = [
        'BK',
        'Kepala Sekolah',
        'Rekan Sejawat',
        'Peserta Didik',
    ];

    /**
     * Mengambil pertanyaan aktif sesuai jabatan.
     * BK mendapat Level 1-4.
     * Jabatan lainnya mendapat Level 3-4.
     */
    private function getQuestionsForJabatan(string $jabatan)
    {
        $query = BKQuestion::where('aktif', true);

        if ($jabatan !== 'BK') {
            $query->whereIn('level', [3, 4]);
        }

        return $query->orderBy('urutan')->get();
    }

    /**
     * Memastikan jawaban hanya berisi ID pertanyaan yang berlaku.
     */
    private function validateApplicableAnswers(
        Request $request,
        array $validated,
        $questions
    ): array {
        $answers = $validated['jawaban'] ?? [];
        $allowedIds = $questions->pluck('id')
            ->map(fn($id) => (string) $id)
            ->all();

        foreach (array_keys($answers) as $id) {
            if (!in_array((string) $id, $allowedIds, true)) {
                abort(
                    422,
                    'Terdapat jawaban untuk indikator yang tidak berlaku bagi jabatan responden.'
                );
            }
        }

        foreach ($questions as $question) {
            if (!array_key_exists($question->id, $answers)) {
                return back()
                    ->withErrors([
                        'jawaban' =>
                            "Pernyataan nomor {$question->nomor} belum dijawab.",
                    ])
                    ->withInput()
                    ->throwResponse();
            }
        }

        return $answers;
    }

    /**
     * Validasi data utama pengisian.
     */
    private function validationRules(): array
    {
        return [
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
                Rule::in(self::JABATAN_BK),
            ],
            'jabatan_lainnya' => [
                'nullable',
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
                'min:1',
            ],
            'jawaban.*' => [
                'required',
                Rule::in(['0', '1', 0, 1]),
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
        ];
    }

    /**
     * Menghitung skor dari pertanyaan yang berlaku saja.
     */
    private function calculateScore($questions, array $answers): array
    {
        $jumlahSoal = $questions->count();
        $jumlahYa = 0;

        foreach ($questions as $question) {
            if ((string) $answers[$question->id] === '1') {
                $jumlahYa++;
            }
        }

        $jumlahTidak = $jumlahSoal - $jumlahYa;

        $skorPersentase = $jumlahSoal > 0
            ? round(($jumlahYa / $jumlahSoal) * 100, 2)
            : 0;

        $kategori = $skorPersentase >= 50
            ? 'Baik / Kategori Tinggi'
            : 'Kurang / Kategori Rendah';

        return [
            'jumlah_soal' => $jumlahSoal,
            'jumlah_ya' => $jumlahYa,
            'jumlah_tidak' => $jumlahTidak,
            'skor_persentase' => $skorPersentase,
            'kategori' => $kategori,
            'status' => 'Selesai',
        ];
    }

    /**
     * Simpan jawaban indikator yang berlaku.
     */
    private function saveAnswers(
        BKSubmission $submission,
        $questions,
        array $answers,
        bool $update = false
    ): void {
        $allowedIds = $questions->pluck('id')->all();

        foreach ($questions as $question) {
            $data = [
                'jawaban' =>
                    (string) $answers[$question->id] === '1',
            ];

            if ($update) {
                $submission->answers()->updateOrCreate(
                    ['bk_question_id' => $question->id],
                    $data
                );
            } else {
                $submission->answers()->create([
                    'bk_question_id' => $question->id,
                    ...$data,
                ]);
            }
        }

        // Hapus jawaban lama yang tidak lagi berlaku.
        $submission->answers()
            ->whereNotIn('bk_question_id', $allowedIds)
            ->delete();
    }

    /**
     * Simpan jawaban uraian yang dikirimkan.
     */
    private function saveEssays(
        BKSubmission $submission,
        ?array $essays
    ): void {
        $submission->essayAnswers()->delete();

        foreach ($essays ?? [] as $nomor => $essay) {
            if (
                empty($essay['pertanyaan']) &&
                empty($essay['jawaban'])
            ) {
                continue;
            }

            $submission->essayAnswers()->create([
                'nomor' => (int) $nomor,
                'pertanyaan' => $essay['pertanyaan'] ?? '',
                'jawaban' => $essay['jawaban'] ?? null,
            ]);
        }
    }

    /**
     * Riwayat pengisian BK.
     */
    public function index()
    {
        $submissions = BKSubmission::latest()->paginate(10);

        return view('bk.index', compact('submissions'));
    }

    /**
     * Form pengisian BK.
     * Semua pertanyaan dikirim ke view agar pilihan jabatan
     * dapat mengatur visibilitas level melalui JavaScript.
     */
    public function create()
    {
        $questions = BKQuestion::where('aktif', true)
            ->orderBy('urutan')
            ->get();

        return view('bk.create', compact('questions'));
    }

    /**
     * Simpan pengisian baru.
     */

    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules());

        $questions = $this->getQuestionsForJabatan(
            $validated['jabatan_responden']
        );

        $answers = $validated['jawaban'];

        $allowedIds = $questions->pluck('id')
            ->map(fn($id) => (string) $id)
            ->all();


        foreach (array_keys($answers) as $id) {
            if (!in_array((string) $id, $allowedIds, true)) {
                return back()
                    ->withErrors([
                        'jawaban' =>
                            'Terdapat jawaban pada level yang tidak berlaku bagi jabatan ini.',
                    ])
                    ->withInput();
            }
        }

        foreach ($questions as $question) {
            if (!array_key_exists($question->id, $answers)) {
                return back()
                    ->withErrors([
                        'jawaban' =>
                            "Pernyataan nomor {$question->nomor} belum dijawab.",
                    ])
                    ->withInput();
            }
        }

        $submission = DB::transaction(function () use ($validated, $questions, $answers) {
            $score = $this->calculateScore($questions, $answers);

            $submission = BKSubmission::create([
                'sekolah_id' => SekolahResolver::resolve(
                    $validated['satuan_pendidikan'] ?? null
                )?->id,

                'nama_petugas_monev' => $validated['nama_petugas_monev'],
                'instansi_petugas' => $validated['instansi_petugas'] ?? null,
                'lokasi_monev' => $validated['lokasi_monev'] ?? null,
                'tanggal_pelaksanaan' => $validated['tanggal_pelaksanaan'] ?? null,

                'nama_responden' => $validated['nama_responden'],
                'jabatan_responden' => $validated['jabatan_responden'],
                'jabatan_lainnya' => null,

                'satuan_pendidikan' => $validated['satuan_pendidikan'],
                'masa_kerja' => $validated['masa_kerja'],
                'nama_pelatihan' => $validated['nama_pelatihan'],
                'tanggal_pengisian' => $validated['tanggal_pengisian'],

                ...$score,
            ]);

            $this->saveAnswers(
                $submission,
                $questions,
                $answers
            );

            $this->saveEssays(
                $submission,
                $validated['essay'] ?? null
            );

            return $submission;
        });

        return redirect()
            ->route('bk.show', $submission)
            ->with(
                'success',
                'Pengisian instrumen BK berhasil disimpan.'
            );
    }

    /**
     * Form edit.
     */
    public function edit(BKSubmission $submission)
    {
        $submission->load([
            'answers.question',
            'essayAnswers',
        ]);

        // Tampilkan hanya level yang berlaku untuk jabatan tersimpan.
        $questions = $this->getQuestionsForJabatan(
            $submission->jabatan_responden
        );

        $answers = $submission->answers->keyBy('bk_question_id');
        $essayAnswers = $submission->essayAnswers->keyBy('nomor');

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
     * Update pengisian.
     */
    public function update(
        Request $request,
        BKSubmission $submission
    ) {
        $validated = $request->validate($this->validationRules());

        $questions = $this->getQuestionsForJabatan(
            $validated['jabatan_responden']
        );

        $answers = $validated['jawaban'];

        $allowedIds = $questions->pluck('id')
            ->map(fn($id) => (string) $id)
            ->all();

        foreach (array_keys($answers) as $id) {
            if (!in_array((string) $id, $allowedIds, true)) {
                return back()
                    ->withErrors([
                        'jawaban' =>
                            'Terdapat jawaban pada level yang tidak berlaku bagi jabatan ini.',
                    ])
                    ->withInput();
            }
        }

        foreach ($questions as $question) {
            if (!array_key_exists($question->id, $answers)) {
                return back()
                    ->withErrors([
                        'jawaban' =>
                            "Pernyataan nomor {$question->nomor} belum dijawab.",
                    ])
                    ->withInput();
            }
        }

        DB::transaction(function () use ($validated, $questions, $answers, $submission) {
            $score = $this->calculateScore($questions, $answers);

            $submission->update([
                'sekolah_id' => SekolahResolver::resolve(
                    $validated['satuan_pendidikan'] ?? null
                )?->id,

                'nama_petugas_monev' => $validated['nama_petugas_monev'],
                'instansi_petugas' => $validated['instansi_petugas'] ?? null,
                'lokasi_monev' => $validated['lokasi_monev'] ?? null,
                'tanggal_pelaksanaan' => $validated['tanggal_pelaksanaan'] ?? null,

                'nama_responden' => $validated['nama_responden'],
                'jabatan_responden' => $validated['jabatan_responden'],
                'jabatan_lainnya' => null,

                'satuan_pendidikan' => $validated['satuan_pendidikan'],
                'masa_kerja' => $validated['masa_kerja'],
                'nama_pelatihan' => $validated['nama_pelatihan'],
                'tanggal_pengisian' => $validated['tanggal_pengisian'],

                ...$score,
            ]);

            $this->saveAnswers(
                $submission,
                $questions,
                $answers,
                true
            );

            $this->saveEssays(
                $submission,
                $validated['essay'] ?? null
            );
        });

        return redirect()
            ->route('bk.show', $submission)
            ->with(
                'success',
                'Data pengisian BK berhasil diperbarui.'
            );
    }

    /**
     * Hapus data BK.
     */
    public function destroy(BKSubmission $submission)
    {
        $submission->delete();

        return redirect()
            ->route('instrumen.index')
            ->with('success', 'Data BK berhasil dihapus.');
    }

    /**
     * Hasil penilaian.
     */
    public function show(BKSubmission $submission)
    {
        $submission->load([
            'answers.question',
            'essayAnswers',
        ]);

        $answers = $submission->answers
            ->sortBy(
                fn($answer) =>
                    $answer->question?->urutan ?? 999999
            )
            ->values();

        $submission->setRelation('answers', $answers);

        $essayAnswers = $submission->essayAnswers
            ->sortBy('nomor')
            ->values();

        $submission->setRelation('essayAnswers', $essayAnswers);

        return view('bk.show', compact('submission'));
    }

    /**
     * Cetak hasil penilaian.
     */
    public function cetak(BKSubmission $submission)
    {
        $submission->load([
            'answers.question',
            'essayAnswers',
        ]);

        $answers = $submission->answers
            ->sortBy(
                fn($answer) =>
                    $answer->question?->urutan ?? 999999
            )
            ->values();

        $submission->setRelation('answers', $answers);

        $essayAnswers = $submission->essayAnswers
            ->sortBy('nomor')
            ->values();

        $submission->setRelation('essayAnswers', $essayAnswers);

        return view('bk.cetak', compact('submission'));
    }
}
