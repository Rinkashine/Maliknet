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
class CustomerTotalSpentController extends Controller
{
   // Show Customer Sales Page
   public function CustomersTotalSpent(){
        abort_if(Gate::denies('report_access'),403);
        return view('admin.page.Report.customertotalspent');
    }

    public function exportCustomerTotalSpent(Request $request){
        abort_if(Gate::denies('report_export'),403);
        $column_name = "";
        $order_name = "";
        if ($request->sorting == 'customer_name_asc') {
            $column_name = 'name';
            $order_name = 'asc';
        } elseif ($request->sorting == 'customer_name_desc') {
            $column_name = 'name';
            $order_name = 'desc';
        } elseif ($request->sorting == 'total_spent_asc') {
            $column_name = 'total_spent';
            $order_name = 'asc';
        } elseif ($request->sorting == 'total_spent_desc') {
            $column_name = 'total_spent';
            $order_name = 'desc';
        } else {
            $column_name = 'name';
            $order_name = 'asc';
        }
        $start = $request->startdate;
        $end = $request->enddate;
        $customers = Customer::select([
            'customers.id',
            'customers.name',
            'customers.email',
            DB::raw(value: 'sum(CASE WHEN customer_order.status = "Completed" then customer_order_item.price * customer_order_item.quantity else 0 end) AS total_spent'),
        ])
        ->leftjoin('customer_order', 'customers.id', '=', 'customer_order.customers_id')
        ->leftjoin('customer_order_item', function ($join) use ($start,$end) {
            $join->on('customer_order_item.customer_order_id', '=', 'customer_order.id')
            ->where('customer_order.created_at', '>=', $start)
            ->where('customer_order.created_at', '<=', $end);
        })
        ->groupBy('customers.name', 'customers.id', 'customers.email')
        ->orderBy($column_name, $order_name)
        ->get();

        $from = Carbon::parse($start)->format("F d, Y H:i A");
        $to = Carbon::parse($end)->format("F d, Y H:i A");
        $prepared_by = Auth::guard('web')->user()->name;

        $pdf = PDF::loadView('admin.export.customer-total-spent',[
            'customers' => $customers,
            'from' => $from,
            'to' => $to,
            'prepared_by' => $prepared_by
        ]);

        return $pdf->download(" Customer Expenditure.pdf");

    }
}
