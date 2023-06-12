<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\View\View;

class StudentCourseController extends Controller
{
    public function index(): View
    {
        return view('pages.student-course.index');
    }

    public function show(Course $course): View
    {
        $data['course'] = $course;
        $data['topics'] = $course->topics()->with('lessons')->get();
        $data['quizzes'] = $course->questions()->with('quiz_options')->get();

        return view('pages.student-course.show', $data);
    }
}
