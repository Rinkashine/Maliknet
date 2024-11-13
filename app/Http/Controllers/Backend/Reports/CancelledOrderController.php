<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Customer;
use PDF;
class CancelledOrderController extends Controller
{
    public function CancelledOrders(){
        abort_if(Gate::denies('report_access'),403);
        return view('admin.page.Report.cancelledorders');
    }
    public function exportCancelledOrders(Request $request){
        abort_if(Gate::denies('report_export'),403);
        $day = Carbon::now();
        $today = $day->format('F d, Y');
        $prepared_by = Auth::guard('web')->user()->name;
        $column_name = "";
        $order_name = "";
        if($request->sorting == 'customer_name_asc'){
            $sort = 'Customer Name (A-Z)';
            $column_name = "customers.name";
            $order_name = "asc";
        }elseif($request->sorting == 'customer_name_desc'){
            $sort = 'Customer Name (Z-A)';
            $column_name = "customers.name";
            $order_name = 'desc';
        }elseif($request->sorting == 'total_spent_asc'){
            $sort = 'Total Cancellation (Low-High)';
            $column_name = 'total';
            $order_name = "asc";
        }elseif($request->sorting == 'total_spent_desc'){
            $sort = 'Total Cancellation (High-Low)';
            $column_name = 'total';
            $order_name = 'desc';
        }

        $customers =  Customer::select([
            'customers.id',
            'customers.name',
            'customers.email',
            DB::raw(value: 'COUNT(CASE WHEN customer_order.status = "Cancelled" and customer_order.created_at >= "'.$request->startdate.'" and customer_order.created_at <= "'.$request->enddate.'" then customer_order.cancellation_reason_id end) as total'),
        ])
        ->leftjoin('customer_order','customers.id','=','customer_order.customers_id')
        ->groupBy('customers.name','customers.id','customers.email')
        ->orderBy($column_name, $order_name)
        ->get();

        $pdf = PDF::loadView('admin.export.cancelled-order',[
            'customers' => $customers,
            'today' => $today,
            'prepared_by' => $prepared_by
        ]);

        return $pdf->download("Cancelled Orders.pdf");

    }

}
