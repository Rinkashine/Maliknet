<?php

namespace App\Http\Controllers\Frontend\Account;

use App\Http\Controllers\Controller;
use App\Models\CustomerOrder;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CustomerOrdersController extends Controller
{
    public function index()
    {
        return view('customer.account.orders');
    }

    public function show($id)
    {
        $orderdetails = CustomerOrder::findorfail($id);
        // Get the current date and time
        $currentDate = Carbon::now();

        // Get the created date of the item from your database (assuming it's a Carbon instance)
        $itemCreatedDate = $orderdetails->updated_at;

        $daysDifference = $currentDate->diffInDays($itemCreatedDate);
        $customer_id = Auth::guard('customer')->user()->id;
        if ($orderdetails->customers_id != $customer_id) {
            abort(403);
        }

        return view('customer.account.orderdetails', [
            'orderdetails' => $orderdetails,
            'daysDifference' => $daysDifference
        ]);
    }
}
