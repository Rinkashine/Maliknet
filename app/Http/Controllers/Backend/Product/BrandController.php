<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Models\Brand;
use PDF;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class BrandController extends Controller
{
    //Show Brand Page
    public function index()
    {
        abort_if(Gate::denies('brand_access'), 403);

        return view('admin.page.product.brand');
    }

    //Export Brand to Excel
    public function exportbrandexcel()
    {
        abort_if(Gate::denies('brand_export'), 403);
        $brands = Brand::all();
        $prepared_by = Auth::guard('web')->user()->name;
        $day = Carbon::now();
        $today = $day->format('F d, Y');
        $pdf = PDF::loadView('admin.export.list-of-brands',[
            'brands' => $brands,
            'prepared_by' => $prepared_by,
            'today' => $today
        ]);

        return $pdf->download("List of Brands.pdf");
    }
}
