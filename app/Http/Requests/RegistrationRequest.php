<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Role;

class RegistrationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $roles = Role::whereIn('name', ['teacher', 'student'])->get();

        return [
            'user_name' => [
                'required',
                'max:100'
            ],
            'email' => [
                'required',
                'max:100'
            ],
            'password' => [
                'required',
                'min:8',
                'max:100',
                'confirmed'
            ],
            'password_confirmation' => [
                'required',
                'max:100'
            ],
        ];
    }
}
