<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PricingPaypalForm extends Component
{
    public string $connection_date;
    public string $error_message;

    public function mount()
    {
        $teacher = auth()->user();
        $this->connection_date = $teacher->payment_connection ? $teacher->payment_connection->created_at : '';
        $this->error_message = (Request::has('message') && Request::filled('message')) ? Request::input('message') : '';
    }

    public function render()
    {
        return view('livewire.pricing-paypal-form');
    }

    public function connectToPayPal()
    {
        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $provider->setAccessToken($paypalToken);
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.callback'),
                "cancel_url" => route('paypal.cancel'),
            ],
            "purchase_units" => [
                0 => [
                    "payee" => [
                        "merchant_id" => '3HWTXNR8QJ3CL'
                    ],
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "75.00"
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('cancel.payment')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('home')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

}
