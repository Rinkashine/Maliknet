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
use App\Models\Review;

class RatingsByCustomerController extends Controller
{
    public function ProductRatingsByCustomer(Request $request){
        abort_if(Gate::denies('report_access'),403);
        return view('admin.page.Report.productratingsbycustomer', [
            'product_id' => $request->product_id,
            'product_name' => $request->product_name,
            'from' => $request->from,
            'to' => $request->to,
        ]);
    }

    public function exportProductRatingsByCustomer(Request $request){
        abort_if(Gate::denies('report_access'),403);
        $prepared_by = Auth::guard('web')->user()->name;

        $start = $request->startdate;
        $end = $request->enddate;
        $product_id = $request->product_id;
        $product_info = Product::findorfail($product_id);
        $product_name = $product_info->name;

        $name = $request->name;
        if ($request->sorting == 'customer_name_asc') {
            $column_name = 'customers.name';
            $order_name = 'asc';
        } elseif ($request->sorting == 'customer_name_desc') {
            $column_name = 'customers.name';
            $order_name = 'desc';
        } elseif ($request->sorting == 'recent') {
            $column_name = 'product_review.created_at';
            $order_name = 'desc';
        } elseif ($request->sorting == 'total_rating_asc') {
            $column_name = 'rate';
            $order_name = 'asc';
        } elseif ($request->sorting == 'total_rating_desc') {
            $column_name = 'rate';
            $order_name = 'desc';
        }


        $reviews = Review::join('customer_order_item', 'product_review.customer_order_item_id', '=', 'customer_order_item.id')
        ->leftjoin('customers','customers.id','=','product_review.customer_id')
        ->select([
            'rate',
            'customer_order_item.customer_order_id', 'customers.name',
            DB::raw('(SELECT customers.name FROM customers WHERE customers.id = product_review.customer_id) as customer_name'),
            DB::raw('(SELECT customers.photo FROM customers WHERE customers.id = product_review.customer_id) as customer_photo'),
            'product_review.created_at'])
        ->where('product_id', $product_id)
        ->where('product_review.created_at', '>=', $start)
        ->where('product_review.created_at', '<=', $end)
        ->orderby($column_name, $order_name)
        ->get();

        $from = Carbon::parse($start)->format("F d, Y H:i A");
        $to = Carbon::parse($end)->format("F d, Y H:i A");

        $pdf = PDF::loadView('admin.export.product-ratings-per-customer',[
            'reviews' => $reviews,
            'from' => $from,
            'to' => $to,
            'prepared_by' => $prepared_by,
            'product_name' => $product_name
        ]);

        return $pdf->download("$product_name Ratings.pdf");

    }
 //
}
