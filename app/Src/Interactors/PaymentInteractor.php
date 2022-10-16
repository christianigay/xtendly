<?php
namespace App\Src\Interactors;

use App\Src\Repositories\RepositoryInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\OrderItem;
use App\Src\Repositories\OrderItemRepository;
use Exception;

class PaymentInteractor {

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

    public function setupPayment($request)
    {
        try {
            $productItems = $request->input('product_items');
            $amount = $request->input('amount');
            $body = $this->setBody($amount);
            $order = $this->requestApiCheckoutOrder($body);
            if (count($order['links'])) {
                $this->saveOrder($order, $amount, $productItems);
                foreach ($order['links'] as $link)
                    if ($link['rel'] == 'approve') return $link['href'];
            }
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }
    }

    public function saveOrder($order, $amount, $productItems)
    {
        $orderEntity = $this->repository->create([
            'token' => $order['id'],
            'user_id' => Auth::user()->id,
            'amount' => $amount,
            'date' => Carbon::today()
        ]);
        $this->saveOrderItems($orderEntity, $productItems);
    }

    public function saveOrderItems($order, $orderItems)
    {
        $orderItemRepository = new OrderItemRepository(new OrderItem());
        foreach($orderItems as $item){
            if(! $item) continue;
            $data = [
                'order_id' => $order->id,
                'buy_quantity' => $item['buy_quantity'],
                'price' => $item['price'],
                'buy_price_total' => $item['buy_price_total'],
            ];
            $orderItemRepository->create($data);
        }
    }

    protected function requestApiCheckoutOrder($body)
    {
        return Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->paypalAuth['access_token'],
         ])->post($this->paypal_url.'v2/checkout/orders', $body)
         ->throw()->json();
    }

    protected function setBody($amount)
    {
        return [
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
    }

}