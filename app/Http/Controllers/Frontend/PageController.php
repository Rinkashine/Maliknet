<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class PageController extends Controller
{

    public function contact()
    {
        return view('customer.page.regular.contact', ['metaTitle' => 'Contact']);
    }


    public function shipping()
    {
        return view('customer.page.regular.shipping', ['metaTitle' => 'Product']);
    }

    public function return()
    {
        return view('customer.page.regular.returns', ['metaTitle' => 'Product']);
    }
}
