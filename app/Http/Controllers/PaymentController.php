<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Services\Admin\AdminPricingService;
use App\Services\Payment\PaypalService;
use App\Services\Student\StudentService;
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
            if ($request['payer'] == 'super-admin') {
                $adminPricingService = app(AdminPricingService::class);
                $adminPricingService->registerPayout(
                    $request['teacher'],
                    $request['course_amount'],
                    $request['amount']
                );
                return redirect()->route('pricing.index', 'type=payout');
            }

            if ($request['payer'] == 'student') {
                $studentService = app(StudentService::class);
                $studentService->registerStudentCourse($request['course']);

                return redirect()->route('student.course.index');
            }
        }
        else {
            if ($request['payer'] == 'super-admin') {
                return redirect()->route('pricing.index', 'type=payout')->with('danger', __('Something went wrong. Your payment failed.'));
            }

            if ($request['payer'] == 'student') {
                return redirect()->route('pricing.index')->with('danger', __('Something went wrong. Your payment failed.'));
            }
        }

    }
    public function connectCancel(Request $request): RedirectResponse
    {
        if ($request['payer'] == 'super-admin') {
            return redirect()->route('pricing.create')->with('danger', __('Payment cancelled by the user.'));
        }
        else {
            // go to the student pricing page
            return redirect()->route('pricing.index')->with('danger', __('Payment cancelled by the user.'));
        }
    }

    public function createOrder(Request $request): array
    {
        $data = $request->json()->all();
        $course = Course::find($data['course_id']);
        $paypalService = new PaypalService();

        return $paypalService->buyCourse($course);
    }
}
