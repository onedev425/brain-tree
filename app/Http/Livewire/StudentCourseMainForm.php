<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Services\Course\CourseService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use App\Services\Payment\PaypalService;
use App\Services\EmailService;
use App\Mail\SendinblueMail;
use Illuminate\Support\Facades\Mail;

class StudentCourseMainForm extends Component
{
    public string $activeTab = 'progress';
    public Collection $progress_courses;
    public Collection $completed_courses;
    public Collection $available_courses;

    public function mount(CourseService $courseService): void
    {
        $this->progress_courses = $courseService->getCourses('progress');
        $this->completed_courses = $courseService->getCourses('completed');
        $this->available_courses = $courseService->getCourses('available');
    }

    public function setTab($tab): void
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.student-course-main-form');
    }

    public function getCourseProgressPercent(Course $course): int
    {
        $courseService = new CourseService();
        return $courseService->getCourseProgressPercent($course);
    }

    private function syncMostPurchasedCourses()
    {
        $client = new Client();
        $query = "
            SELECT C.wp_course_id, paid_nums FROM (
                SELECT course_id, SUM(1) paid_nums, SUM(paid_amount) paid_amount FROM payment_purchases GROUP BY course_id
            ) T INNER JOIN courses C ON T.course_id = C.id 
            ORDER BY paid_nums DESC LIMIT 9";
        
        $courses = DB::select($query);
        $response = $client->request('POST',env('WP_API_SYNC_BASE_URL') . "/wp-json/sync-api/v1/courses/most", [
            'form_params' => [ 'courses' => $courses ]
        ]);
    }

    public function BuyCourse(int $course_id)
    {
        $course = Course::find($course_id);
        $paypalService = new PaypalService();
        $payment_result = $paypalService->buyCourse($course);

        if ($payment_result['result'] == 'success') {
            $this->syncMostPurchasedCourses();
            $email_data = [
                'to' => auth()->user()->email,
                'subject' => __('Purchase a course'),
                'user_name' => auth()->user()->name,
                'email_type' => 'buy_course',
                'course_name' => $course->title,
                'course_price' => $course->price,
            ];
            $email_service = new EmailService($email_data);
            $result = $email_service->sendEmail();

            if ($result == 'success') {
                $email_data = [
                    'to' => $course->assignedTeacher->email,
                    'subject' => __('Purchase a course'),
                    'user_name' => $course->assignedTeacher->name,
                    'email_type' => 'selling_course',
                    'student_name' => auth()->user()->name,
                    'course_name' => $course->title,
                    'course_price' => $course->price,
                ];
                $email_service = new EmailService($email_data);
                $result = $email_service->sendEmail();
                if ($result == 'success')
                    return redirect()->away($payment_result['redirect_url']);
                else
                    return back()->with('notify', __('Email sending failed: ') . $result);
            }
            else
                return back()->with('notify', __('Email sending failed: ') . $result);

        }
        else
            return redirect($payment_result['redirect_url'])->with('error', __('Something went wrong.'));
    }
}
