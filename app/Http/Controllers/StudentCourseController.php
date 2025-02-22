<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseFeedback;
use App\Models\Lesson;
use App\Models\Announcement;
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

    public function show(Course $course)
    {
        if (auth()->user()->hasRole('teacher')) {
            return view('profile.show');
        }

        $available_courses = $this->studentService->getStudentPaidCourses('')->get();
        $is_buy_course = false;
        foreach($available_courses as $available_course) {
            if ($course->id == $available_course->id) {
                $is_buy_course = true;
                break;
            }
        }
        if (! $is_buy_course) return redirect()->route('student.course.buy', $course->id);

        // Append announcements
        $course->announcements = $this->course_announcements($course->id);

        $data['course'] = $course;
        $data['topics'] = $course->topics()->with('lessons')->get();
        $data['quizzes'] = $course->questions()->with('quiz_options')->get();
        $data['passed_exam'] = $this->courseService->isPassedFromCourseExam($course);

        return view('pages.student-course.show', $data);
    }

    // In Course.php model or relevant controller
    public function course_announcements($courseId)
    {
        // Retrieve announcements for the given course ID
        return Announcement::where('course_id', $courseId)
            ->select('title', 'content', 'attachment_file') // Select only the necessary fields
            ->get();
    }

    public function buy(Course $course): View
    {
        if (!auth()->user()->hasRole('student')) {
            return view('profile.show');
        }

        $available_courses = $this->studentService->getStudentPaidCourses('')->get();
        $is_buy_course = false;
        foreach($available_courses as $available_course) {
            if ($course->id == $available_course->id) {
                $is_buy_course = true;
                break;
            }
        }
        // Append is buy flag
        $course->is_buy_course = $is_buy_course;

        $data['course'] = $course;
        $data['topics'] = [];
        $data['lessons'] = [];
        $data['questions'] = [];
        $topics = $course->topics()->with('lessons')->get();
        $lessons = $course->lessons()->get();
        $questions = $course->questions()->get();

        $video_duration = Lesson::selectRaw('SUM(video_duration) as total_duration')
            ->where('course_id', $course->id)
            ->value('total_duration');
        $courseService = new CourseService();
        $data['video_duration'] = is_null($video_duration) ? 0 : $courseService->convertDurationFromSeconds($video_duration);

        foreach($topics as $topic) {
            $topic_lessons = [];
            foreach($topic->lessons as $lesson) {
                $lesson_info = [
                    'title' => $lesson->title,
                    'duration' => $courseService->getLessonVideoDuration($lesson->video_duration)
                ];

                $topic_lessons[] = $lesson_info;
            }
            $topic_info = [
                'title' => $topic->description,
                'lessons' => $topic_lessons,
                'duration' => $courseService->getTopicVideoDuration($topic)
            ];
            $data['topics'][] = $topic_info;
        }

        foreach($lessons as $lesson) {
            $data['lessons'][] = $lesson->title;
        }

        foreach($questions as $question) {
            $data['questions'][] = $question->title;
        }

        return view('pages.student-course.buy', $data);
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

        $this->studentService->updateReview($review_ids, $is_approved);
    }

    public function review_trash(): void
    {
        $review_ids = request('review_ids');

        $this->studentService->updateReview($review_ids, false);
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
