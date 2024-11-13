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
class CustomersGainedPerMonthController extends Controller
{
    public function customerPerMonth(){
        abort_if(Gate::denies('report_access'),403);
        return view('admin.page.Report.monthlycustomer');
    }
    public function exportMonthlyGainedCustomers(Request $request){
        abort_if(Gate::denies('report_access'),403);
        $prepared_by = Auth::guard('web')->user()->name;
        $day = Carbon::now();
        $today = $day->format('F d, Y');
        $monthly_gained_customers =  Customer::select([
            DB::raw(value: 'YEAR(created_at) as year'),
            DB::raw(value: 'MONTHNAME(created_at) as month_name'),
            DB::raw(value: 'MONTH(created_at) as month'),
            DB::raw(value: 'COUNT(name) as total'),
        ])
        ->groupBy('month_name', 'year','month')
        ->orderBy('year','asc')
        ->orderBy('month','asc')
        ->get();

        $pdf = PDF::loadView('admin.export.customer-gained-per-month',[
            'monthly_gained_customers' => $monthly_gained_customers,
            'prepared_by' => $prepared_by,
            'today' => $today
        ]);

        return $pdf->download("Customer Gained Per Month.pdf");

    }
}
