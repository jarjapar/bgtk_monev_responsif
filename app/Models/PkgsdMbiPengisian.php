<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PkgsdMbiPengisian extends Model
{
    use HasFactory;

    protected $table = 'pkgsd_mbi_pengisians';

    protected $fillable = [
        'sekolah_id',
        'nama_guru',
        'nama_sekolah',
        'kelas_fase',
        'topik_materi',
        'nama_petugas_monev',
        'jabatan_penilai',
        'tanggal_monev',
        'sumber_data_bukti',
        'level_1_jawaban',
        'level_2_jawaban',
        'level_3_jawaban',
        'level_4_jawaban',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_monev' => 'date',
            'level_1_jawaban' => 'array',
            'level_2_jawaban' => 'array',
            'level_3_jawaban' => 'array',
            'level_4_jawaban' => 'array',
        ];
    }

    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id');
    }
}
