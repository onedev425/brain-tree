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

    public static function createQuestion($course_id, $data)
    {
        $data['course_id'] = $course_id;
        return self::create($data);
    }

    public function updateQuestion($data): Question
    {
        $this->fill($data);
        $this->save();
        return $this;
    }

    public function createQuestionOption($data)
    {
        return QuestionOption::createQuestionOption($this->id, $data);
    }

    public function quiz_options(): HasMany
    {
        return $this->hasMany(QuestionOption::class);
    }
}
