<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use PDF;
use Carbon\Carbon;
use App\Models\Product;
class SalesByProductController extends Controller
{
    public function SalesByProductIndex(){
        abort_if(Gate::denies('report_access'),403);
        return view('admin.page.Report.productsales');
    }
    public function exportProductSales(Request $request)
    {
        abort_if(Gate::denies('report_export'), 403);

        // Get min and max date from database if startdate or enddate is null
        $dateRange = DB::table('customer_order')
            ->selectRaw('MIN(created_at) as min_date, MAX(created_at) as max_date')
            ->first();

        $start = $request->startdate ?? $dateRange->min_date; // Default to earliest date if null
        $end = $request->enddate ?? $dateRange->max_date; // Default to latest date if null

        $column_name = "";
        $order_name = "";
        $prepared_by = Auth::guard('web')->user()->name;

        if ($request->sorting == 'product_name_asc') {
            $sort = 'Product Name (A-Z)';
            $column_name = 'name';
            $order_name = 'asc';
        } elseif ($request->sorting == 'product_name_desc') {
            $sort = 'Product Name (Z-A)';
            $column_name = 'name';
            $order_name = 'desc';
        } elseif ($request->sorting == 'total_sales_asc') {
            $sort = 'Total Sales (Low to High)';
            $column_name = 'total_sales';
            $order_name = 'asc';
        } elseif ($request->sorting == 'total_sales_desc') {
            $sort = 'Total Sales (High to Low)';
            $column_name = 'total_sales';
            $order_name = 'desc';
        } elseif ($request->sorting == 'order_quantity_asc') {
            $sort = 'Order Quantity (Low to High)';
            $column_name = 'quantity';
            $order_name = 'asc';
        } elseif ($request->sorting == 'order_quantity_desc') {
            $sort = 'Order Quantity (High to Low)';
            $column_name = 'quantity';
            $order_name = 'desc';
        } else {
            $column_name = 'name';
            $order_name = 'asc';
        }

        $products = Product::select([
            'product.id',
            'product.name',
            DB::raw('SUM(CASE WHEN customer_order.status = "Completed" THEN customer_order_item.quantity ELSE 0 END) AS quantity'),
            DB::raw('SUM(CASE WHEN customer_order.status = "Completed" THEN customer_order_item.quantity * customer_order_item.price ELSE 0 END) as total_sales'),
        ])
        ->leftJoin('customer_order_item', 'product.id', '=', 'customer_order_item.product_id')
        ->leftJoin('customer_order', function ($join) use ($start, $end) {
            $join->on('customer_order_item.customer_order_id', '=', 'customer_order.id')
                 ->whereBetween('customer_order.created_at', [$start, $end]);
        })
        ->groupBy('product.name', 'product.id')
        ->orderBy($column_name, $order_name)
        ->get();

        $from = Carbon::parse($start)->format("F d, Y H:i A");
        $to = Carbon::parse($end)->format("F d, Y H:i A");

        $pdf = PDF::loadView('admin.export.sales-by-product', [
            'products' => $products,
            'from' => $from,
            'to' => $to,
            'prepared_by' => $prepared_by
        ]);

        return $pdf->download("Product Sales.pdf");
    }


}
