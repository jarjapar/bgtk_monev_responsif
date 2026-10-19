<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BKQuestion extends Model
{
    use HasFactory;

    protected $table = 'bk_questions';

    protected $fillable = [
        'level',
        'level_nama',
        'bagian',
        'judul_bagian',
        'nomor',
        'pernyataan',
        'urutan',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];

    /**
     * Jawaban dari pertanyaan ini.
     */
    public function answers()
    {
        return $this->hasMany(BKAnswer::class, 'bk_question_id');
    }
}