<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'price', 'description', 'image', 'user_id', 'created_by', 'assigned_id', 'industry_id', 'quiz_active', 'is_published'
    ];

    /**
     * Create a course
     */
    public static function createCourse($data): Course
    {
        return self::create($data);
    }

    public function updateCourse($data): Course
    {
        $this->fill($data);
        $this->save();
        return $this;
    }

    /**
     * Create a topic of a course
     */
    public function createTopic($data)
    {
        return Topic::createTopic($this->id, $data);
    }

    /**
     * Create a question of a course
     */
    public function createQuestion($data)
    {
        return Question::createQuestion($this->id, $data);
    }

    /**
     * Get the course creator
     */
    public function createdUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the teacher for the course
     */
    public function assignedTeacher()
    {
        return $this->belongsTo(User::class, 'assigned_id');
    }

    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class);
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

}
