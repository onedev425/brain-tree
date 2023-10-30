<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Log;
use Throwable;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     *
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name'     => ['required', 'string', 'max:100'],
            'email'    => ['required', 'string', 'email:rfc,dns', 'max:100', 'unique:users'],
            'photo'    => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'password' => $this->passwordRules(),
        ])->validate();

        $user_data = [
            'name'        => $input['name'],
            'email'       => $input['email'],
            'password'    => Hash::make($input['password']),
            'phone'       => $input['phone'],
            'country_id'  => $input['country_id'],
            'language_id' => $input['language_id'],
            'industry_id' => $input['industry_id'],
            'description' => $input['description'],
            'experience' => $input['experience'],
        ];

        $user = User::create($user_data);

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        try {
            Log::info('Created the user successfully');

            // $user->sendEmailVerificationNotification();
        } catch (Throwable $e) {
            report("Could not verification send email to $user->email. $e");

            return $user;
        }

        return $user;
    }
}
