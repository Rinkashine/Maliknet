<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use PDF;
use Carbon\Carbon;
use App\Models\CustomerOrder;

class MonthlySalesController extends Controller
{
      //Show Sales Over Time Report Page
      public function SalesOvertimeIndex(){
        abort_if(Gate::denies('report_access'),403);
        return view('admin.page.Report.monthlysales');
    }
    //Export Sales Over Tieme
    public function exportMonthlySales(){
        abort_if(Gate::denies('report_access'),403);

        $sales = CustomerOrder::join('customer_order_item', 'customer_order.id', '=', 'customer_order_item.customer_order_id')
        ->select([
            DB::raw(value: 'YEAR(customer_order.created_at) as year'),
            DB::raw(value: 'MONTHNAME(customer_order.created_at) as month_name'),
            DB::raw(value: 'MONTH(customer_order.created_at) as month'),
            DB::raw(value: 'SUM(customer_order_item.quantity*customer_order_item.price) as total'),
        ])
        ->where('customer_order.status', 'Completed')
        ->groupBy('month_name', 'year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();

        $prepared_by = Auth::guard('web')->user()->name;
        $day = Carbon::now();
        $today = $day->format('F d, Y');

        $pdf = PDF::loadView('admin.export.sales-over-time',[
            'sales' => $sales,
            'today' => $today,
            'prepared_by' => $prepared_by
        ]);

        return $pdf->download("Monthly Sales.pdf");
    }

}
