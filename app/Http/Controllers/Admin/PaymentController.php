<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

use Omnipay\Omnipay;
use App\Models\Payment;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
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
            $productItems = $request->input('product_items');
            
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
                // $this->savePayment($order, $amount, 'pending');
                $orderEntity = $this->saveOrder($amount, $order);
                $this->saveOrderItems($orderEntity, $productItems);

                foreach ($order['links'] as $link) {
                    if ($link['rel'] == 'approve') return $link['href'];
                }
            }
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }
    }

    public function saveOrder($amount, $paypal)
    {
        $data = [
            'token' => $paypal['id'],
            'user_id' => Auth::user()->id,
            'amount' => $amount,
            'date' => Carbon::today()
        ];
        return Order::create($data);
    }

    public function saveOrderItems($order, $orderItems)
    {
        foreach($orderItems as $item){
            if(! $item) continue;
            $data = [
                'order_id' => $order->id,
                'buy_quantity' => $item['buy_quantity'],
                'price' => $item['price'],
                'buy_price_total' => $item['buy_price_total'],
            ];
            OrderItem::create($data);
        }
    }

    public function approve(Request $request)
    {
        try{

            $token = $request->token;
            $params = Order::where('token', $token)->first();
    
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
            $this->savePayment($params->id, $params->amount, 1, $date, $receipt);
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

    public function savePayment($orderID, $amount, $status, $date, $receipt)
    {
        $payment = new Payment;
        $payment->order_id = $orderID;
        $payment->amount = $amount;
        $payment->currency = env('PAYPAL_CURRENCY');
        $payment->date = Carbon::parse($date);
        $payment->receipt_number = $receipt;
        $payment->payment_status = $status;
        $payment->save();
    }

}
