<?php

namespace App\Http\Controllers;

use App\Services\Payment\PaypalService;
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
        $paypalService->capturePayment($request['token']);

        //return 'Paid successfully';
    }
    public function connectCancel()
    {
        return 'cancelled payment';
    }
}
