<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id', 'description', 'answer'
    ];

    public static function createQuestionOption($question_id, $data)
    {
        $data['question_id'] = $question_id;
        return self::create($data);
    }
}
