<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use PDF;
use Carbon\Carbon;
use App\Models\Customer;
class VerifiedAccountController extends Controller
{
    public function VerifiedAccount(){
        abort_if(Gate::denies('report_access'),403);
        return view('admin.page.Report.verifiedaccount');
    }

    public function exportVerifiedAccountsExcel(Request $request){
        abort_if(Gate::denies('report_access'),403);
        $prepared_by = Auth::guard('web')->user()->name;
        $day = Carbon::now();
        $today = $day->format('F d, Y');

        if($request->sorting == 'customer_name_asc'){
            $column_name = "name";
            $order_name = "asc";
        }elseif($request->sorting == 'customer_name_desc'){
            $column_name = "name";
            $order_name = 'desc';
        }else{
            $column_name = "name";
            $order_name = "asc";
        }

        $customers = Customer::select('name', 'email')
        ->where('email_verified_at','!=',null)
        ->orderBy($column_name, $order_name)
        ->get();
        $pdf = PDF::loadView('admin.export.verified-account',[
            'customers' => $customers,
            'prepared_by' => $prepared_by,
            'today' => $today
        ]);

        return $pdf->download("Verified Accounts.pdf");
    }
}
