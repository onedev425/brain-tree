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
        $validation_rules = array(
            'name'        => ['required', 'string', 'max:255'],
            'email'       => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone'       => ['required', 'string', 'max:20'],
        );
        if ($user->hasRole('student')) $validation_rules['birthday'] = ['required', 'string', 'max:20'];
        Validator::make($input, $validation_rules)->validate();

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $input_values = array(
                'name' => $input['name'],
                'email' => $input['email'],
                'phone' => $input['phone'],
                'country_id' => $input['country_id'],
                'language_id' => $input['language_id'],
                'industry_id' => $input['industry_id']
            );
            if (isset($input['birthday'])) $input_values['birthday'] = $input['birthday'];
            if (isset($input['experience'])) $input_values['experience'] = $input['experience'];
            if (isset($input['description'])) $input_values['description'] = $input['description'];

            $user->forceFill($input_values)->save();
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
