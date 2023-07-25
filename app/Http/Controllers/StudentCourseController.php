<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseFeedback;
use App\Services\Course\CourseService;
use App\Services\EmailService;
use Illuminate\View\View;
use GuzzleHttp\Client;

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

    /**
     * Comment on the course
     */
    private function commentCourseWithWP($wp_course_id, $auther, $email, $content, $rating)
    {
        $client = new Client();
        $industry = Industry::find($data['industry_id']);

        try {
            $response = $client->request('POST', "https://braintreespro.com/wp-json/sync-api/v1/comments", [
                'form_params' => [
                    'comment_post_ID' => $wp_course_id,
                    'comment_author' => $auther,
                    'comment_author_email' => $email,
                    'comment_content' => $content,
                    'rating' => $rating
                ],
            ]);
            $responseBody = $response->getBody()->getContents();
            $data = json_decode($responseBody, true);
            $courseId = null;

            if (isset($data['course_id'])) {
                $courseId = $data['course_id'];
            }

            return $courseId;
        } catch(\Exception $e) {
            Log::error('An error occurred: ' . $e->getMessage(), [
                'exception' => $e,
            ]);

            return null;
        }
    }

    public function feedback_register(): void
    {
        $course_id = request('course_id');
        $star_nums = request('star_nums');
        $feedback_content = request('feedback_content');

        CourseFeedback::create([
            'student_id' => auth()->user()->id,
            'course_id' => $course_id,
            'rate' => $star_nums,
            'content' => $feedback_content
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

        if ($course->wp_course_id)
        {
            $this->commentCourseWithWP($course->wp_course_id, auth()->user()->name, auth()->user()->email, $feedback_content, $star_nums);
        }

        $email_service = new EmailService($email_data);
        $email_service->sendEmail();
    }
}
