<?php

namespace App\Http\Controllers\Frontend\Transaction;

use App\Http\Controllers\Controller;

class ShippingController extends Controller
{
    public function index()
    {
        return view('customer.page.cart.shipping');
    }
}
