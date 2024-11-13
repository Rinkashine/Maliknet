<?php

namespace App\Http\Controllers\Frontend\Account;

use App\Http\Controllers\Controller;
use App\Models\CustomerOrder;
use Illuminate\Support\Facades\Auth;

class CustomerReturnsController extends Controller
{
    public function index()
    {
        $customer_id = Auth::guard('customer')->user()->id;
        $returns = CustomerOrder::where('status', 'Refunded')
        ->where('customers_id', $customer_id)
        ->get();

        return view('customer.account.returns', [
            'returns' => $returns,
        ]);
    }
}
