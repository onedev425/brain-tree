<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Services\Course\CourseService;
use App\Models\Course;
use App\Http\Requests\TeacherCourseStoreRequest;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Collection;

class TeacherCourseController extends Controller
{
    public CourseService $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
        $this->authorizeResource(Course::class);
    }

    public function index(): View
    {
        return view('pages.teacher-course.index');
    }

    public function create(): View
    {
        $data['course'] = new Course();
        $data['topics'] = new Collection();
        $data['quizzes'] = new Collection();

        return view('pages.teacher-course.new', $data);
    }

    public function edit(Course $course): View
    {
        $data['course'] = $course;
        $data['topics'] = $course->topics()->with('lessons')->get();
        $data['quizzes'] = $course->questions()->with('quiz_options')->get();

        return view('pages.teacher-course.edit', $data);
    }

    public function store(TeacherCourseStoreRequest $request): RedirectResponse
    {
        $data['course_title'] = $request['course_title'];
        $data['industry_id'] = $request['industry'];
        $data['course_price'] = $request['course_price'];
        $data['course_description'] = $request['course_description'];

        $data['topic_list'] = json_decode($request['topic_list'], true);
        $data['quiz_list'] = json_decode($request['quiz_list'], true);
        $data['quiz_active'] = isset($request['quiz_active']) ? 1 : 0;
        $data['is_published'] = $request['is_published'];

        $lesson_nums = 0;
        foreach($data['topic_list'] as $topic) {
            $lesson_nums += count($topic['lessons']);
        }
        if ($lesson_nums == 0) {
            return back()->with('danger', __('You need at least one topic and lesson.'));
        }

        $data['course_image'] = asset('images/logo/course.jpg');
        if ($request->hasFile('course_image')) {
            $image = $request->file('course_image');
            $image_name = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('upload/course'), $image_name);
            $data['course_image'] = asset('upload/course/' . $image_name);
        }

        $this->courseService->createCourse($data);

        return redirect()->route('teacher.course.index', $data['is_published'] == 1 ? 'type=publish' : 'type=draft');
    }
}
