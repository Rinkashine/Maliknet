<?php

namespace App\Http\Controllers\FrontEnd\Transaction;

use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index()
    {
        return view('customer.page.regular.contact');
    }
}
