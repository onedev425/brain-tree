<?php

namespace App\Http\Livewire;

use App\Mail\SendinblueMail;
use App\Models\Course;
use App\Services\EmailService;
use App\Services\Payment\PaypalService;
use App\Services\Student\StudentService;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class StudentPricingBuyCourse extends Component
{
    use WithPagination;

    public string $search = '';
    private StudentService $studentService;

    public function mount(StudentService $studentService)
    {
        $this->studentService = $studentService;
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
                    return back()->with('danger', __('Email sending failed: ') . $result);
            }
            else
                return back()->with('danger', __('Email sending failed: ') . $result);

        }
        else
            return redirect($payment_result['redirect_url'])->with('error', __('Something went wrong.'));
    }

    public function paginationView()
    {
        return 'components.datatable-pagination-links-view';
    }

    public function render()
    {
        if (!isset($this->studentService)) {
            $this->studentService = app(StudentService::class);
        }

        $courses = $this->studentService->getStudentUnpaidCourses($this->search);
        $courses = $courses->paginate(10);

        return view('livewire.student-pricing-buy-course', [
            'courses' => $courses,
        ]);
    }
}
