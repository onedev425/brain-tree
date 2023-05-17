<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'subject_id',
        'type',
        'user_id',
        'active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'active'            => 'boolean',
        'publish_result'    => 'boolean',
    ];

    public function examSlots(): HasMany
    {
        return $this->hasMany(ExamSlot::class);
    }
}
