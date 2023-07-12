<?php

namespace App\Http\Livewire;

use App\Mail\SendinblueMail;
use App\Models\Course;
use App\Services\Payment\PaypalService;
use App\Services\Student\StudentService;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

class StudentPricingBuyCourse extends Component
{
    use WithPagination;

    public string $search = '';
    private StudentService $studentService;

    public function mount(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function BuyCourse(int $course_id)
    {
        $course = Course::find($course_id);
        $paypalService = new PaypalService();
        $payment_result = $paypalService->buyCourse($course);

        if ($payment_result['result'] == 'success') {
            $email_data = [
                'to' => auth()->user()->email,
                'subject' => __('Purchase a course'),
                'user_name' => auth()->user()->name,
                'email_type' => 'buy_course',
                'course_name' => $course->title,
                'course_price' => $course->price,
            ];
            Mail::to($email_data['to'])->send(new SendinblueMail($email_data));

            $email_data = [
                'to' => $course->assignedTeacher->email,
                'subject' => __('Purchase a course'),
                'user_name' => $course->assignedTeacher->name,
                'email_type' => 'selling_course',
                'student_name' => auth()->user()->name,
                'course_name' => $course->title,
                'course_price' => $course->price,
            ];
            Mail::to($email_data['to'])->send(new SendinblueMail($email_data));

            return redirect()->away($payment_result['redirect_url']);
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
