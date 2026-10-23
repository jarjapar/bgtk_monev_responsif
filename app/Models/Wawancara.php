<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wawancara extends Model
{
    use HasFactory;

    protected $table = 'wawancaras';

    protected $fillable = [
        'jenis_wawancara',
        'instrumen_id',
        'sekolah_id',
        'tanggal_wawancara',
        'status',

        // Identitas BCKS
        'nama_bcks',
        'unit_kerja_bcks',
        'angkatan_pelatihan_bcks',

        // Identitas responden
        'nama_responden',
        'unit_kerja_responden',
        'status_responden',

        // Identitas petugas Monev
        'nama_petugas_monev',
        'unit_kerja_petugas',
        'tanggal_evaluasi',

        // Jawaban esai
        'jawaban_1',
        'jawaban_2',
        'jawaban_3',
        'jawaban_4',
        'jawaban_5',

        // Hasil dan catatan
        'hasil_wawancara',
        'catatan',

        // Kolom lama untuk menjaga kompatibilitas data
        'nama_narasumber',
        'jabatan_narasumber',
        'nama_pewawancara',
    ];  

    protected function casts(): array
    {
        return [
            'tanggal_wawancara' => 'date',
            'tanggal_evaluasi' => 'date',
        ];
    }

    public function instrumen()
    {
        return $this->belongsTo(Instrumen::class);
    }

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function tindakLanjut()
    {
        return $this->hasOne(TindakLanjut::class);
    }
}
