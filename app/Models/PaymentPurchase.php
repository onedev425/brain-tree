<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentPurchase extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'course_id', 'course_amount', 'paid_amount', 'payment_status'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
