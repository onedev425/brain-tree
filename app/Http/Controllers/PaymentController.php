<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Services\Course\CourseService;
use App\Services\Payment\PaypalService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function connect()
    {
        $paypalService = new PaypalService();
        $result = $paypalService->connect();

        if ($result['connect_result'] == 'success')
            return redirect($result['redirect_url']);
        else
            return redirect()->route('pricing.index', 'type=payment_method&message=' . $result['message']);
    }

    public function connectSuccess(Request $request)
    {
        $paypalService = new PaypalService();
        $paypalService->createPaymentConnection($request['merchantIdInPayPal']);
        return redirect()->route('pricing.index', 'type=payment_method');
    }

    public function connectCallback(Request $request)
    {
        $paypalService = new PaypalService();
        $capture_result = $paypalService->capturePayment($request['token']);

        if ($capture_result) {
            if ($request['buyer'] == 'teacher') {
                $courseService = new CourseService();
                $courseService->setPaidFlag($request['course']);

                return redirect()->route('teacher.course.index', 'type=publish');
            }
        }
        else {
            if ($request['buyer'] == 'teacher') {
                $course = Course::find($request['course']);
                $course->delete();

                return redirect()->route('teacher.course.index', 'type=publish')->with('danger', __('Something went wrong. Your payment failed.'));
            }
        }

    }
    public function connectCancel(Request $request): RedirectResponse
    {
        if ($request['buyer'] == 'teacher') {
            if ($request['course']) {
                $course = Course::find($request['course']);
                $course->delete();
            }
            return redirect()->route('teacher.course.create')->with('danger', __('Payment cancelled by the user.'));
        }
        return redirect()->route('teacher.course.create')->with('danger', __('Payment cancelled by the user.'));
    }
}
