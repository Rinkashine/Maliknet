<?php

namespace App\Http\Controllers\Frontend\Auth;

use Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerAddress;
use App\Http\Requests\UpdateCustomerAddress;
use App\Jobs\CustomerVerifyJob;
use App\Models\Customer;
use App\Models\CustomerShippingAddress;
use App\Models\CustomerVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerProfileController extends Controller
{
    //Profile
    public function index()
    {
        return view('customer.account.profile');
    }

    //Address Page
    public function address()
    {
        if (Auth::guard('customer')->check()) {
            $customer_id = Auth::id();
            $address = CustomerShippingAddress::where('customers_id', $customer_id)->orderBy('name')->get();
            $countaddress = CustomerShippingAddress::where('customers_id', $customer_id)->count();
        } else {
            return redirect()->route('CLogin.index');
        }

        return view('customer.account.address', [
            'address' => $address,
            'countaddress' => $countaddress,
        ]);
    }

    //Create Address Page
    public function createaddress()
    {
        return view('customer.account.createaddress');
    }

    //Store Customer Address
    public function saveaddress(StoreCustomerAddress $request)
    {
        $request->validated();

        if (Auth::guard('customer')->check()) {
            $customer_id = Auth::id();
            $customeraddress = CustomerShippingAddress::where('customers_id', $customer_id)->count();
            if ($customeraddress <= 4) {
                $hasdefaultaddress = CustomerShippingAddress::where('customers_id', $customer_id)->where('default_address', '1')->count();
                if ($hasdefaultaddress == 0) {
                    CustomerShippingAddress::create([
                        'name' => $request->full_name,
                        'customers_id' => $customer_id,
                        'phone_number' => $request->phone_number,
                        'notes' => $request->notes,
                        'house' => $request->house,
                        'province' => $request->province,
                        'city' => $request->city,
                        'barangay' => $request->barangay,
                        'default_address' => 1,
                    ]);
                } else {
                    CustomerShippingAddress::create([
                        'name' => $request->full_name,
                        'customers_id' => $customer_id,
                        'phone_number' => $request->phone_number,
                        'notes' => $request->notes,
                        'house' => $request->house,
                        'province' => $request->province,
                        'city' => $request->city,
                        'barangay' => $request->barangay,
                        'default_address' => 0,
                    ]);
                }

                return redirect()->route('customer.address')->with('success', 'Address was successfully added');
            } else {
                return redirect()->route('customer.address')->with('invalid', 'You can only add up to five shipping address');
            }
        } else {
            return back()->with('invalid', 'Invalid!!!');
        }
    }

    //Edit Customer Address
    public function editaddress($id)
    {
        $address = CustomerShippingAddress::findorFail($id);

        return view('customer.account.editaddress', [
            'address' => $address,
        ]);
    }

    //Update Customer Address
    public function updateaddress(UpdateCustomerAddress $request, $id)
    {
        $address = CustomerShippingAddress::findorFail($id);
        $request->validated();

        if (Auth::guard('customer')->check()) {
            $customer_id = Auth::id();
            $address->name = $request->input('full_name');
            $address->phone_number = $request->input('phone_number');
            $address->house = $request->input('house');
            $address->province = $request->input('province');
            $address->city = $request->input('city');
            $address->barangay = $request->input('barangay');
            $address->update();

            return redirect()->route('customer.address')->with('success', 'Address was edited successfully');
        } else {
            return back()->with('fail', 'Invalid!!!');
        }
    }

    //Change Password Page
    public function changepassword()
    {
        return view('customer.account.changepass');
    }

    //Reset Password
    public function resetpass(Request $request)
    {
        if (! (Hash::check($request->get('current_password'), Auth::guard('customer')->user()->password))) {
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
        Customer::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Password successfully changed!');
    }

    public function VerifyAccount()
    {
        //Get the customer id that was inserted
        $last_id = Auth::guard('customer')->user()->id;
        //Genereting a unique token
        $token = $last_id.hash('sha256', \Str::random(120));
        $verifyURL = route('verify', ['token' => $token, 'service' => 'Email_verification']);

        CustomerVerify::create([
            'customers_id' => $last_id,
            'token' => $token,
        ]);

        $message = 'Dear <b>'.Auth::guard('customer')->user()->name.'</b>';
        $message .= ' Thanks for signing up, we just need you to verify your email address to complete setting up your account.';

        $details = [
            'email' => Auth::guard('customer')->user()->email,
            'name' => Auth::guard('customer')->user()->name,
            'subject' => 'Maliknet Email Verification',
            'body' => $message,
            'actionLink' => $verifyURL,
        ];
        //dispatch the job for sending the email
        dispatch(new CustomerVerifyJob($details));

        Alert::success('Email Verification Sent', 'The email verification has successfully been sent into your email account');

        return back()->with('success', 'You account is now fully verified');
    }
}
