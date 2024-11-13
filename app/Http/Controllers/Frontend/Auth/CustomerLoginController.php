<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;

class CustomerLoginController extends Controller
{
    //Login Customer Controller
    public function index()
    {
        return view('customer.auth.login');
    }
}
