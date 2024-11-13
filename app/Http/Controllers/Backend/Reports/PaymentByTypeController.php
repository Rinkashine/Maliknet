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

class PaymentByTypeController extends Controller
{
    public function PaymentTypeIndex(){
        abort_if(Gate::denies('report_access'),403);
        return view('admin.page.Report.paymentbytype');
    }

    public function exportPaymentByType(Request $request){
        abort_if(Gate::denies('report_export'),403);

        $mode_of_payment = CustomerOrder::select([
            DB::raw('mode_of_payment AS type'),
            DB::raw(value: 'COUNT(mode_of_payment) AS total'),
        ])->where('status',"Completed")
        ->where('created_at', '>=', $request->startdate)
        ->where('created_at', '<=', $request->enddate)
        ->groupBy('mode_of_payment')
        ->get();

        $prepared_by = Auth::guard('web')->user()->name;

        $from = Carbon::parse($request->startdate)->format("F d, Y H:i A");
        $to = Carbon::parse($request->enddate)->format("F d, Y H:i A");

        $pdf = PDF::loadView('admin.export.payment-by-type',[
            'mode_of_payment' => $mode_of_payment,
            'from' => $from,
            'to' => $to,
            'prepared_by' => $prepared_by
        ]);

        return $pdf->download("Mode of Payment.pdf");
    }

}
