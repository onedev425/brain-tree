<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentFee;

class PaymentFeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentFee::create([
            'fee_type' => 'teacher_course_fee',
            'fee_value' => '10',
        ]);
        PaymentFee::create([
            'fee_type' => 'student_course_fee_percent',
            'fee_value' => '10',
        ]);
    }
}
