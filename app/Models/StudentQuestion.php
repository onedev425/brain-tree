<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'course_id', 'question_id', 'question_option_id', 'answer'
    ];
}
