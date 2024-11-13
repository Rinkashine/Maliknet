<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\CustomerOrder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PDF;
class CancellationOverTimeController extends Controller
{
    public function CancellationOverTime(){
        abort_if(Gate::denies('report_access'),403);
        return view('admin.page.Report.cancellationovertime');
    }

    public function exportCancellationOverTime(){
        abort_if(Gate::denies('report_access'),403);
        $prepared_by = Auth::guard('web')->user()->name;
        $day = Carbon::now();
        $today = $day->format('F d, Y');
        $orders = CustomerOrder::select([
            DB::raw(value: 'YEAR(customer_order.created_at) as year'),
            DB::raw(value: 'MONTHNAME(customer_order.created_at) as month_name'),
            DB::raw(value: 'MONTH(customer_order.created_at) as month'),
            DB::raw(value: 'COUNT(*) as total'),
        ])
        ->where('customer_order.status','Cancelled')
        ->groupBy('month_name', 'year','month')
        ->orderBy('year','asc')
        ->orderBy('month','asc')
        ->get();

        $pdf = PDF::loadView('admin.export.cancellation-over-time',[
            'orders' => $orders,
            'prepared_by' => $prepared_by,
            'today' => $today
        ]);

        return $pdf->download("Cancellations Over Time.pdf");

    }
}
