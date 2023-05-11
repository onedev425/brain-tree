<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'video_link', 'video_type', 'user_id', 'course_id', 'topic_id'
    ];

    /**
     * Get the course for the lesson.
     */
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    /**
     * Get the teacher for lesson.
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
