<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Egulias\EmailValidator\Validation\RFCValidation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param mixed $user
     *
     * @return \App\Models\User
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'name'        => ['required', 'string', 'max:255'],
            'email'       => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo'       => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'birthday'    => ['required', 'date', 'before:today'],
            'address'     => ['required', 'string', 'max:500'],
            'phone'       => ['nullable', 'string', 'max:255'],
        ])->validate();

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name'        => $input['name'],
                'email'       => $input['email'],
                'birthday'    => $input['birthday'],
                'address'     => $input['address'],
                'phone'       => $input['phone'] ?? '',
            ])->save();
        }

        return $user;
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param mixed $user
     *
     * @return \App\Models\User
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name'              => $input['name'],
            'email'             => $input['email'],
            'email_verified_at' => null,
            'birthday'          => $input['birthday'],
            'address'           => $input['address'],
            'phone'             => $input['phone'] ?? '',
        ])->save();

        // $user->sendEmailVerificationNotification();

        return $user;
    }
}
