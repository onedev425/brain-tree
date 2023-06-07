<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherCourseStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'course_title'  => 'required|max:100',
//            'industry'      => 'required|integer',
//            'course_price'  => 'required|integer',
        ];
    }
}
