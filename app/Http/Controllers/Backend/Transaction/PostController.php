<?php

namespace App\Http\Controllers\Backend\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    //Show Post Page
    public function index()
    {
        abort_if(Gate::denies('post_access'), 403);

        return view('admin.page.Transaction.post');
    }
}
