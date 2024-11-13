<?php

namespace App\Http\Livewire\Report;

use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class AccountVerification extends Component
{
    public $accountdataset = [];
    public $accountlabel = [];

    public function cleanVars(){
        $this->accountdataset = [];
        $this->accountlabel = [];
    }
    public function render()
    {
        $this->cleanVars();

        $nonverified = Customer::all()->where('email_verified_at','=','')->count();
        $verified = Customer::all()->where('email_verified_at','!=','')->count();

        $this->accountlabel = ['Verified','Non-Verified'];
        array_push($this->accountdataset, $verified);
        array_push($this->accountdataset, $nonverified);

        return view('livewire.report.account-verification',[
            'nonverified' => $nonverified,
            'verified'=> $verified
        ]);
    }
}
