<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Omnipay\Omnipay;
use App\Models\Payment;
use Exception;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{

    private $gateway;

    public function __construct()
    {
        // $this->gateway = Omnipay::create('PayPal_Rest');
        // $this->gateway->setClientId(env('PAYPAL_SANDBOX_CLIENT_ID'));
        // $this->gateway->setSecret(env('PAYPAL_SANDBOX_CLIENT_SECRET'));
        // $this->gateway->setTestMode(env('PAYPAL_TEST_MODE'));

        

        

        
    }

    public function index()
    {

    }

    public function charge(Request $request)
    {
        $paypal_public = env('PAYPAL_SANDBOX_CLIENT_ID');
        $paypal_secret = env('PAYPAL_SANDBOX_CLIENT_SECRET');
        $this->paypal_url = env('PAYPAL_API_URL');
        $this->paypalAuth = Http::asForm()
            ->withBasicAuth($paypal_public, $paypal_secret)
            ->post($this->paypal_url.'v1/oauth2/token', [
            'grant_type' => 'client_credentials'
        ])->throw()->json();
        $this->cancel_url = env('APP_URL').'payment';
        $this->success_url = env('APP_URL').'payment/approve';
        try {
            $amount = $request->input('amount');
            
            $body = [
                "intent" => "CAPTURE",
                "purchase_units" => [[
                    "amount" => [
                        "currency_code" => "EUR",
                        "value" => number_format($amount, 2, '.', ' ') ?? '0'
                    ],
                    "description" => 'Tst'
                ]],
                'application_context' => [
                    'return_url' => $this->success_url,
                    'cancel_url' => $this->cancel_url,
                    'locale' => 'fr'
                ]
            ];

            $order = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->paypalAuth['access_token'],
             ])->post($this->paypal_url.'v2/checkout/orders', $body)
             ->throw()->json();
            
            if (count($order['links'])) {
                $this->savePayment($order, $amount, 'pending');
                foreach ($order['links'] as $link) {
                    if ($link['rel'] == 'approve') return $link['href'];
                }
            }
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }
    }

    public function approve(Request $request)
    {
        $token = $request->token;
        $params = Payment::where('payment_id', $token)->fist();

        // return error if no order corresponds to a token
        if (!$params) {
            return response()->json(['error' => 'The given token was invalid.'], 200);
        }

        $body = [
            "payment_source" => [
                "token" => [
                    'id' => $token,
                    'type' => 'BILLING_AGREEMENT'
                ]
            ]
        ];
        $capture = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->paypalAuth['access_token'],
        ])->post($this->paypal_url.'/v2/checkout/orders/'.$token.'/capture', $body)
        ->throw()->json();
        $this->updatePaidPayment($token);
    }

    public function updatePaidPayment($paymentID)
    {
        $payment = Payment::where('payment_id', $paymentID)->fist();
        $payment->payment_status = 'paid';
        $payment->save();
    }

    public function savePayment($order, $amount, $status)
    {
        $payment = new Payment;
        $payment->payment_id = $order['id'];
        $payment->payee_id = 1;
        $payment->payee_email = 'test@email.com';
        $payment->amount = $amount;
        $payment->currency = env('PAYPAL_CURRENCY');
        $payment->payment_status = $status;
        $payment->save();
    }

    // public function charge(Request $request)
    // {
    //     $data = [
    //         'amount' => $request->input('amount'),
    //         'currency' => 'USD',
    //         'returnUrl' => url('success'),
    //         'cancelurl' => url('error'),
    //     ];
    //     $response = $this->gateway->purchase($data)->send();
    //     if($response->isRedirect()){
    //         return $response->redirect();
    //     }else {
    //         return $response->getMessage();
    //     }
    // }

    public function success(Request $request)
    {
        if($request->input('paymentId') && $request->input('PayerID')){
            $data = [
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ];
            $transaction = $this->gateway->completePurchase($data);
            $response = $transaction->send();
            if($response->isSuccessful()){
                $arr_body = $response->getData();
                $payment = new Payment;
                $payment->payment_id = $arr_body['id'];
                $payment->payee_id = $arr_body['payer']['payer_info']['payer_id'];
                $payment->payee_email = $arr_body['payer']['payer_info']['email'];
                $payment->amount = $arr_body['transactions'][0]['amount']['total'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->payment_status = $arr_body['state'];
                $payment->save();
                $response = [
                    'status' => $arr_body['state'],
                    'content' => $arr_body
                ];
                return response($response);

            }else{
                return $response->getMessage();
            }
        }else{
            return 'Transaction is declined';
        }
    }

    public function error()
    {
        return 'user_cancelled_payment';
    }


}
