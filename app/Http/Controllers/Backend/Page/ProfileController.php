<?php

namespace App\Http\Controllers\Backend\Page;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.page.profile.user-info');
    }

    public function changepass()
    {
        return view('admin.page.profile.changepass');
    }

    public function resetpass(Request $request)
    {
        if (! (Hash::check($request->get('current_password'), Auth::guard('web')->user()->password))) {
            // The passwords matches
            return redirect()->back()->with('error', 'Your current password does not matches with the password.')->withInput();
        }

        if (strcmp($request->get('current_password'), $request->get('password')) == 0) {
            // Current password and new password same
            return redirect()->back()->with('error', 'New Password cannot be same as your current password.')->withInput();
        }

        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        //Change Password
        User::whereId(Auth::guard('web')->user()->id)->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Password successfully changed!');
    }
}
