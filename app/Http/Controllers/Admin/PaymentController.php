<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Omnipay\Omnipay;
use App\Models\Payment;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{

    private $gateway;

    public function __construct()
    {
        $paypal_public = env('PAYPAL_SANDBOX_CLIENT_ID');
        $paypal_secret = env('PAYPAL_SANDBOX_CLIENT_SECRET');
        $this->paypal_url = env('PAYPAL_API_URL');
        $this->paypalAuth = Http::asForm()
            ->withBasicAuth($paypal_public, $paypal_secret)
            ->post($this->paypal_url.'v1/oauth2/token', [
            'grant_type' => 'client_credentials'
        ])->throw()->json();
        $this->cancel_url = env('APP_URL').'/payment';
        $this->success_url = env('APP_URL').'/payment/approve';
    }

    public function index()
    {

    }

    public function charge(Request $request)
    {
        
        try {
            $amount = $request->input('amount');
            
            $body = [
                "intent" => "CAPTURE",
                "purchase_units" => [[
                    "amount" => [
                        "currency_code" => "USD",
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
        try{

            $token = $request->token;
            $params = Payment::where('payment_id', $token)->first();
    
            // return error if no order corresponds to a token
            if (!$params) {
                return response()->json(['error' => 'The given token was invalid.'], 403);
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
             ])->post($this->paypal_url.'v2/checkout/orders/'.$token.'/capture', $body)
             ->throw()->json();
            $date = $capture['purchase_units'][0]['payments']['captures'][0]['create_time'];
            $receipt = $capture['purchase_units'][0]['payments']['captures'][0]['id'];
            $this->updatePaidPayment($token, $date, $receipt);
            return response(['result' => 'success_payment']);
        
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }
    }

    public function updatePaidPayment($paymentID, $date, $receipt)
    {
        $payment = Payment::where('payment_id', $paymentID)->first();
        $payment->payment_status = 'paid';
        $payment->date = Carbon::parse($date);
        $payment->receipt_number = $receipt;
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

}
