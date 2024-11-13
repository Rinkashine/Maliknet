<?php

namespace App\Http\Controllers\Frontend\Auth;

use Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResetCustomerPassword;
use App\Jobs\CustomerResetPasswordJob;
use App\Models\Customer;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomerResetController extends Controller
{
    public function index()
    {
        return view('customer.auth.reset');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:customers,email',
        ]);
        $restrictedcustomer = Customer::onlyTrashed()->where('email', $request->email)->get();
        if (count($restrictedcustomer) == 0) {
            $token = Str::random(64);
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);

            $details = [
                'email' => $request['email'],
                'action_link' => route('customer.reset.password.form', ['token' => $token, 'email' => $request->email]),
            ];

            dispatch(new CustomerResetPasswordJob($details));

            return back()->with('success', 'A Verification email has been sent to this email address '.$request->email.' Please verify it.');
        } else {
            Alert::error('Account Restricted', 'Contact Customer Support to Retrieve your account');

            return back();
        }
    }

    public function ShowResetForm(Request $request, $token = null)
    {
        return view('customer.auth.forgot')->with(['token' => $token, 'email' => $request->email]);
    }

   public function ResetPassword(ResetCustomerPassword $request)
   {
       $request->validated();

       $check_token = \DB::table('password_resets')->where([
           'email' => $request->email,
           'token' => $request->token,
       ])->first();

       if (! $check_token) {
           return back()->withInput()->with('fail', 'Invalid token');
       } else {
           Customer::where('email', $request->email)->update([
               'password' => \Hash::make($request->password),
           ]);

           \DB::table('password_resets')->where([
               'email' => $request->email,
           ])->delete();

           return redirect()->route('CLogin.index')->with('info', 'Your password has been changed! You can login with new password')->with('verifiedEmail', $request->email);
       }
   }
}
