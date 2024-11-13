<?php

namespace App\Http\Controllers\Backend\Users;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller
{
    //Show Customer Page
    public function index()
    {
        abort_if(Gate::denies('customer_access'), 403);

        return view('admin.page.Users.customer');
    }

    public function show(Customer $customer)
    {
        abort_if(Gate::denies('customer_show'), 403);

        return view('admin.page.Users.customershow', [
            'customer' => $customer,
        ]);
    }

    public function CustomerArchiveIndex()
    {
        abort_if(Gate::denies('customer_archive_access'), 403);

        return view('admin.page.Users.customerarchive');
    }
}
