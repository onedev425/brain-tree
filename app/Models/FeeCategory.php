<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeeCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'description'];

    /**
     * Get all of the fees for the FeeCategory.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fees(): HasMany
    {
        return $this->hasMany(Fee::class);
    }
}
