<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BcksJawaban extends Model
{
    protected $table = 'bcks_jawaban';

    protected $fillable = [
        'bcks_pengisian_id',
        'nomor_indikator',
        'level',
        'skor',
        'catatan',
    ];

    protected $casts = [
        'nomor_indikator' => 'integer',
        'skor' => 'integer',
    ];

    /**
     * Relasi ke data pengisian BCKS.
     */
    public function pengisian(): BelongsTo
    {
        return $this->belongsTo(
            BcksPengisian::class,
            'bcks_pengisian_id'
        );
    }
}