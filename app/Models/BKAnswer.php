<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BKAnswer extends Model
{
    use HasFactory;

    protected $table = 'bk_answers';

    protected $fillable = [
        'bk_submission_id',
        'bk_question_id',
        'jawaban',
    ];

    protected $casts = [
        'jawaban' => 'boolean',
    ];

    /**
     * Pengisian instrumen BK.
     */
    public function submission()
    {
        return $this->belongsTo(
            BKSubmission::class,
            'bk_submission_id'
        );
    }

    /**
     * Pertanyaan BK.
     */
    public function question()
    {
        return $this->belongsTo(
            BKQuestion::class,
            'bk_question_id'
        );
    }
}