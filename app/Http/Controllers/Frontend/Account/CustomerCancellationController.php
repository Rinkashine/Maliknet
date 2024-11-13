<?php

namespace App\Http\Controllers\Frontend\Account;

use App\Http\Controllers\Controller;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItems;
use Illuminate\Support\Facades\Auth;

class CustomerCancellationController extends Controller
{
    public function index()
    {
        $customer_id = Auth::guard('customer')->user()->id;
        $cancelledorders = CustomerOrder::where('customers_id', $customer_id)
        ->where('status', 'Cancelled')
        ->get();

        return view('customer.account.cancellations', [
            'cancelledorders' => $cancelledorders,
        ]);
    }

    public function show($customerorder)
    {
        $orderdetails = CustomerOrder::findorfail($customerorder);
        $products = CustomerOrderItems::where('customer_order_id', $orderdetails->id)->get();

        return view('customer.account.cancellationdetail', [
            'orderdetails' => $orderdetails,
            'products' => $products,

        ]);
    }
}
