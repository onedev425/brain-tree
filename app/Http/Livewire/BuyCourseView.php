<?php

namespace App\Http\Livewire;

use App\Services\Course\CourseService;
use Livewire\Component;
use App\Services\Payment\PaypalService;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class BuyCourseView extends Component
{
    public $course;
    public $topics;
    public $lessons;
    public $questions;
    public $video_duration;
    public $showModal = false;
    public $paypal_config;

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
        $config = config('paypal');
        $this->paypal_config = $config['mode'] == 'sandbox' ? $config['sandbox'] : $config['live'];
        return view('livewire.buy-course-view');
    }
}
