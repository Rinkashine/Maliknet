<?php

namespace App\Http\Controllers\Frontend\Account;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class CustomerReviewsController extends Controller
{
    public function index()
    {
        $customer_id = Auth::guard('customer')->user()->id;

        $reviews = Review::where('customer_id', $customer_id)
        ->get();

        return view('customer.account.reviews', [
            'reviews' => $reviews,
        ]);
    }
}
