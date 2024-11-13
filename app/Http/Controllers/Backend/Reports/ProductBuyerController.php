<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use PDF;
use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Product;

class ProductBuyerController extends Controller
{
    public function ProductByCustomer(Request $request){
        abort_if(Gate::denies('report_access'),403);
        return view('admin.page.Report.productbycustomer',[
            'name' => $request->name,
            'id' => $request->id
        ]);
    }

    public function exportProductByCustomer(Request $request){
        abort_if(Gate::denies('report_access'),403);
        $product_id = $request->product_id;
        $start = $request->startdate;
        $end = $request->enddate;
        $column_name = "";
        $order_name = "";
        $prepared_by = Auth::guard('web')->user()->name;

        if($request->sorting == 'customer_name_asc'){
            $column_name = "name";
            $order_name = "asc";
        }elseif($request->sorting == 'customer_name_desc'){
            $column_name = "name";
            $order_name = 'desc';
        }elseif($request->sorting == 'total_spent_asc'){
            $column_name = 'total_quantity';
            $order_name = "asc";
        }elseif($request->sorting == 'total_spent_desc'){
            $column_name = 'total_quantity';
            $order_name = 'desc';
        }else{
            $column_name = "customers.name";
            $order_name = "asc";
        }

        $customers = Customer::select([
            'customers.id',
            'customers.name',
            'customers.email',
            DB::raw(value: 'SUM(CASE WHEN customer_order.status = "Completed" then customer_order_item.quantity end) AS total_quantity')
        ])
        ->leftjoin('customer_order','customers.id','=','customer_order.customers_id')
        ->leftjoin('customer_order_item',function($join) use ($product_id,$start,$end){
            $join->on('customer_order_item.customer_order_id', '=', 'customer_order.id')
            ->where('customer_order_item.product_id', '=', $product_id)
            ->where('customer_order.created_at', '>=', $start)
            ->where('customer_order.created_at', '<=', $end);
        })
        ->groupBy('customers.name','customers.id','customers.email')
        ->orderBy($column_name, $order_name)
        ->get();

        $from = Carbon::parse($start)->format("F d, Y H:i A");
        $to = Carbon::parse($end)->format("F d, Y H:i A");
        $product = Product::findorfail($product_id);
        $product_name = $product->name;

        $pdf = PDF::loadView('admin.export.product-buyer',[
            'customers' => $customers,
            'product_name' => $product_name,
            'from' => $from,
            'to' => $to,
            'prepared_by' => $prepared_by
        ]);

        return $pdf->download("$product_name Buyer.pdf");

    }

}
