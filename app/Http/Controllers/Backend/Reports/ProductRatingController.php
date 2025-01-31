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

    public function exportProductRatings(Request $request)
    {
        abort_if(Gate::denies('report_access'), 403);

        $prepared_by = Auth::guard('web')->user()->name;
        $start = $request->startdate;
        $end = $request->enddate;

        // Fetch min and max dates if start or end date is null
        if (is_null($start)) {
            $start = Product::leftJoin('customer_order_item', 'product.id', '=', 'customer_order_item.product_id')
                ->leftJoin('product_review', 'product_review.customer_order_item_id', '=', 'customer_order_item.id')
                ->min('product_review.created_at');
        }

        if (is_null($end)) {
            $end = Product::leftJoin('customer_order_item', 'product.id', '=', 'customer_order_item.product_id')
                ->leftJoin('product_review', 'product_review.customer_order_item_id', '=', 'customer_order_item.id')
                ->max('product_review.created_at');
        }

        $sortingOptions = [
            'product_name_asc' => ['product.name', 'asc'],
            'product_name_desc' => ['product.name', 'desc'],
            'total_number_asc' => ['total', 'asc'],
            'total_number_desc' => ['total', 'desc'],
            'total_rating_asc' => ['rate', 'asc'],
            'total_rating_desc' => ['rate', 'desc'],
            'ratingLow' => ['ave', 'asc'],
            'ratingHigh' => ['ave', 'desc']
        ];

        [$column_name, $order_name] = $sortingOptions[$request->sorting] ?? ['product.name', 'asc'];

        $products = Product::select([
            'product.name',
            'product.id',
            DB::raw('COUNT(CASE WHEN product_review.customer_order_item_id = customer_order_item.id then product.id end) AS total'),
            DB::raw('SUM(CASE WHEN product_review.customer_order_item_id = customer_order_item.id then rate end) AS rate'),
            DB::raw('(SUM(CASE WHEN product_review.customer_order_item_id = customer_order_item.id then rate end) /
                      COUNT(CASE WHEN product_review.customer_order_item_id = customer_order_item.id then product.id end)) AS ave')
        ])
        ->leftJoin('customer_order_item', 'product.id', '=', 'customer_order_item.product_id')
        ->leftJoin('product_review', function ($join) use ($start, $end) {
            $join->on('product_review.customer_order_item_id', '=', 'customer_order_item.id')
                ->whereBetween('product_review.created_at', [$start, $end]);
        })
        ->groupBy('product.id', 'product.name')
        ->orderBy($column_name, $order_name)
        ->get();

        $from = Carbon::parse($start)->format("F d, Y H:i A");
        $to = Carbon::parse($end)->format("F d, Y H:i A");

        $pdf = PDF::loadView('admin.export.product-ratings', [
            'products' => $products,
            'from' => $from,
            'to' => $to,
            'prepared_by' => $prepared_by
        ]);

        return $pdf->download("Product Ratings.pdf");
    }
}
