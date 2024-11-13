<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Support\Facades\Gate;

class ProductOrderVolumeController extends Controller
{
    public function ProductOrderVolume(){
        abort_if(Gate::denies('report_access'),403);
        return view('admin.page.Report.productordervolume');
    }

    public function exportProductOrderVolume(Request $request){
        abort_if(Gate::denies('report_access'),403);

        $day = Carbon::now();
        $today = $day->format('F d, Y');

        $column_name = "";
        $order_name = "";
        $prepared_by = Auth::guard('web')->user()->name;

        if ($request->sorting == 'product_name_asc') {
            $column_name = 'name';
            $order_name = 'asc';
        } elseif ($request->sorting == 'product_name_desc') {
            $column_name = 'name';
            $order_name = 'desc';
        } elseif ($request->sorting == 'order_quantity_asc') {
            $column_name = 'order_quantity';
            $order_name = 'asc';
        } elseif ($request->sorting == 'order_quantity_desc') {
            $column_name = 'order_quantity';
            $order_name = 'desc';
        } else {
            $column_name = 'name';
            $order_name = 'asc';
        }

        $products = Product::select([
            'product.id',
            'product.name',
            DB::raw(value: 'SUM(CASE WHEN customer_order.status = "Completed" then customer_order_item.quantity
            end) as order_quantity'),
        ])
        ->leftjoin('customer_order_item', 'product.name', '=', 'customer_order_item.product_name')
        ->leftjoin('customer_order', function($join){
            $join->on('customer_order_item.customer_order_id', '=', 'customer_order.id');
        })
        ->groupBy('product.name','product.id' )
        ->orderBy($column_name, $order_name)
        ->get();

        $pdf = PDF::loadView('admin.export.quantity-product-ordered',[
            'products' => $products,
            'prepared_by' => $prepared_by,
            'today' => $today
        ]);

        return $pdf->download("Product Order Volume.pdf");
    }
}
