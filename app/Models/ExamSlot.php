<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExamSlot extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total_marks', 'exam_id'];

    /**
     * Get the exam that owns the ExamSlot.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
    
    /**
     * Get the student that owns the ExamSlot.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo(User::class);
    }
}
