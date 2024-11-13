<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Models\Category;
use PDF;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class CategoryController extends Controller
{
    //Show Category Page
    public function index()
    {
        abort_if(Gate::denies('category_access'), 403);

        return view('admin.page.product.category');
    }

    //Export Category to Excel
    public function exportcategoriesexcel()
    {
        abort_if(Gate::denies('category_export'), 403);
        $categories = Category::all();
        $prepared_by = Auth::guard('web')->user()->name;
        $day = Carbon::now();
        $today = $day->format('F d, Y');
        $pdf = PDF::loadView('admin.export.list-of-categories',[
            'categories' => $categories,
            'prepared_by' => $prepared_by,
            'today' => $today
        ]);

        return $pdf->download("List of Categories.pdf");
    }


}
