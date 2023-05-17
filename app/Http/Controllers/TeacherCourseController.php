<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherCourseController extends Controller
{
    public function index()
    {
        return view('pages.teacher-course.index');
    }

    public function create()
    {
        return view('pages.teacher-course.new');
    }
}
