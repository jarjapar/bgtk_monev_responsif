<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BKEssayAnswer extends Model
{
    use HasFactory;

    protected $table = 'bk_essay_answers';

    protected $fillable = [
        'bk_submission_id',
        'nomor',
        'pertanyaan',
        'jawaban',
    ];

    /**
     * Pengisian BK.
     */
    public function submission()
    {
        return $this->belongsTo(
            BKSubmission::class,
            'bk_submission_id'
        );
    }
}