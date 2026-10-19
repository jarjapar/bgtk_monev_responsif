<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TindakLanjut extends Model
{
    use HasFactory;

    protected $table = 'tindak_lanjuts';

    protected $fillable = [
        'sekolah_id',
        'wawancara_id',
        'judul_tindak_lanjut',
        'uraian_tindak_lanjut',
        'penanggung_jawab',
        'tanggal_mulai',
        'target_selesai',
        'status',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'target_selesai' => 'date',
    ];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function wawancara()
    {
        return $this->belongsTo(Wawancara::class);
    }
}