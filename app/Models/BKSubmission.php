<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BKSubmission extends Model
{
    use HasFactory;

    protected $table = 'bk_submissions';

    protected $fillable = [
        // Identitas petugas Monev
        'nama_petugas_monev',
        'instansi_petugas',
        'lokasi_monev',
        'tanggal_pelaksanaan',

        // Identitas responden
        'nama_responden',
        'jabatan_responden',
        'jabatan_lainnya',
        'satuan_pendidikan',
        'masa_kerja',
        'nama_pelatihan',
        'tanggal_pengisian',

        // Field lama, dipertahankan untuk kompatibilitas data
        'instansi_responden',
        'kab_kota',

        // Hasil penilaian
        'jumlah_soal',
        'jumlah_ya',
        'jumlah_tidak',
        'skor_persentase',
        'kategori',
        'status',
        'sekolah_id',
    ];

    protected $casts = [
        'tanggal_pelaksanaan' => 'date',
        'tanggal_pengisian' => 'date',
        'masa_kerja' => 'integer',
        'skor_persentase' => 'decimal:2',
    ];

    /**
     * Daftar pertanyaan dan jawaban Ya/Tidak.
     */
    public function answers()
    {
        return $this->hasMany(BKAnswer::class, 'bk_submission_id');
    }

    /**
     * Jawaban pertanyaan uraian.
     */
    public function essayAnswers()
    {
        return $this->hasMany(BKEssayAnswer::class, 'bk_submission_id');
    }

    /**
     * Sekolah yang terkait dengan pengisian BK.
     */
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }
}
