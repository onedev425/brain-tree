<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'address', 'code', 'initials', 'phone', 'email',
    ];

    /**
     * Get all of the users for the School.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
