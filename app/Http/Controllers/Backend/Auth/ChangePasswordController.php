<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;

class ChangePasswordController extends Controller
{
    public function index()
    {
        return view('admin.auth.changepass');
    }
}
