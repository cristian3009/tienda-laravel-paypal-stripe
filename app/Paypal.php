<?php

namespace App;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;

class Paypal
{
    private PayPalHttpClient $client;

    public function __construct()
    {
        $this->client = new PayPalHttpClient(
            new SandboxEnvironment(config('services.paypal.key'), config('services.paypal.secret'))
        );
    }

    public function paypalPaymentRequest($amount)
    {
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');

        $request->body = [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'reference_id' => 'test_ref_id_1',
                    'amount' => [
                        'value' => $amount,
                        'currency_code' => 'USD'
                    ]
                ]
            ],
            'application_context' => [
                'cancel_url' => route('paypal.checkout', ['status' => 'failure']),
                'return_url' => route('paypal.checkout', ['status' => 'success'])
            ]
        ];

        try {

            $response = $this->client->execute($request);

            $approvalUrl = null;

            foreach ($response->result->links as $link)
            {
                if ($link->rel === 'approve')
                {
                    $approvalUrl = $link->href;
                }
            }

            return $approvalUrl;

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function checkout($request)
    {
        $request = new OrdersCaptureRequest($request->token);
        $request->prefer('return=representation');

        try {
            return $this->client->execute($request);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }
}
