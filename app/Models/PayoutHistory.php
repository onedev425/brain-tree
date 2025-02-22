<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayoutHistory extends Model
{
    use HasFactory;

    protected $fillable = ['teacher_id', 'paid_amount', 'payment_status'];
}
