<?php
namespace App\Src\Interactors;

use App\Src\Repositories\RepositoryInterface;
use Illuminate\Support\Facades\Http;
use App\Models\Order;
use App\Src\Repositories\OrderRepository;
use Exception;
use Carbon\Carbon;

class PaymentApproveInteractor {

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
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

    public function approvedPayment($request)
    {
        try{
            $orderRepository = new OrderRepository(new Order);
            $token = $request->token;
            $params = $orderRepository->getByToken($token);   
            
            if (!$params)
                return response()->json(['error' => 'The given token was invalid.'], 403);
            $body = $this->setBody($token);
            $capture = $this->requestApiPayment($body, $token);
            $date = $capture['purchase_units'][0]['payments']['captures'][0]['create_time'];
            $receipt = $capture['purchase_units'][0]['payments']['captures'][0]['id'];
            $this->savePayment($params->id, $params->amount, 1, $date, $receipt);
            return response(['result' => 'success_payment']);
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }
    }

    public function savePayment($orderID, $amount, $status, $date, $receipt)
    {
        $this->repository->create([
            'order_id' => $orderID,
            'amount' => $amount,
            'currency' => env('PAYPAL_CURRENCY'),
            'date' => Carbon::parse($date),
            'receipt_number' => $receipt,
            'payment_status' => $status
        ]) ;
    }

    protected function setBody($token)
    {
        return [
            "payment_source" => [
                "token" => [
                    'id' => $token,
                    'type' => 'BILLING_AGREEMENT'
                ]
            ]
        ];
    }

    protected function requestApiPayment($body, $token)
    {
        return Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->paypalAuth['access_token'],
        ])->post($this->paypal_url.'v2/checkout/orders/'.$token.'/capture', $body)
        ->throw()->json();
    }


}