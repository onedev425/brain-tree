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
        $data['passed_exam'] = $this->courseService->isPassedFromCourseExam($course);

        return view('pages.student-course.show', $data);
    }

    public function lesson_complete(): void
    {
        $course_id = request('course_id');
        $lesson_id = request('lesson_id');

        $this->courseService->completeLesson($course_id, $lesson_id);
    }

    public function question_complete(): bool
    {
        $course_id = request('course_id');
        $question_id = request('question_id');
        $question_options = request('question_options');
        $is_latest_question = request('is_latest_question');

        return $this->courseService->completeQuestion($course_id, $question_id, $question_options, $is_latest_question);
    }

    public function question_clear(): void
    {
        $course_id = request('course_id');
        $this->courseService->clearQuestion($course_id);
    }
}
