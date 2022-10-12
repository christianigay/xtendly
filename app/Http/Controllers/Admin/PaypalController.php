<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Src\Interactors\PaypalInteractor;




class PaypalController extends Controller
{

    public function __construct()
    {
        $this->paypalInteractor = new PaypalInteractor;
    }

    public function createProduct(Request $request)
    {
        $token = $this->paypalInteractor->getAccessToken();
        $product = $this->paypalInteractor->createProduct($request->all());
        return $product;
    }

    public function handlePayment()
    {
        $token = $this->paypalInteractor->getAccessToken();

        $products =  $this->paypalInteractor->getProducts();
        $product = [];
        $productItems = collect([
            [
                'name' => 'Christian Igay',
                'price' => 112,
                'desc' => 'Running Shoes for men',
                'qty' => 2
            ]
        ]);

        $product['invoice_id'] = 1;
        $product['invoice_description'] = "Order # " . $product['invoice_id'];
        $product['return_url'] = route('success.payment');
        $product['cancel_url'] = route('cancel.payment');
        $product['total'] = $this->totalPrice($productItems);

        // $paypalModule = new ExpressCheckout;
        // $result = $paypalModule->setExpressCheckout($product);
        // $result = $paypalModule->setExpressCheckout($product, true);
        // return $result;
        
    }

    private function totalPrice($items)
    {
        return $items->sum('price');
    }

    public function cancelPayment() 
    {

    }

    public function paymentSuccess()
    {

    }

}
