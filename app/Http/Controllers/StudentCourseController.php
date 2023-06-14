<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Services\Course\CourseService;
use Illuminate\View\View;

class StudentCourseController extends Controller
{
    public CourseService $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
        $this->authorizeResource(Course::class);
    }

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

    public function lesson_complete(): void
    {
        $course_id = request('course_id');
        $lesson_id = request('lesson_id');

        $this->courseService->completeLesson($course_id, $lesson_id);
    }

    public function question_complete(): void
    {
        $course_id = request('course_id');
        $question_id = request('question_id');
        $question_options = request('question_options');

        $this->courseService->completeQuestion($course_id, $question_id, $question_options);
    }
}
