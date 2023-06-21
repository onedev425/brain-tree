<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class TeacherPricingPaymentMethod extends Component
{
    public string $connection_date;
    public string $error_message;

    public function mount()
    {
        $teacher = auth()->user();
        $this->connection_date = $teacher->payment_connection ? $teacher->payment_connection->created_at : '';
        $this->error_message = (Request::has('message') && Request::filled('message')) ? Request::input('message') : '';
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
                [
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => '28.00', // Set the payment amount here
                    ],
                    'payee' => [
                        'merchant_id' => '3HWTXNR8QJ3CL', // Seller's PayPal email address
                    ],
                    'payment_instruction' => [
                        'disbursement_mode' => 'INSTANT',
                        'platform_fees' => [
                            [
                                'amount' => [
                                    'currency_code' => 'USD',
                                    'value' => '3.00',
                                ],
                                "payee" => [
                                    "merchant_id" => '2AXESEJWXMTRY'
                                ],
                            ]
                        ]
                    ]
                ],

//                0 => [
//                    "reference_id" => "REFID-1",
//                    "payee" => [
//                        "merchant_id" => '3HWTXNR8QJ3CL'
//                    ],
//                    "amount" => [
//                        "currency_code" => "USD",
//                        "value" => "20.00"
//                    ],
//                ],
//                1 => [
//                    "reference_id" => "REFID-2",
//                    "payee" => [
//                        "email_address" => 'sb-0bysf26369533@business.example.com'
//                    ],
//                    "amount" => [
//                        "currency_code" => "USD",
//                        "value" => "5.00"
//                    ],
//                ],
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

    public function render()
    {
        return view('livewire.teacher-pricing-payment-method');
    }
}
