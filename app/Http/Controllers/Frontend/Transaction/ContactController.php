<?php

namespace App\Http\Controllers\FrontEnd\Transaction;

use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    //Show Contact Page where customers can directly send an email to go dental email
    public function index()
    {
        return view('customer.page.regular.contact');
    }
}
