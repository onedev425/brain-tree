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

    public function payment_purchases(): HasMany
    {
        return $this->hasMany(PaymentPurchase::class);
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

    public function course_feedback_array()
    {
        // Get the array of rates
        $rawArray = $this->course_feedback->pluck('rate')->toArray();
        // Initialize an array to hold the counts for rates 1 to 5
        $array = array_fill(1, 5, 0); // Creates an array with keys 1 to 5 initialized to 0

        // Iterate through the raw array to count occurrences
        foreach ($rawArray as $rate) {
            if (isset($array[$rate])) {
                $array[$rate]++; // Increment the count for the given rate
            }
        }

        // Calculate the total sum of counts
        $sum = array_sum($array);

        // Calculate the percentage for each rate
        if ($sum > 0) { // Avoid division by zero
            foreach ($array as $index => $count) {
                $array[$index] = round(($count / $sum) * 100); // Calculate and round percentage
            }
        }

        return $array; // Return the array of rounded percentages
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
