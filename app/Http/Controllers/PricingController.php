<?php

namespace App\Http\Controllers;

use App\Services\Payment\PaypalService;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PricingController extends Controller
{
    public function index()
    {
        // $this->authorize('viewAny', [User::class, 'teacher']);
        return view('pages.pricing.index');
    }

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
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()
                ->route('create.payment')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('create.payment')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }

        //return 'Paid successfully';
    }
    public function connectCancel()
    {

    }


}
