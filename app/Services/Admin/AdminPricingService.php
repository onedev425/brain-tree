<?php

namespace App\Services\Admin;

use App\Models\PayoutHistory;
use App\Models\User;

class AdminPricingService
{
    public function getSoldCoursesOfTeacher($search)
    {
        $courses = User::select('users.id', 'users.name', 'users.fee_amount', 'users.payout_at', 'users.profile_photo_path')
            ->selectRaw('COUNT(courses.id) as courses')
            ->leftJoin('courses', 'users.id', '=', 'courses.assigned_id')
            ->selectRaw('SUM(payment_purchases.paid_amount) as earning_amount')
            ->leftJoin('payment_purchases', 'courses.id', '=', 'payment_purchases.course_id')
            ->join('teacher_records', 'users.id', '=', 'teacher_records.user_id');
        if ($search != '') $courses = $courses->where('users.name', 'LIKE', '%'. $search . '%');

        return $courses->groupBy('users.id', 'users.name', 'users.fee_amount', 'users.payout_at', 'users.profile_photo_path');
    }

    public function registerPayout($teacher_id, $payout_amount): void
    {
        PayoutHistory::create([
            'teacher_id' => $teacher_id,
            'paid_amount' => $payout_amount,
            'payment_status' => 'completed'
        ]);
    }

    public function getPayoutHistories($fromDate, $toDate, $search)
    {
        $payout_histories = User::select('users.id', 'users.name', 'users.profile_photo_path', 'payout_histories.paid_amount', 'payout_histories.created_at')
            ->join('payout_histories', 'users.id', '=', 'payout_histories.teacher_id');

        if ($fromDate) {
            $courses = $payout_histories->whereDate('payout_histories.created_at', '>=', $fromDate);
        }

        // Apply toDate filter if provided
        if ($toDate) {
            $courses = $courses->whereDate('payout_histories.created_at', '<=', $toDate);
        }

        if ($search != '') $payout_histories = $payout_histories->where('users.name', 'LIKE', '%'. $search . '%');

        return $payout_histories;
    }
}
