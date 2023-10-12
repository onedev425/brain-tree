<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function update_avatar(Request $request)
    {
        $user = auth()->user();
        $profile_photo_path = $user->profile_photo_path;
        if ($profile_photo_path) {
            $image_name = basename($profile_photo_path);
            if ($image_name != 'avatar.png')
                unlink(public_path('upload/user/') . $image_name);
        }


        if ($request->hasFile('avatar_image')) {
            $image = $request->file('avatar_image');
            $image_name = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('upload/user'), $image_name);
            $image_path = asset('upload/user/' . $image_name);
            $user->profile_photo_path = $image_path;
            $user->save();
        }
        else {
            if ($request['use_default_image'] == 1) {
                $image_path = asset('images/logo/avatar.png');
                $user->profile_photo_path = $image_path;
                $user->save();
            }

        }
        return 'success';
    }

    public function remove_avatar(Request $request)
    {
        $user = auth()->user();
        $profile_photo_path = $user->profile_photo_path;
        if ($profile_photo_path) {
            $image_name = basename($profile_photo_path);
            if ($image_name != 'avatar.png')
                unlink(public_path('upload/user/') . $image_name);
        }

        $user->profile_photo_path = null;
        $user->save();
    }

    public function update_profile(Request $request)
    {
        $user = auth()->user();
        $input['name'] = $request['name'];
        $input['email'] = $request['email'];
        $input['phone'] = $request->input('phone');

        $validation_rules = array(
            'name'        => ['required', 'string', 'max:255'],
            'email'       => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone'       => ['required', 'string', 'max:20'],
        );

        if ($user->hasRole('student')) {
            $input['birthday'] = $request['birthday'];
            $validation_rules['birthday'] = ['required', 'string', 'max:20'];
        }
        Validator::make($input, $validation_rules)->validate();

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        }
        else {
            $input['country_id'] = $request['country'];
            $input['language_id'] = $request['language'];
            $input['industry_id'] = $request['industry'];


            if (isset($request['experience'])) $input['experience'] = $request['experience'];
            if (isset($request['description'])) $input['description'] = $request['description'];
            $user->forceFill($input)->save();
        }

        return back()->with('success', 'Your profile updated successfully');
    }

    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name'              => $input['name'],
            'email'             => $input['email'],
            'email_verified_at' => null,
            'phone'             => $input['phone'] ?? '',
        ])->save();

        // $user->sendEmailVerificationNotification();

        return $user;
    }
}
