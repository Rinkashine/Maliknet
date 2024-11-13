<?php

namespace App\Http\Controllers\Backend\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItems;
use Illuminate\Support\Facades\Gate;
use PDF;

class OrderController extends Controller
{
    //Show Order Transaction Page
    public function index()
    {
        abort_if(Gate::denies('order_access'), 403);

        return view('admin.page.Transaction.order');
    }

    public function Invoice($id){
        $orderdetails = CustomerOrder::findorfail($id);

        $pdf = PDF::loadView('admin.page.Transaction.invoice_pdf',[
            'orderdetails' => $orderdetails
        ]);

        return $pdf->download("Order Receipt $orderdetails->id.pdf");

    }

    public function show($id)
    {
        abort_if(Gate::denies('order_access'), 403);

        $orderdetails = CustomerOrder::findorfail($id);
        $customerinfo = Customer::withTrashed()->findorfail($orderdetails->customers_id);
        $products = CustomerOrderItems::where('customer_order_id', $orderdetails->id)->get();

        return view('admin.page.Transaction.ordershow', [
            'orderdetails' => $orderdetails,
            'products' => $products,
            'customerinfo' => $customerinfo,
        ]);
    }
}
