<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Customer;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class CustomerGainedPerMonthListController extends Controller
{
    public function CustomerPerMonthList(Request $request){
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

        return view('admin.page.Report.reportshowmonthlycustomer', [
            'from' => $from,
            'to' => $to,
            'month' => $month,
            'year' => $year,
        ]);
    }
    public function exportCustomerPerMonthList(Request $request){
        abort_if(Gate::denies('report_export'),403);
        $prepared_by = Auth::guard('web')->user()->name;
        $day = Carbon::now();
        $today = $day->format('F d, Y');
        $date = Carbon::parse($request->from);
        $monthYear = $date->format('F Y');
        $customers = Customer::select([
            'customers.id',
            'customers.name',
            'customers.created_at',
            'customers.birthday',
            'customers.email',
            'customers.phone_number',
            'customers.photo',
            DB::raw(value: 'MONTHNAME(customers.created_at) as month_name'),
        ])
        ->where('customers.created_at', '>=', $request->from)
        ->where('customers.created_at', '<=', $request->to)
        ->orderBy('customers.created_at','asc')
        ->get();

        $pdf = PDF::loadView('admin.export.customer-gained-per-month-list',[
            'customers' => $customers,
            'prepared_by' => $prepared_by,
            'today' => $today,
            'monthYear' => $monthYear
        ]);

        return $pdf->download("$monthYear Gained Customers.pdf");

    }
}
