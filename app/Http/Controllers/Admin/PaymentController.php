<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

use Omnipay\Omnipay;
use App\Models\Payment;
use App\Src\Interactors\PaymentApproveInteractor;
use App\Src\Interactors\PaymentInteractor;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{

    public function __construct(PaymentInteractor $interactor, PaymentApproveInteractor $approveInteractor)
    {
        $this->interactor = $interactor;
        $this->approveInteractor = $approveInteractor;
    }

    public function charge(Request $request)
    {
        return $this->interactor->setupPayment($request);
    }

    public function approve(Request $request)
    {
        return $this->approveInteractor->approvedPayment($request);
    }

}
