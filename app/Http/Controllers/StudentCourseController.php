<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentCourseController extends Controller
{
    public function index()
    {
        return view('pages.student-course.index');
    }

    public function show()
    {
        return view('pages.student-course.show');
    }
}
