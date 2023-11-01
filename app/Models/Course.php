<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'price', 'pass_percent', 'description', 'image', 'user_id', 'created_by', 'assigned_id', 'industry_id', 'quiz_active', 'is_published', 'is_declined', 'is_paid', 'wp_course_id'
    ];

    /**
     * Get the course creator
     */
    public function createdUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the teacher for the course
     */
    public function assignedTeacher()
    {
        return $this->belongsTo(User::class, 'assigned_id')->with('payment_connection');
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

    public function course_feedback(): HasMany
    {
        return $this->hasMany(CourseFeedback::class);
    }

    public function course_rate()
    {
        return $this->course_feedback->avg('rate');
    }

    public function course_feedback_nums()
    {
        return $this->course_feedback->count();
    }

    public function course_students()
    {
        return $this->belongsToMany(User::class, 'student_courses', 'course_id', 'student_id');
    }
}
