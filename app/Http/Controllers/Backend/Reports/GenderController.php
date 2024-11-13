<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Models\Customer;

class GenderController extends Controller
{
    public function GenderIndex(){
        abort_if(Gate::denies('report_access'),403);
        return view('admin.page.Report.gender');
    }
    public function exportGenderExcel(){
        abort_if(Gate::denies('report_export'),403);

        $prepared_by = Auth::guard('web')->user()->name;

        $genders = Customer::select([
            DB::raw('gender'),
            DB::raw(value : 'COUNT(gender) AS total'),
        ])->groupBy('gender')
        ->get();
        $day = Carbon::now();
        $today = $day->format('F d, Y');


        $pdf = PDF::loadView('admin.export.gender',[
            'genders' => $genders,
            'today' => $today,
            'prepared_by' => $prepared_by
        ]);

        return $pdf->download("Gender.pdf");
    }
}
