<?php
namespace App\Src\Interactors;

use App\Src\Repositories\RepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalInteractor {

    public function __construct()
    {
        
        $this->provider = new PayPalClient;
    }

    public function getAccessToken()
    {
        $this->token = $this->token ?? $this->provider->getAccessToken();
        return $this->token;
    }

    public function getProducts()
    {
        return $this->provider->listProducts();
    }

    public function createProduct($inputs)
    {
        $data = [
            "name" => $inputs['name'] ?? '',
            "description" => $inputs['description'] ?? '',
            "type" => $inputs['type'] ?? '',
            "category" => $inputs['category'] ?? '',
            "image_url" => $inputs['image_url'] ?? '',
            "home_url" => $inputs['home_url'] ?? ''
        ];
        $request_id = 'create-product-'.time();
        $product = $this->provider->createProduct($data, $request_id);
        return $product;
    }
}