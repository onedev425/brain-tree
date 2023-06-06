<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Course\CourseService;
use App\Models\Course;

class TeacherCourseController extends Controller
{
    public CourseService $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
        $this->authorizeResource(Course::class);
    }

    public function index()
    {
        return view('pages.teacher-course.index');
    }

    public function create()
    {
        return view('pages.teacher-course.new');
    }

    public function store(Request $request)
    {
        $data['course_title'] = $request['course_title'];
        $data['industry_id'] = $request['industry'];
        $data['course_price'] = $request['course_price'];
        $data['course_description'] = $request['course_description'];

        $data['topic_list'] = json_decode($request['topic_list'], true);
        $data['quiz_list'] = json_decode($request['quiz_list'], true);
        $data['quiz_active'] = isset($request['quiz_active']) ? 1 : 0;
        $data['is_published'] = $request['is_published'];

        $data['course_image'] = asset('images/logo/course.jpg');
        if ($request->hasFile('course_image')) {
            $image = $request->file('course_image');
            $image_name = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('upload/course'), $image_name);
            $data['course_image'] = asset('upload/course/' . $image_name);
        }

        $this->courseService->createCourse($data);

        // return back()->with('success', 'Course Created Successfully');
        return redirect()->route('teacher.course.index');
    }
}
