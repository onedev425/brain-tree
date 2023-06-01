<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if (auth()->user()->hasRole('student')) {
            return [
                'name' => [
                    'required',
                    'max:100'
                ],
                'email' => [
                    'required',
                    'max:100'
                ],
                'birthday' => [
                    'required',
                    'max:100'
                ],
                'phone' => [
                    'required',
                    'max:20'
                ],
                'country' => [
                    'required',
                ],
                'industry' => [
                    'required',
                ],
                'language' => [
                    'required',
                ],
            ];
        }
        else {
            return [
                'name' => [
                    'required',
                    'max:100'
                ],
                'email' => [
                    'required',
                    'max:100'
                ],
                'phone' => [
                    'required',
                    'max:20'
                ],
                'country' => [
                    'required',
                ],
                'industry' => [
                    'required',
                ],
                'language' => [
                    'required',
                ],
                'experience' => [
                    'required',
                ],
            ];
        }

    }
}
