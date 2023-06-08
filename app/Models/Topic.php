<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'description', 'course_id', 'user_id'
    ];

    public static function createTopic($course_id, $data)
    {
        $data['course_id'] = $course_id;
        return self::create($data);
    }

    public function createLesson($data)
    {
        return Lesson::createLesson($this->id, $data);
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }
}
