<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
//use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $user->name = $request['name'];
        $user->phone = $request['phone'];
        $user->email = $request['email'];
        $user->country_id = $request['country'];
        $user->language_id = $request['language'];
        $user->industry_id = $request['industry'];
        if ($user->hasRole('student'))
            $user->birthday = $request['birthday'];
        else
            $user->experience = $request['experience'];

        $user->save();
        return back()->with('success', 'Updated Successfully');
    }
}
