<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'video_link', 'video_type', 'video_duration', 'user_id', 'course_id', 'topic_id', 'attachment_file'
    ];

}
