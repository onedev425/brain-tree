<?php

namespace App\Actions\Fortify;

use App\Mail\SendinblueMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class UpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and update the user's password.
     *
     * @param mixed $user
     *
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'current_password' => ['required', 'string'],
            'password'         => $this->passwordRules(),
        ])->after(function ($validator) use ($user, $input) {
            if (!isset($input['current_password']) || !Hash::check($input['current_password'], $user->password)) {
                $validator->errors()->add('current_password', __('The provided password does not match your current password.'));
            }
        })->validateWithBag('updatePassword');

        $new_password = Hash::make($input['password']);
        $user->forceFill([
            'password' => $new_password,
        ])->save();

        $email_data = [
            'to' => $user->email,
            'subject' => __('Your password updated'),
            'user_name' => $user->name,
            'email_type' => 'password_update',
        ];
        Mail::to($email_data['to'])->send(new SendinblueMail($email_data));

        Auth::guard('web')->logoutOtherDevices($input['password']);
        Auth::guard('web')->logout();

        return redirect()->route('login');
    }
}
