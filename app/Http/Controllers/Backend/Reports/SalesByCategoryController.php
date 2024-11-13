<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Category;
use PDF;
class SalesByCategoryController extends Controller
{
    public function CategorySalesIndex(){
        abort_if(Gate::denies('report_access'),403);
        return view('admin.page.Report.categorysales');
    }

    public function exportCategorySales(Request $request){
        abort_if(Gate::denies('report_export'),403);
        $start = $request->startdate;
        $end = $request->enddate;
        $column_name = "";
        $order_name = "";
        $prepared_by = Auth::guard('web')->user()->name;

        if ($request->sorting == 'category_name_asc') {
            $sort = 'Category Name (A-Z)';
            $column_name = 'name';
            $order_name = 'asc';
        } elseif ($request->sorting == 'Category_name_desc') {
            $sort = 'Category Name (Z-A)';
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

        $from = Carbon::parse($start)->format("F d, Y H:i A");
        $to = Carbon::parse($end)->format("F d, Y H:i A");

        $categories = Category::select([
            'category.id',
            'category.name',
            DB::raw(value: 'SUM(CASE WHEN customer_order.status = "Completed" then customer_order_item.quantity * customer_order_item.price else 0 end) as total_sales'),
        ])->leftjoin('product', 'category.id', '=', 'product.category_id')
            ->leftjoin('customer_order_item', 'product.id', '=', 'customer_order_item.product_id')
            ->leftjoin('customer_order', function ($join) use ($start,$end){
                $join->on('customer_order_item.customer_order_id', '=', 'customer_order.id')
                ->where('customer_order.created_at', '>=', $start)
                ->where('customer_order.created_at', '<=', $end);
            })
            ->groupBy('category.id', 'category.name')
            ->orderBy($column_name, $order_name)
            ->get();

        $pdf = PDF::loadView('admin.export.sales-by-categories',[
            'categories' => $categories,
            'from' => $from,
            'to' => $to,
            'prepared_by' => $prepared_by
        ]);

        return $pdf->download("Category Sales.pdf");
    }
}
