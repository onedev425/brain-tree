<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id', 'description', 'answer'
    ];

    /**
     * Get the course for the lesson.
     */
    public function Exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class);
    }
}
