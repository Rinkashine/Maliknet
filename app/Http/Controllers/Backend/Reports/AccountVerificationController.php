<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use PDF;
use Analytics;
use Carbon\Carbon;
use App\Models\Customer;

class AccountVerificationController extends Controller
{
    public function AccountVerification(){
        abort_if(Gate::denies('report_access'),403);
        return view('admin.page.Report.accountverification');
    }

    public function exportAccountVerification(){
        abort_if(Gate::denies('report_export'),403);

        $nonverified = Customer::all()->where('email_verified_at','=','')->count();
        $verified = Customer::all()->where('email_verified_at','!=','')->count();
        $day = Carbon::now();
        $today = $day->format('F d, Y');
        $prepared_by = Auth::guard('web')->user()->name;

        $pdf = PDF::loadView('admin.export.account-verification',[
            'nonverified' => $nonverified,
            'verified' => $verified,
            'today' => $today,
            'prepared_by' => $prepared_by
        ]);

        return $pdf->download("Account Verification.pdf");

    }
}
