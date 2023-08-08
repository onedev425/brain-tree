<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseFeedback;
use App\Services\Course\CourseService;
use App\Services\Student\StudentService;
use App\Services\EmailService;
use Illuminate\View\View;
use GuzzleHttp\Client;

class StudentCourseController extends Controller
{
    public CourseService $courseService;
    public StudentService $studentService;

    public function __construct(CourseService $courseService, StudentService $studentService)
    {
        $this->courseService = $courseService;
        $this->studentService = $studentService;
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

    public function review_approve(): void
    {
        $review_ids = request('review_ids');
        $is_approved = request('is_approved');

        $this->studentService->approveReview($review_ids, $is_approved);
    }

    public function review_trash(): void
    {
        $review_ids = request('review_ids');

        $this->studentService->trashReview($review_ids);
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

    public function feedback_register(): void
    {
        $course_id = request('course_id');
        $star_nums = request('star_nums');
        $feedback_content = request('feedback_content');

        $course_feedback = CourseFeedback::create([
            'student_id' => auth()->user()->id,
            'course_id' => $course_id,
            'rate' => $star_nums,
            'content' => $feedback_content,
            'is_approved' => false
        ]);

        $course = Course::find($course_id);
        $email_data = [
            'to' => $course->assignedTeacher->email,
            'subject' => __('Course Feedback'),
            'user_name' => $course->assignedTeacher->name,
            'email_type' => 'course_feedback',
            'course_name' => $course->title,
            'feedback_rate' => $star_nums,
            'feedback_content' => $feedback_content
        ];

        $email_service = new EmailService($email_data);
        $email_service->sendEmail();
    }

    public function reviews(): View
    {
        return view('pages.student.reviews');
    }
}
