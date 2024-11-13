<?php

namespace App\Http\Controllers\Frontend\Account;

use App\Http\Controllers\Controller;

class CustomerWishlistController extends Controller
{
    public function index()
    {
        return view('customer.account.wishlist');
    }
}
