<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'image', 'user_id', 'subject_id'
    ];

    /**
     * Get the teacher for the course
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the subject for the course
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}
