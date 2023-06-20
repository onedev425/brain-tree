<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class PricingController extends Controller
{
    private array $paypal_config;

    public function __construct()
    {
        $paypal_config = config('paypal');
        $this->paypal_config = $paypal_config['mode'] == 'sandbox' ? $paypal_config['sandbox'] : $paypal_config['live'];
    }

    public function index()
    {
        // $this->authorize('viewAny', [User::class, 'teacher']);
        return view('pages.pricing.index');
    }

    public function connect()
    {
        $client = new Client();

        try {
            $response = $client->request('POST', $this->paypal_config['api_server'] . '/v1/oauth2/token', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Accept-Language' => 'en_US',
                ],
                'auth' => [
                    $this->paypal_config['client_id'], // Replace with your actual client ID
                    $this->paypal_config['client_secret'], // Replace with your actual secret key
                ],
                'form_params' => [
                    'grant_type' => 'client_credentials',
                ],
            ]);

            $body = json_decode($response->getBody(), true);
            $accessToken = $body['access_token'];

            // Use the access token for further API calls
            return $this->getPaypalAuthLink($accessToken);

            return "Access token: " . $accessToken;
        } catch (GuzzleException $e) {
            // Handle any errors that occur during the API request
            return $e->getMessage();
        }

    }

    public function connectPaypalSuccess(Request $request)
    {
        return 'authorized successfully';
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
    public function connectPaypalCancel()
    {

    }

    private function getPaypalAuthLink($token)
    {
        $client = new Client();

        try {
            $response = $client->request('POST', $this->paypal_config['api_server'] . '/v2/customer/partner-referrals', [
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
            return redirect($redirect_uri);

        } catch (GuzzleException $e) {
            // Handle any errors that occur during the API request
            return $e->getMessage();
        }

    }
}
