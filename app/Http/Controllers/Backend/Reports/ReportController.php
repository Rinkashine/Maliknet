<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class ReportController extends Controller
{
    //Show Report Main Page
    public function index(){
        abort_if(Gate::denies('report_access'),403);
        return view('admin.page.Report.report');
    }

}
