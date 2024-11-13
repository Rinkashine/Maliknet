<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Brand;
use PDF;

class BrandOrderVolumeController extends Controller
{
    public function BrandVolumeIndex(){
        abort_if(Gate::denies('report_access'),403);
        return view('admin.page.Report.brandordervolume');
    }

    public function exportBrandVolume(Request $request){
        abort_if(Gate::denies('report_export'),403);
        $start = $request->startdate;
        $end = $request->enddate;
        $column_name = "";
        $order_name = "";
        $prepared_by = Auth::guard('web')->user()->name;

        if ($request->sorting == 'brand_name_asc') {
            $sort = 'Brand Name (A-Z)';
            $column_name = 'name';
            $order_name = 'asc';
        } elseif ($request->sorting == 'brand_name_desc') {
            $sort = 'Brand Name (Z-A)';
            $column_name = 'name';
            $order_name = 'desc';
        } elseif ($request->sorting == 'order_quantity_asc') {
            $sort = 'Order Quantity (Low-High)';
            $column_name = 'order_quantity';
            $order_name = 'asc';
        } elseif ($request->sorting == 'order_quantity_desc') {
            $sort = 'Order Quantity (High-Low)';
            $column_name = 'order_quantity';
            $order_name = 'desc';
        } else {
            $column_name = 'name';
            $order_name = 'asc';
        }

            $brands = Brand::select([
                'brand.id',
                'brand.name',
                DB::raw(value: 'SUM(CASE WHEN customer_order.status = "Completed" then customer_order_item.quantity else 0 end) as order_quantity'),
            ])
            ->leftjoin('product', 'brand.id', '=', 'product.brand_id')
            ->leftjoin('customer_order_item', 'product.id', '=', 'customer_order_item.product_id')
            ->leftjoin('customer_order', function ($join) use ($start,$end) {
                $join->on('customer_order_item.customer_order_id', '=', 'customer_order.id')
                ->where('customer_order.created_at', '>', $start)
                ->where('customer_order.created_at', '<', $end);
            })
            ->groupBy('brand.id', 'brand.name')
            ->orderBy($column_name, $order_name)
            ->get();

            $from = Carbon::parse($start)->format("F d, Y H:i A");
            $to = Carbon::parse($end)->format("F d, Y H:i A");

            $pdf = PDF::loadView('admin.export.number-of-brand-ordered',[
                'brands' => $brands,
                'from' => $from,
                'to' => $to,
                'prepared_by' => $prepared_by
            ]);

            return $pdf->download("Total Number of Brand Ordered.pdf");
    }
}
