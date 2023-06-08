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

    public static function createLesson($topic_id, $data)
    {
        $data['topic_id'] = $topic_id;
        return self::create($data);
    }

    public function updateLesson($data): void
    {
        $this->fill($data);
        $this->save();
    }
}
