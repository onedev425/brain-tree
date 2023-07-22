<?php

namespace App\Http\Controllers;

use App\Http\Requests\LockUserAccountRequest;
use App\Models\User;
use App\Services\EmailService;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class LockUserAccountController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user, UserService $userService, LockUserAccountRequest $request)
    {
        $this->authorize('lockAccount', [$user]);

        $lock = $request->lock;

        $userService->lockUserAccount($user, $lock);

        $email_data = [
            'to' => $user->email,
            'subject' => $lock ? __('Account suspend') : __('Account activated'),
            'user_name' => $user->name,
            'email_type' => 'user_suspend',
            'lock' => $lock
        ];

        $email_service = new EmailService($email_data);
        $result = $email_service->sendEmail();
        if ($result == 'success')
            return back()->with('success', ($lock == true ? 'Locked' : 'Unlocked')." {$user->name}'s account successfully");
        else
            return back()->with('danger', __('Something went wrong!'));
    }
}
