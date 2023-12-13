<?php

namespace App\Services\AccountApplication;

use App\Events\AccountStatusChanged;
use App\Mail\SendinblueMail;
use App\Models\AccountApplication;
use App\Models\User;
use App\Services\EmailService;
use App\Services\Student\StudentService;
use App\Services\User\UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AccountApplicationService
{
    /**
     * User service instance.
     */
    public UserService $userService;

    /**
     * Student service instance.
     */
    public StudentService $studentService;

    public function __construct(UserService $userService, StudentService $studentService)
    {
        $this->userService = $userService;
        $this->studentService = $studentService;
    }

    /**
     * Get all open applicants application records.
     *
     * @return User
     */
    public function getAllOpenApplicantsAndApplicationRecords()
    {
        return $this->userService->getUsersByRole('applicant')->load('accountApplication', 'accountApplication.statuses')->filter(function ($applicant) {
            $status = $applicant->accountApplication->status ?? null;

            if ($status != 'rejected') {
                return true;
            }
        });
    }

    /**
     * Get all  applicants application records.
     *
     * @return User
     */
    public function getAllRejectedApplicantsAndApplicationRecords()
    {
        return $this->userService->getUsersByRole('applicant')->load('accountApplication', 'accountApplication.statuses')->filter(function ($applicant) {
            $status = $applicant->accountApplication->status ?? null;

            if ($status == 'rejected') {
                return true;
            } else {
                return false;
            }
        });
    }

    /**
     * Create application record.
     *
     *
     * @return AccountApplication
     */
    public function createAccountApplication(int $userId, int $roleId)
    {
        return AccountApplication::create([
            'role_id' => $roleId,
            'user_id' => $userId,
        ]);
    }

    /**
     * Update account application.
     *
     * @param User   $user
     * @param object $record
     *
     * @return void
     */
    public function updateAccountApplication(User $applicant, object|array $record)
    {
        DB::transaction(function () use ($applicant, $record) {
            $applicant = $this->userService->updateUser($applicant, $record, 'applicant');

            //create record if record doesn't exist somehow else update
            $applicant->accountApplication()->updateOrCreate([], [
                'role_id' => $record['role_id'],
            ]);
        });
    }

    /**
     * Change application status or process account creation.
     *
     *
     * @return void
     */
    public function changeStatus(User $applicant, $record)
    {
        DB::transaction(function () use ($applicant, $record) {
            $applicant->accountApplication->setStatus($record['status'], $record['reason'] ?? null);

            if ($applicant->accountApplication->status == 'approved') {
                //create associated user records
                switch ($applicant->accountApplication->role->name) {
                    case 'student':
                        $this->studentService->createStudentRecord($applicant, $record);
                        break;
                    case 'teacher':
                        $applicant->teacherRecord()->create();
                        break;
                }

                //add supplied role and delete application record
                $applicant->syncRoles([$applicant->accountApplication->role->name]);
                $applicant->accountApplication->delete();
            }
        });

        $email_data = [
            'to' => $applicant->email,
            'subject' => __('Your application ') . $record['status'],
            'user_name' => $applicant->name,
            'email_type' => 'application_review',
            'application_status' => $record['status'],
            'application_reason' => $record['reason'],
        ];

        $email_service = new EmailService($email_data);
        $result = $email_service->sendEmail();
        if ($result == 'success')
            AccountStatusChanged::dispatch($applicant, $record['status'], $record['reason']);
        else
            return back()->with('notify', __('Email sending failed: ') . $result);
    }

    /**
     * Delete user and application.
     *
     *
     * @return void
     */
    public function deleteAccountApplicant(User $applicant)
    {
        $applicant->forceDelete();
    }
}
