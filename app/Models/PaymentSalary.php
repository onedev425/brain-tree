<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSalary extends Model
{
    use HasFactory;

    protected $fillable = ['teacher_id', 'period', 'total_amount', 'paid_amount', 'payment_status'];
}
