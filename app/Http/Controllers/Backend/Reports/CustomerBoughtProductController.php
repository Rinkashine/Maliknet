<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use PDF;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Customer;

class CustomerBoughtProductController extends Controller
{
    public function CustomerByProduct(Request $request){
        abort_if(Gate::denies('report_access'),403);
        return view('admin.page.Report.customerbyproduct',[
            'name' => $request->name,
            'id' => $request->id
        ]);
    }

    public function exportCustomerByProduct(Request $request){
        abort_if(Gate::denies('report_export'),403);
        $customer_id = $request->id;
        $column_name = "";
        $order_name = "";

        if ($request == 'customer_name_asc') {
            $column_name = 'name';
            $order_name = 'asc';
        } elseif ($request == 'customer_name_desc') {
            $column_name = 'name';
            $order_name = 'desc';
        } elseif ($request == 'total_spent_asc') {
            $column_name = 'total_spent';
            $order_name = 'asc';
        } elseif ($request == 'total_spent_desc') {
            $column_name = 'total_spent';
            $order_name = 'desc';
        } else {
            $column_name = 'name';
            $order_name = 'asc';
        }
        $prepared_by = Auth::guard('web')->user()->name;
        $day = Carbon::now();
        $today = $day->format('F d, Y');
        $products = Product::select([
            'product.name',
            DB::raw(value: 'SUM(CASE WHEN customer_order.status = "Completed" then customer_order_item.quantity end) AS total_quantity')
        ])
        ->leftjoin('customer_order_item','product.id','=','customer_order_item.product_id')
        ->leftjoin('customer_order',function($join) use ($customer_id){
            $join->on('customer_order_item.customer_order_id', '=', 'customer_order.id')
            ->where('customer_order.customers_id', '=', $customer_id);
        })
        ->groupBy('product.name')
        ->orderBy('total_quantity', 'desc')
        ->get();

        $customerinfo = Customer::findorfail($customer_id);
        $customer_name = $customerinfo->name;
        $pdf = PDF::loadView('admin.export.customer-bought-product',[
            'products' => $products,
            'prepared_by' => $prepared_by,
            'today' => $today,
            'customer_name' => $customer_name
        ]);

        return $pdf->download("$customer_name Bought Products.pdf");

    }
}
