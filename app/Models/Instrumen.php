<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instrumen extends Model
{
    use HasFactory;

    protected $table = 'instrumens';

    protected $fillable = [
        'kode_instrumen',
        'nama_instrumen',
        'jenis_instrumen',
        'deskripsi',
        'status',
        'jumlah_pertanyaan',
        'capaian',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    protected $casts = [
        'jumlah_pertanyaan' => 'integer',
        'capaian' => 'decimal:2',
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    /**
     * Relasi ke Wawancara
     */
    public function wawancaras()
    {
        return $this->hasMany(Wawancara::class);
    }
}