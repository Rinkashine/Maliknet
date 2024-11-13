<?php

namespace App\Http\Livewire\Customer\Auth;

use Alert;
use App\Jobs\CustomerVerifyJob;
use App\Models\Customer;
use App\Models\CustomerVerify;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Laravolt\Avatar\Facade as Avatar;
use Livewire\Component;

class CustomerRegister extends Component
{
    public $name;

    public $email;

    public $phone;

    public $gender;

    public $password;

    public $password_confirmation;

    public $birthday;

    public $recaptcha;

    public $maxdate;

    protected function rules()
    {
        return [
            'name' => 'required|max:50',
            'email' => 'required|max:60|email|unique:customers,email',
            'phone' => 'required|phone:PH',
            'gender' => 'required',
            'password' => ['required', Password::defaults(), 'same:password_confirmation'],
            'birthday' => 'required|date',
            'recaptcha' => 'required',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|max:50',
            'email' => 'required|max:60|email|unique:customers,email',
            'phone' => 'required|phone:PH',
            'gender' => 'required',
            'password' => ['required', Password::defaults()],
            'birthday' => 'required|date',
            'recaptcha' => 'required',
        ]);
    }

    public function StoreCustomerData()
    {
        $this->validate();
        $avatar = $this->email.Str::random(10);
        if (! Storage::disk('public')->exists('customer_profile_picture')) {
            Storage::disk('public')->makeDirectory('customer_profile_picture', 0775, true);
        }

        $avatarimage = Avatar::create($this->name)->save(storage_path('app/public/customer_profile_picture/'.$avatar.'.png'));
        $customer = Customer::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone,
            'birthday' => $this->birthday,
            'gender' => $this->gender,
            'photo' => $avatar.'.png',
            'password' => Hash::make($this->password),
        ]);

        $token = $customer->id.hash('sha256', \Str::random(120));
        $verifyURL = route('verify', ['token' => $token, 'service' => 'Email_verification']);

        CustomerVerify::create([
            'customers_id' => $customer->id,
            'token' => $token,
        ]);

        $message = 'Dear <b>'.$this->name.'</b>';
        $message .= ' Thanks for signing up, we just need you to verify your email address to complete setting up your account.';

        $details = [
            'email' => $this->email,
            'name' => $this->name,
            'subject' => 'Go Dental Email Verification',
            'body' => $message,
            'actionLink' => $verifyURL,
        ];

        dispatch(new CustomerVerifyJob($details));
        if ($customer) {
            Alert::success('Registered Successfully', 'You can now Login. Email verification has been sent into your email account.');

            return redirect()->route('CLogin.index');
        } else {
            Alert::success('Failed To Register', 'Something went wrong!, Failed to register');

            return back();
        }
    }

    public function render()
    {
        return view('livewire.customer.auth.customer-register');
    }
}
