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

class SalesByBrandController extends Controller
{
    public function BrandSalesIndex(){
        abort_if(Gate::denies('report_access'),403);
        return view('admin.page.Report.brandsales');
    } //

    public function exportBrandSales(Request $request){
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
        } elseif ($request->sorting == 'total_sales_asc') {
            $sort = 'Total Sales (Low-High)';
            $column_name = 'total_sales';
            $order_name = 'asc';
        } elseif ($request->sorting == 'total_sales_desc') {
            $sort = 'Total Sales (High-Low)';
            $column_name = 'total_sales';
            $order_name = 'desc';
        } else {
            $column_name = 'name';
            $order_name = 'asc';
        }

        $brands = Brand::select([
            'brand.id',
            'brand.name',
            DB::raw(value: 'SUM(CASE WHEN customer_order.status = "Completed" then customer_order_item.quantity * customer_order_item.price else 0 end) as total_sales'),
        ])->leftjoin('product', 'brand.id', '=', 'product.brand_id')
            ->leftjoin('customer_order_item', 'product.id', '=', 'customer_order_item.id')
            ->leftjoin('customer_order', function ($join) use ($start,$end) {
                $join->on('customer_order_item.customer_order_id', '=', 'customer_order.id')
                ->where('customer_order.created_at', '>=', $start)
                ->where('customer_order.created_at', '<=', $end);
            })
            ->groupBy('brand.id', 'brand.name')
            ->orderBy($column_name, $order_name)
            ->get();

            $from = Carbon::parse($start)->format("F d, Y H:i A");
            $to = Carbon::parse($end)->format("F d, Y H:i A");

            $pdf = PDF::loadView('admin.export.sales-by-brand',[
                'brands' => $brands,
                'from' => $from,
                'to' => $to,
                'prepared_by' => $prepared_by
            ]);

            return $pdf->download("Brand Sales.pdf");
    }
}