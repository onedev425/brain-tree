<?php

namespace App\Http\Controllers;

use App\Events\AccountStatusChanged;
use App\Http\Requests\RegistrationRequest;
use App\Mail\SendinblueMail;
use App\Services\AccountApplication\AccountApplicationService;
use App\Services\EmailService;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class RegistrationController extends Controller
{
    /**
     * Account application service instance.
     */
    public AccountApplicationService $accountApplicationService;

    /**
     * User service instance.
     */
    public UserService $userService;

    public function __construct(AccountApplicationService $accountApplicationService, UserService $userService)
    {
        $this->accountApplicationService = $accountApplicationService;
        $this->userService = $userService;
    }

    public function registerView()
    {
        return view('auth.register');
    }

    public function register(RegistrationRequest $request)
    {
        $user = $this->userService->createUser($request);

        //assign applicant role
        $user->assignRole('applicant');

        $accountApplication = $this->accountApplicationService->createAccountApplication($user->id, $request->role);
        $status = 'Application Received';
        $reason = 'Application has been received, we would reach out to you for further information';
        $accountApplication->setStatus($status, $reason);

        //dispatch event
        AccountStatusChanged::dispatch($user, $status, $reason);

        $verification_url = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );
        $email_data = [
            'to' => $user->email,
            'subject' => __('Please confirm your email'),
            'user_name' => $user->name,
            'email_type' => 'email_confirmation',
            'verification_url' => $verification_url
        ];

        $email_service = new EmailService($email_data);
        $result = $email_service->sendEmail();
        if ($result == 'success')
            return back()->with('success', 'Registration complete, you would receive an email to verify your account');
        else
            return back()->with('danger', __('Email sending failed: ') . $result);
    }
}
