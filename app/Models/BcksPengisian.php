<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BcksPengisian extends Model
{
    protected $table = 'bcks_pengisians';

    protected $fillable = [
        'nama_bcks',
        'unit_kerja',
        'angkatan_pelatihan',
        'nama_responden',
        'unit_kerja_responden',
        'status_responden',
        'nama_petugas_monev',
        'unit_kerja_petugas',
        'tanggal_evaluasi',
        'total_skor',
        'nilai_akhir',
        'predikat',
        'dampak_implementasi_rptks',
        'kendala_strategi_mitigasi',
        'perubahan_pengambilan_keputusan',
        'dukungan_lingkungan_sekolah',
        'keberlanjutan_program_inovasi',
        'status_pengisian',
        'sekolah_id',
    ];

    protected $casts = [
        'tanggal_evaluasi' => 'date',
        'total_skor' => 'integer',
        'nilai_akhir' => 'decimal:2',
    ];

    /**
     * Relasi ke jawaban setiap indikator BCKS.
     */
    public function jawaban(): HasMany
    {
        return $this->hasMany(BcksJawaban::class, 'bcks_pengisian_id');
    }
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }
}