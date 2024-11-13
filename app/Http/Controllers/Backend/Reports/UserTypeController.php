<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Spatie\Analytics\Period;
use PDF;
use Analytics;
use Carbon\Carbon;
class UserTypeController extends Controller
{
    //Show User Type Report Page
    public function UserTypeIndex(){
        abort_if(Gate::denies('report_access'),403);
        return view('admin.page.Report.usertype');
    }
    //Export User Type
    public function exportUserType(Request $request){
        abort_if(Gate::denies('report_export'),403);
        $st = new Carbon($request->startdate);
        $ed = new Carbon($request->enddate);
        $period = Period::create($st, $ed);
        $usertype = Analytics::fetchUserTypes($period);

        $prepared_by = Auth::guard('web')->user()->name;

        $from = Carbon::parse($request->startdate)->format("F d, Y H:i A");
        $to = Carbon::parse($request->enddate)->format("F d, Y H:i A");


        $pdf = PDF::loadView('admin.export.user-type',[
            'usertype' => $usertype,
            'from' => $from,
            'to' => $to,
            'prepared_by' => $prepared_by
        ]);

        return $pdf->download("User Type.pdf");
    }
}
