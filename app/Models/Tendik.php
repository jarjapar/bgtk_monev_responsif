<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tendik extends Model
{
    use HasFactory;

    protected $table = 'tendiks';

    protected $fillable = [
        'nama_petugas_monev',
        'instansi_petugas',
        'nama_responden',
        'jabatan_responden',
        'jabatan_lainnya',
        'satuan_pendidikan',
        'masa_kerja',
        'nama_pelatihan',
        'tanggal_pengisian',
        'sekolah_id',
        'lokasi_monev',

        // Jawaban butir 1–43
        'jawaban_1',
        'jawaban_2',
        'jawaban_3',
        'jawaban_4',
        'jawaban_5',
        'jawaban_6',
        'jawaban_7',
        'jawaban_8',
        'jawaban_9',
        'jawaban_10',
        'jawaban_11',
        'jawaban_12',
        'jawaban_13',
        'jawaban_14',
        'jawaban_15',
        'jawaban_16',
        'jawaban_17',
        'jawaban_18',
        'jawaban_19',
        'jawaban_20',
        'jawaban_21',
        'jawaban_22',
        'jawaban_23',
        'jawaban_24',
        'jawaban_25',
        'jawaban_26',
        'jawaban_27',
        'jawaban_28',
        'jawaban_29',
        'jawaban_30',
        'jawaban_31',
        'jawaban_32',
        'jawaban_33',
        'jawaban_34',
        'jawaban_35',
        'jawaban_36',
        'jawaban_37',
        'jawaban_38',
        'jawaban_39',
        'jawaban_40',
        'jawaban_41',
        'jawaban_42',
        'jawaban_43',

        // Rekap skor
        'skor_level_1',
        'skor_level_2',
        'skor_level_3',
        'skor_level_4',
        'skor_keseluruhan',
        'predikat',
    ];

    protected function casts(): array
    {
        return [
            'masa_kerja' => 'integer',
            'tanggal_pengisian' => 'date',
            'skor_level_1' => 'decimal:2',
            'skor_level_2' => 'decimal:2',
            'skor_level_3' => 'decimal:2',
            'skor_level_4' => 'decimal:2',
            'skor_keseluruhan' => 'decimal:2',
        ];
    }
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }
}
