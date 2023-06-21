<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Services\Course\CourseService;
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
            if ($request['buyer'] == 'teacher') {
                $courseService = new CourseService();
                $courseService->setPaidFlag($request['course']);

                return redirect()->route('teacher.course.index', 'type=publish');
            }

            if ($request['buyer'] == 'student') {
                $studentService = app(StudentService::class);
                $studentService->registerStudentCourse($request['course']);

                return redirect()->route('student.course.index');
            }
        }
        else {
            if ($request['buyer'] == 'teacher') {
                if ($request['course']) {
                    $course = Course::find($request['course']);
                    $course->is_published = false;
                    $course->is_paid = false;
                    $course->save();
                }

                return redirect()->route('teacher.course.index', 'type=publish')->with('danger', __('Something went wrong. Your payment failed.'));
            }

            if ($request['buyer'] == 'student') {
                return redirect()->route('pricing.index')->with('danger', __('Something went wrong. Your payment failed.'));
            }
        }

    }
    public function connectCancel(Request $request): RedirectResponse
    {
        if ($request['buyer'] == 'teacher') {
            if ($request['course']) {
                $course = Course::find($request['course']);
                $course->is_published = false;
                $course->is_paid = false;
                $course->save();
            }
            return redirect()->route('teacher.course.create')->with('danger', __('Payment cancelled by the user.'));
        }
        else {
            // go to the student pricing page
            return redirect()->route('pricing.index')->with('danger', __('Payment cancelled by the user.'));
        }
    }
}
