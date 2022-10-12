<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductAddRequest;
use App\Http\Requests\ProductEditRequest;
use Illuminate\Http\Request;

use Omnipay\Omnipay;
use App\Models\Payment;
use App\Models\Product;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{


    public function __construct()
    {
       $this->product = new Product;
    }

    public function list()
    {
        return $this->product->get();
    }

    public function getProduct($id)
    {
        return $this->product::find($id);
    }

    public function edit(ProductEditRequest $request)
    {
        $request->validated();
        $product = $this->product->find($request->id);
        if($product){
            $product->name = $request->name;
            $product->description = $request->description;
            $product->quantity = $request->quantity;
            $product->price = $request->price;
            $product->save();
            return response(['result' => 'saved']);
        }
    }

    public function add(ProductAddRequest $request)
    {
        $request->validated();
        $data = [
            'name' => $request->name, 
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price
        ];
        return Product::create($data);
    }

}
