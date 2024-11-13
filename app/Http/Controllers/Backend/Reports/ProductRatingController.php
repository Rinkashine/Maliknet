<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use PDF;
use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Product;

class ProductRatingController extends Controller
{
    public function ProductRatings(){
        abort_if(Gate::denies('report_access'),403);
        return view('admin.page.Report.productratings');
    }

    public function exportProductRatings(Request $request){
        abort_if(Gate::denies('report_access'),403);
        $prepared_by = Auth::guard('web')->user()->name;
        $start = $request->startdate;
        $end = $request->enddate;
        $column_name = "";
        $order_name = "";
        if ($request->sorting == 'product_name_asc') {
            $column_name = 'product.name';
            $order_name = 'asc';
        } elseif ($request->sorting == 'product_name_desc') {
            $column_name = 'product.name';
            $order_name = 'desc';
        } elseif ($request->sorting == 'total_number_asc') {
            $column_name = 'total';
            $order_name = 'asc';
        } elseif ($request->sorting == 'total_number_desc') {
            $column_name = 'total';
            $order_name = 'desc';
        } elseif ($request->sorting == 'total_rating_asc') {
            $column_name = 'rate';
            $order_name = 'asc';
        } elseif ($request->sorting == 'total_rating_desc') {
            $column_name = 'rate';
            $order_name = 'desc';
        } elseif ($request->sorting == 'ratingLow') {
            $column_name = 'ave';
            $order_name = 'asc';
        } elseif ($request->sorting == 'ratingHigh') {
            $column_name = 'ave';
            $order_name = 'desc';
        } else {
            $column_name = 'product.name';
            $order_name = 'asc';
        }


        $products = Product::select([
            'product.name',
            'product.id',
            DB::raw(value: 'COUNT(CASE WHEN product_review.customer_order_item_id = customer_order_item.id then product.id end) AS total'),
            DB::raw(value: 'SUM(CASE WHEN product_review.customer_order_item_id = customer_order_item.id then rate end) AS rate'),
            DB::raw(value: '(SUM(CASE WHEN product_review.customer_order_item_id = customer_order_item.id then rate end)/COUNT(CASE WHEN product_review.customer_order_item_id = customer_order_item.id then product.id end)) AS ave')
        ])
        ->leftjoin('customer_order_item', 'product.id', '=', 'customer_order_item.product_id')
        ->leftjoin('product_review',function($join) use ($start,$end){
            $join->on('product_review.customer_order_item_id', '=', 'customer_order_item.id')
            ->where('product_review.created_at', '>=', $start)
            ->where('product_review.created_at', '<=', $end);
        })
        ->groupBy('product.id','product.name')
        ->orderBy($column_name, $order_name)
        ->get();

        $from = Carbon::parse($start)->format("F d, Y H:i A");
        $to = Carbon::parse($end)->format("F d, Y H:i A");

        $pdf = PDF::loadView('admin.export.product-ratings',[
            'products' => $products,
            'from' => $from,
            'to' => $to,
            'prepared_by' => $prepared_by
        ]);

        return $pdf->download("Product Ratings.pdf");
    }

}
