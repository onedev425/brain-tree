<?php
namespace App\Services\Payment;

use App\Models\Course;
use App\Models\PaymentConnection;
use App\Models\PaymentFee;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

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
                "return_url" => route('paypal.callback', 'buyer=teacher&course=' . $course->id),
                "cancel_url" => route('paypal.cancel', 'buyer=teacher&course=' . $course->id),
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
