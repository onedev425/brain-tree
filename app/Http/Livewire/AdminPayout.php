<?php

namespace App\Http\Livewire;

use App\Models\PaymentFee;
use App\Models\User;
use App\Services\Admin\AdminPricingService;
use App\Services\Payment\PaypalService;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class AdminPayout extends Component
{
    use WithPagination;
    public string $unique_id;
    public string $search = '';
    public string $billing_period = '';
    public int $per_page = 10;
    public $course_fee;
    public array $payout_amounts  = [];

    public function mount($unique_id = null, $per_page = 10)
    {
        $this->unique_id = $unique_id ?? Str::random(10);
        $this->per_page = $per_page;
        $this->billing_period = date('Y-m', strtotime('last month'));
        $this->course_fee = PaymentFee::where('fee_type', 'teacher_course_fee')->first();
    }

    public function paginationView()
    {
        return 'components.datatable-pagination-links-view';
    }

    public function payOut(int $teacher_id, int $course_amount)
    {
        $teacher = User::find($teacher_id);
        $payee_account_id = $teacher->payment_connection->paypal_account_id;
        $paypalService = new PaypalService();
        $payment_result = $paypalService->PayoutToInstructor(
            $teacher_id,
            $course_amount,
            $payee_account_id,
            $this->payout_amounts[$teacher_id]
        );

        if ($payment_result['result'] == 'success')
            return redirect()->away($payment_result['redirect_url']);
        else
            return redirect($payment_result['redirect_url'])->with('error', __('Something went wrong.'));
    }

    public function render()
    {
        $adminPricingService = app(AdminPricingService::class);
        $teachers = $adminPricingService->getSoldCoursesOfTeacher($this->billing_period, $this->search);
        $teachers = $teachers->paginate(10);

        return view('livewire.admin-payout', [
            'teachers' => $teachers,
        ]);
    }
}
