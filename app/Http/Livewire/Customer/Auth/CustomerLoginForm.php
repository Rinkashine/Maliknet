<?php

namespace App\Http\Livewire\Customer\Auth;

use Alert;
use App\Models\Customer;
use Http;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CustomerLoginForm extends Component
{
    public $email;

    public $password;

    public $remember;
    public $captcha = 0;


    public function render()
    {
        return view('livewire.customer.auth.customer-login-form');
    }

    protected function rules()
    {
        return [
            'email' => 'required',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'email' => 'required',
        ]);
    }


    public function updatedCaptcha($token)
    {
        $response = Http::post('https://www.google.com/recaptcha/api/siteverify?secret='.env('CAPTCHA_SECRET_KEY').'&response='.$token);
        $this->captcha = $response->json()['score'];
        if ($this->captcha > .3) {
            $this->login();
        } else {
            Alert::error('Message Successfully Sent', '');

            return redirect()->route('CLogin.index');
        }
    }

    public function login()
    {
        $this->validate();
        $restrictedcustomers = Customer::onlyTrashed()->where('email', $this->email)->get();

        if (count($restrictedcustomers) == 0) {
            if (Auth::guard('customer')->attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
                $appName = env('APP_NAME');

                Alert::success('Login Successfully', 'Welcome to ' . $appName);
                return redirect()->route('home');
            } else {
                return back()->with('fail', 'Your Account and/or password is incorrect, please try again')->withInput();
            }
        } else {
            Alert::error('Account Restricted', 'Contact Customer Support to Retrieve your account');

            return redirect()->route('CLogin.index');
        }
    }
}
