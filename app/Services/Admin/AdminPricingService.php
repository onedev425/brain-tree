<?php

namespace App\Services\Admin;

use App\Models\PaymentSalary;
use App\Models\User;

class AdminPricingService
{
    public function getSoldCoursesOfTeacher($billing_period, $search)
    {
        $courses = User::select('users.id', 'users.name', 'users.profile_photo_path')
            ->selectRaw('SUM(1) as courses')
            ->selectRaw('SUM(courses.price) as course_amount')
            ->join('courses', 'users.id', '=', 'courses.assigned_id')
            ->join('student_courses', function ($join) use ($billing_period) {
                $join->on('student_courses.course_id', '=', 'courses.id')
                    ->whereRaw("LEFT(student_courses.created_at, 7) = '$billing_period'");
            })
            ->leftJoin('payment_salaries', function ($join) use ($billing_period) {
                $join->on('courses.assigned_id', '=', 'payment_salaries.teacher_id')
                    ->whereRaw("LEFT(student_courses.created_at, 7) = '$billing_period'");
            })
            ->whereNull('payment_salaries.teacher_id');
        if ($search != '') $courses = $courses->where('users.name', 'LIKE', '%'. $search . '%');

        return $courses->groupBy('users.id', 'users.name', 'users.profile_photo_path');
    }

    public function registerPayout($teacher_id, $course_amount, $payout_amount): void
    {
        $billing_period = date('Y-m', strtotime('last month'));
        PaymentSalary::create([
            'teacher_id' => $teacher_id,
            'period' => $billing_period,
            'total_amount' => $course_amount,
            'paid_amount' => $payout_amount,
            'payment_status' => 'completed'
        ]);
    }

    public function getPayoutHistories($period, $search)
    {
        $payout_histories = User::select('users.id', 'users.name', 'users.profile_photo_path', 'payment_salaries.total_amount', 'payment_salaries.paid_amount', 'payment_salaries.created_at')
            ->join('payment_salaries', 'users.id', '=', 'payment_salaries.teacher_id')
            ->where('period',  $period);
        if ($search != '') $payout_histories = $payout_histories->where('users.name', 'LIKE', '%'. $search . '%');

        return $payout_histories;
    }

}
