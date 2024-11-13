<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;
use App\Models\CustomerOrder;
use Illuminate\Support\Facades\DB;

class MonthlyCancellationController extends Controller
{
    public function MonthlyCancellation(Request $request){
        abort_if(Gate::denies('report_access'),403);
        $month = date('m', strtotime($request->month));
        $x = 30;
        if($month == '01' || $month == '03' || $month == '05' || $month == '07' || $month == '08' ||  $month == '10' ||  $month == '12'){
            $x = 31;
        }elseif($month == '02' && ($request->year%4) == '0'){
            $x = 28;
        }elseif($month == '02' && ($request->year%4) != '0'){
            $x = 29;
        }
        $year = $request->year;
        $from = $year .'-'.$month.'-'.'01';
        $to = $year.'-'.$month.'-'.$x.' 23-59-59';

        return view('admin.page.Report.monthlycancellation',[
            'from' => $from,
            'to' => $to,
            'month' => $month,
            'year' => $year,
        ]);
    }


    public function exportMonthlyCancellation(Request $request){
        abort_if(Gate::denies('report_access'),403);
        $month = date('F', mktime(0, 0, 0, $request->month, 10));
        $start = $request->startdate;
        $end = $request->enddate;

        $customers = CustomerOrder::select([
            'customers.name as customer_name',
            'customer_order.id as id',
            'cancellation_reason.name as reason_name',
            DB::raw(value: 'COUNT(CASE WHEN customer_order.status = "Cancelled" then customer_order.cancellation_reason_id end) as total'),
        ])
        ->leftjoin('cancellation_reason',function($join){
            $join->on('cancellation_reason.id', '=', 'customer_order.cancellation_reason_id');
        })
        ->where('customer_order.created_at', '>=', $request->startdate)
        ->where('customer_order.created_at', '<=', $request->enddate.' 23:59:59')
        ->where('customer_order.status','Cancelled' )
        ->leftjoin('customers', 'customers.id', '=', 'customer_order.customers_id')
        ->groupBy('customer_order.id','cancellation_reason.name','customers.name')
        ->get();
        $prepared_by = Auth::guard('web')->user()->name;

        $pdf = PDF::loadView('admin.export.monthly-cancelled-orders',[
            'customers' => $customers,
            'month' => $month,
            'prepared_by' => $prepared_by
        ]);

        return $pdf->download("Cancelled Orders of $month.pdf");
    }
}
