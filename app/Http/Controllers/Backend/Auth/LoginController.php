<?php

namespace App\Http\Controllers\Backend\Auth;

use Alert;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
        return view('admin.auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ], [
            'email.exists' => 'Email does not exists',
        ]);
        $restricteduser = User::onlyTrashed()->where('email', $request->email)->get();
        if (count($restricteduser) == 0) {
            $creds = $request->only('email', 'password');
            if (Auth::guard('web')->attempt($request->only('email', 'password'), $request->remember)) {
                return redirect()->route('dashboard.index');
            } else {
                return back()->with('fail', 'Incorrect credentials')->withInput();
            }
        } else {
            Alert::error('Account Restricted', 'Contact the Administrator to unlift the restriction');

            return back();
        }

        /*
         if(!auth()->attempt($request->only('email','password'),$request->remember)){
            return back()->with('status','Invalid username or password');
        }
        return redirect()->route('dashboard.index');
        */
    }
}
