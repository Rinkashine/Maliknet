<?php

namespace App\Http\Controllers\Backend\Reports;

use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;
use App\Models\CustomerOrder;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class YearlySalesController extends Controller
{
    public function YearlySales(){
        abort_if(Gate::denies('report_access'),403);

        return view('admin.page.Report.yearlysales');
    }

    public function exportYearlySales(){
        abort_if(Gate::denies('report_access'),403);

        $yearlysales = CustomerOrder::join('customer_order_item', 'customer_order.id', '=', 'customer_order_item.customer_order_id')
        ->select([
            DB::raw(value: 'YEAR(customer_order.created_at) as year'),
            DB::raw(value: 'SUM(customer_order_item.quantity*customer_order_item.price) as total'),
        ])
        ->where('customer_order.status', 'Completed')
        ->groupBy( 'year')
        ->orderBy('year', 'asc')
        ->get();

        $prepared_by = Auth::guard('web')->user()->name;
        $day = Carbon::now();
        $today = Carbon::now()->format('F d, Y');

        $pdf = PDF::loadView('admin.export.yearly-sales',[
            'sales' => $yearlysales,
            'today' => $today,
            'prepared_by' => $prepared_by
        ]);
        return $pdf->download("Yearly Sales.pdf");
    }
}
