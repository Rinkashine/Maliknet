<?php

namespace App\Http\Controllers\Frontend\Transaction;

use Alert;
use App\Http\Controllers\Controller;
use App\Models\CustomerCart;
use App\Models\CustomerShippingAddress;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $customer_id = Auth::guard('customer')->user()->id;
        $checkoutcount = CustomerCart::with('product', 'customer')
            ->where('customers_id', $customer_id)
            ->where('check', 1)
            ->count();
        $shippingaddresscount = CustomerShippingAddress::where('customers_id', $customer_id)->count();
        if ($checkoutcount == 0) {
            Alert::warning('No Products in Cart', 'Please add products into the cart before checking out');

            return redirect()->route('cart.index');
        }
        if ($shippingaddresscount == 0) {
            Alert::warning('No Shipping Address', 'Please Add Shipping Address Before Checking Out');

            return redirect()->route('cart.index');
        }

        return view('customer.page.cart.checkout');
    }
}
