<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Services\Payment\PaypalService;
use App\Services\Student\StudentService;
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

    public function BuyCourse(int $course_id, string $seller_account_id)
    {
        $course = Course::find($course_id);
        $paypalService = new PaypalService();
        $payment_result = $paypalService->buyCourse($course, $seller_account_id);

        if ($payment_result['result'] == 'success')
            return redirect()->away($payment_result['redirect_url']);
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
