<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;
class NumberRejectedOrderController extends Controller
{
    public function RejectedOrders(){
        abort_if(Gate::denies('report_access'),403);
        return view('admin.page.Report.rejectedorders');
    }

    public function exportRejectedOrders(Request $request){
        abort_if(Gate::denies('report_export'),403);
        $column_name = "";
        $order_name = "";
        $prepared_by = Auth::guard('web')->user()->name;
        $start = $request->startdate;
        $end = $request->enddate;

        if($request->sorting == 'customer_name_asc'){
            $column_name = "customers.name";
            $order_name = "asc";
        }elseif($request->sorting == 'customer_name_desc'){
            $column_name = "customers.name";
            $order_name = 'desc';
        }elseif($request->sorting == 'cancellation_asc'){
            $column_name = 'total';
            $order_name = "asc";
        }elseif($request->sorting == 'cancellation_desc'){
            $column_name = 'total';
            $order_name = 'desc';
        }else{
            $column_name = "customers.name";
            $order_name = "asc";
        }

        $customers =  Customer::select([
            'customers.id',
            'customers.name',
            'customers.email',
            DB::raw(value: 'COUNT(CASE WHEN customer_order.status = "Rejected" and customer_order.created_at >= "'.$start.'" and customer_order.created_at <= "'.$end.'" then customer_order.rejected_reason end) as total'),
            ])
        ->leftjoin('customer_order','customers.id','=','customer_order.customers_id')
        ->groupBy('customers.name','customers.id','customers.email')
        ->orderBy($column_name, $order_name)
        ->get();

        $from = Carbon::parse($start)->format("F d, Y H:i A");
        $to = Carbon::parse($end)->format("F d, Y H:i A");

        $pdf = PDF::loadView('admin.export.rejected-order-per-user',[
            'customers' => $customers,
            'from' => $from,
            'to' => $to,
            'prepared_by' => $prepared_by
        ]);

        return $pdf->download("Rejected Order Per User.pdf");
    }
}
