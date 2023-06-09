<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'course_id', 'user_id', 'type'
    ];

    public function quiz_options(): HasMany
    {
        return $this->hasMany(QuestionOption::class);
    }
}
