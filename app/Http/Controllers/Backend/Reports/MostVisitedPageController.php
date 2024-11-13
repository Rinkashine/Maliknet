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
class MostVisitedPageController extends Controller
{
       //Show Most Visited Page
    public function MostVisitedPageIndex(){
        abort_if(Gate::denies('report_access'),403);
        return view('admin.page.Report.mostvisitedpage');
    }
    //Export Most Visited Page Report
    public function exportMostVisitedPage(Request $request){
        abort_if(Gate::denies('report_export'),403);
        $st = new Carbon($request->startdate);
        $ed = new Carbon($request->enddate);
        $period = Period::create($st, $ed);

        $pages = Analytics::fetchMostVisitedPages($period, 10);

        $prepared_by = Auth::guard('web')->user()->name;

        $from = Carbon::parse($st)->format("F d, Y H:i A");
        $to = Carbon::parse($ed)->format("F d, Y H:i A");


        $pdf = PDF::loadView('admin.export.most-visited-page',[
            'pages' => $pages,
            'from' => $from,
            'to' => $to,
            'prepared_by' => $prepared_by
        ]);

        return $pdf->download("Most Visited Page.pdf");

    }
}
