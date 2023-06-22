<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
