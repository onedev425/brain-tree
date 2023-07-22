<?php

namespace App\Http\Controllers;

use App\Events\AccountStatusChanged;
use App\Http\Requests\RegistrationRequest;
use App\Services\AccountApplication\AccountApplicationService;
use App\Services\EmailService;
use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\User;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\DB;

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
        if ($request['role'] == 3)
            $user->assignRole('student');
        else
            $user->assignRole('applicant');

        $accountApplication = $this->accountApplicationService->createAccountApplication($user->id, $request->role);
        $status = __('Application Received');
        $reason = __('Application has been received, we would reach out to you for further information');
        $accountApplication->setStatus($status, $reason);

        //dispatch event
        AccountStatusChanged::dispatch($user, $status, $reason);
        if ($request['role'] == 3) {
            $this->accountApplicationService->changeStatus($user, [
                'status' => 'approved',
                'admission_number' => Str::random(10),
                'admission_date' => date('Y-m-d H:i:s'),
                'reason' => ''
            ]);
        }

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
            return back()->with('success', __('Registration complete, you would receive an email to verify your account'));
        else
            return back()->with('danger', __('Email sending failed: ') . $result);
    }

    public function verification_resend(Request $request)
    {
        $user = auth()->user();
        $verification_url = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );
        $email_data = [
            'to' => $user->email,
            'subject' => __('Verify Email Address'),
            'user_name' => $user->name,
            'email_type' => 'email_verification',
            'verification_url' => $verification_url
        ];
        $email_service = new EmailService($email_data);
        $result = $email_service->sendEmail();

        if ($result == 'success')
            return back()->with('status', __('We sent an email to you.'));
        else
            return back()->with('danger', __('Email sending failed: ') . $result);
    }

    public function password_reset(Request $request)
    {
        $email = $request->only(Fortify::email());
        $email = $email['email'];

        // get user from email
        $user_exist = User::where('email', $email)->count();
        if (! $user_exist) {
            return back()->with('danger', __('The email doesn\'t exist in our system'));
        }
        $user = User::where('email', $email)->first();

        // generate the token
        $hash_key = config('app.key');
        if (str_starts_with($hash_key, 'base64:')) {
            $hash_key = base64_decode(substr($hash_key, 7));
        }

        $token = hash_hmac('sha256', Str::random(40), $hash_key);
//        $token = password_hash($token, PASSWORD_DEFAULT );

        // register the token to database
        DB::table('password_resets')->where('email', $email)->delete();
        DB::table('password_resets')->insert(['email' => $email, 'token' => $token, 'created_at' => date('Y-m-d H:i:s')]);

        // send the email to reset the password
        $password_reset_link =  url(route('password.reset', ['token' => $token, 'email' => $email]));
        $email_data = [
            'to' => $email,
            'subject' => __('Reset Password'),
            'user_name' => $user->name,
            'email_type' => 'reset_password',
            'reset_password_url' => $password_reset_link
        ];
        $email_service = new EmailService($email_data);
        $result = $email_service->sendEmail();

        if ($result == 'success')
            return back()->with('status', __('We have emailed the link to reset the password.'));
        else
            return back()->with('danger', __('Email sending failed: ') . $result);
    }

    public function password_update(Request $request)
    {
        $input['token'] = $request['token'];
        $input['password'] = $request['password'];
        $input['password_confirmation'] = $request['password_confirmation'];

        $token_info = DB::table('password_resets')->where('token', $input['token'])->first();
        if (! $token_info) {
            return back()->with('danger', __('This password reset token is invalid.'));
        }

        Validator::make($input, ['password' => ['required', 'string', new \Laravel\Fortify\Rules\Password, 'confirmed']])->validate();
        $user = User::where('email', $token_info->email)->first();
        $user->forceFill(['password' => Hash::make($input['password'])])->save();

        return redirect()->route('login')->with('status', __('Your password reset successfully.'));
    }

    public function refresh_csrf_token(): JsonResponse
    {
        return response()->json(['token' => csrf_token()]);
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->forceDelete();

        return back()->with('success', __('The user deleted successfully'));
    }
}
