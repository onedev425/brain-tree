<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\Payment\PaypalService;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class BuyCourseView extends Component
{
    public $course;
    public $lessons;
    public $questions;

    public function buyCourse()
    {
        $paypalService = new PaypalService();
        $payment_result = $paypalService->buyCourse($this->course);

        if ($payment_result['result'] == 'success') {
           return redirect()->away($payment_result['redirect_url']);
        }
        else
            return redirect($payment_result['redirect_url'])->with('error', __('Something went wrong.'));
    }

    public function render()
    {
        return view('livewire.buy-course-view');
    }
}
