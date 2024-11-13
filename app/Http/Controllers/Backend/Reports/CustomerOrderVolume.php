<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use PDF;
use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CustomerOrderVolume extends Controller
{
    public function CustomerOrderVolume(){
        abort_if(Gate::denies('report_access'),403);
        return view('admin.page.Report.customerordervolume');
    }

    public function exportCustomerOrderVolume(Request $request){
        abort_if(Gate::denies('report_access'),403);

        $day = Carbon::now();
        $today = $day->format('F d, Y');
        $prepared_by = Auth::guard('web')->user()->name;

        if($request->sorting == 'customer_name_asc'){
            $column_name = "name";
            $order_name = "asc";
        }elseif($request->sorting == 'customer_name_desc'){
            $column_name = "name";
            $order_name = 'desc';
        }elseif($request->sorting == 'total_quantity_asc'){
            $column_name = 'total_quantity';
            $order_name = "asc";
        }elseif($request->sorting == 'total_quantity_desc'){
            $column_name = 'total_quantity';
            $order_name = 'desc';
        }else{
            $column_name = "name";
            $order_name = "asc";
        }

        $customers = Customer::select([
            'customers.id',
            'customers.name',
            'customers.email',
            DB::raw(value: 'sum(CASE WHEN customer_order.status = "Completed" then  customer_order_item.quantity end) AS total_quantity')
        ])
        ->leftjoin('customer_order','customers.id','=','customer_order.customers_id')
        ->leftjoin('customer_order_item',function($join){
            $join->on('customer_order_item.customer_order_id', '=', 'customer_order.id');
        })
        ->groupBy('customers.name','customers.id','customers.email')
        ->orderBy('total_quantity' ,'desc')
        ->get();

        $pdf = PDF::loadView('admin.export.total-ordered-products-per-customer',[
            'customers' => $customers,
            'today' => $today,
            'prepared_by' => $prepared_by
        ]);

        return $pdf->download("Customer Order Volume.pdf");


    }

}
