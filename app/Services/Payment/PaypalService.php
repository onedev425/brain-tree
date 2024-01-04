<?php
namespace App\Services\Payment;

use App\Models\User;
use App\Models\Course;
use App\Models\PayoutHistory;
use App\Models\PaymentConnection;
use App\Models\PaymentFee;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;

class PaypalService
{
    private array $config;

    public function __construct()
    {
        $paypal_config = config('paypal');
        $this->config = $paypal_config['mode'] == 'sandbox' ? $paypal_config['sandbox'] : $paypal_config['live'];
    }

    public function connect()
    {
        $client = new Client();

        try {
            $response = $client->request('POST', $this->config['api_server'] . '/v1/oauth2/token', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Accept-Language' => 'en_US',
                ],
                'auth' => [
                    $this->config['client_id'], // Replace with your actual client ID
                    $this->config['client_secret'], // Replace with your actual secret key
                ],
                'form_params' => [
                    'grant_type' => 'client_credentials',
                ],
            ]);

            $body = json_decode($response->getBody(), true);
            $accessToken = $body['access_token'];

            // Use the access token for further API calls
            return $this->getPaypalAuthLink($accessToken);
        } catch (GuzzleException $e) {
            // Handle any errors that occur during the API request
            return ['connect_result' => 'failure', 'message' => $e->getMessage()];
        }

    }

    public function createPaymentConnection(string $account_id): void
    {
        $course = PaymentConnection::create([
            'teacher_id' => auth()->user()->id,
            'paypal_account_id'  => $account_id,
        ]);
    }

    public function payToCourse(Course $course): array
    {
        $course_fee = PaymentFee::all()->where('fee_type', 'teacher_course_fee')->first();

        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $provider->setAccessToken($paypalToken);
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.callback', 'payer=teacher&course=' . $course->id),
                "cancel_url" => route('paypal.cancel', 'payer=teacher&course=' . $course->id),
            ],
            "purchase_units" => [
                [
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => $course_fee->fee_value,
                    ],
                ],

            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return ['result' => 'success', 'redirect_url' => $links['href']];
                }
            }
        }

        $course->is_published = false;
        $course->is_paid = false;
        $course->save();
        return ['result' => 'error', 'redirect_url' => route('home')];
    }


    public function buyCourse(Course $course): array
    {
        $course_fee = PaymentFee::all()->where('fee_type', 'student_course_fee_percent')->first();

        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $provider->setAccessToken($paypalToken);
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.callback', 'payer=student&course=' . $course->id),
                "cancel_url" => route('paypal.cancel', 'payer=student&course=' . $course->id),
            ],
            "purchase_units" => [
                [
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => $course->price,
                    ],
                ],

            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return ['result' => 'success', 'redirect_url' => $links['href'], 'id' => $response['id']];
                }
            }
        }
        return ['result' => 'error', 'redirect_url' => route('home'), 'id' => 0];
    }

    public function payoutSchedule() {
        $users = User::where('payout_active', true)
            ->whereDate('payout_at', '=', Carbon::today())
            ->get();

        $items = array();
        $payout_list = array();
        foreach ($users as $user) {
            $teacher_id = $user->id;
            $latest_payout = $user->latest_payout_history();
            // Get earning amount in a month
            $earning_price = Course::whereHas('payment_purchases', function ($query) use($teacher_id){
            $query->where('created_at', '>=', isset($latest_payout) ? $latest_payout->created_at : '1970-01-01')
                ->where('payment_status', '=', 'completed')
                ->whereHas('course', function ($courseQuery) use ($teacher_id) {
                    $courseQuery->where('assigned_id', $teacher_id);
                });
            })
            ->get()
            ->sum(function ($course) {
                return $course->payment_purchases->sum('paid_amount');
            });
            $payment_connection = PaymentConnection::where('teacher_id', $user->id)->first();
            $payout_amount = $earning_price * $user->fee_amount / 100;

            if ($payment_connection && $payment_connection->paypal_account_id && $earning_price > 0) {
                $senderItemId = Uuid::uuid4()->toString();
                $item = [
                    'recipient_type' => 'PAYPAL_ID',
                    'amount' => [
                        "value" => 10,
                        "currency"=> "USD"
                    ],
                    "note" => "Monthly payout completed",
                    "sender_item_id" => $senderItemId,
                    "receiver" => $payment_connection->paypal_account_id
                ];

                $items[] = $item;
                $payout_list[] = [
                    'user_id' => $user->id,
                    'amount' => $payout_amount
                ];
            }
        }

        if (count($items) > 0) {
            $senderBatchHeader = [
                "sender_batch_id" => "Payouts_".time().mt_rand(1000, 9999),
                "email_subject" => "You have a payout from braintreespro",
                "email_message" => "You have received a payout! Thanks or using braintreespro"
            ];
            $data = json_encode([
                "sender_batch_header" => $senderBatchHeader,
                "items" => $items
            ], JSON_PRETTY_PRINT);

            $provider = new PayPalClient();
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();
            $provider->setAccessToken($paypalToken);

            $response = $provider->createBatchPayout(json_decode($data, true));

            if (!isset($response['error'])) {
                foreach($payout_list as $payout) {
                    $user = User::find($payout['user_id']);
                    $user->payout_at = Carbon::now()->addDays(30);
                    $user->last_paid_at = Carbon::now();
                    $user->save();
                    PayoutHistory::create([
                        'teacher_id' => $payout['user_id'],
                        'paid_amount' => $payout['amount'],
                        'payment_status' => 'completed'
                    ]);
                }
            }
        }
    }

    public function PayoutToInstructor(int $teacher_id, int $course_amount, string $payee_account_id, int $amount): array
    {
        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $provider->setAccessToken($paypalToken);

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.callback', 'payer=super-admin&teacher=' . $teacher_id . '&course_amount=' . $course_amount . '&amount=' . $amount),
                "cancel_url" => route('paypal.cancel', 'payer=super-admin&teacher=' . $teacher_id . '&course_amount=' . $course_amount . '&amount=' . $amount),
            ],
            "purchase_units" => [
                [
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => $amount
                    ],
                    'payee' => [
                        'merchant_id' => $payee_account_id,
                    ],
                    /*'payment_instruction' => [
                        'disbursement_mode' => 'INSTANT',
                        'platform_fees' => [
                            [
                                'amount' => [
                                    'currency_code' => 'USD',
                                    'value' => $course->price * $course_fee->fee_value / 100,
                                ]
                            ]
                        ]
                    ]*/
                ],

            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return ['result' => 'success', 'redirect_url' => $links['href']];
                }
            }
        }
        return ['result' => 'error', 'redirect_url' => route('home')];
    }

    public function capturePayment(string $token): bool
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($token);

        return isset($response['status']) && $response['status'] == 'COMPLETED';
    }

    private function getPaypalAuthLink($token): array
    {
        $client = new Client();

        try {
            $response = $client->request('POST', $this->config['api_server'] . '/v2/customer/partner-referrals', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $token, // Replace with your actual access token
                ],
                'json' => [
                    'tracking_id' => auth()->user()->email,
                    'partner_config_override' => [
                        'return_url' => route('paypal.connect_success')
                    ],
                    'operations' => [
                        [
                            'operation' => 'API_INTEGRATION',
                            'api_integration_preference' => [
                                'rest_api_integration' => [
                                    'integration_method' => 'PAYPAL',
                                    'integration_type' => 'THIRD_PARTY',
                                    'third_party_details' => [
                                        'features' => [
                                            'PAYMENT',
                                            'REFUND',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'products' => [
                        'EXPRESS_CHECKOUT',
                    ],
                    'legal_consents' => [
                        [
                            'type' => 'SHARE_DATA_CONSENT',
                            'granted' => true,
                        ],
                    ],
                ],
            ]);

            $statusCode = $response->getStatusCode();
            $responseData = json_decode($response->getBody(), true);

            // Handle the API response based on the status code and response data
            $redirect_uri = $responseData['links'][1]['href'];
            return ['connect_result' => 'success', 'redirect_url' => $redirect_uri];

        } catch (GuzzleException $e) {
            // Handle any errors that occur during the API request
            return ['connect_result' => 'failure', 'message' => $e->getMessage()];
        }

    }
}
