<?php

namespace App\Http\Livewire\Customer\Checkout;

use App\Models\CustomerShippingAddress;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChangeAddressForm extends Component
{
    protected $listeners = [
        'getAddressId',
    ];

    public $updateAddress;

    public function getAddressId($id)
    {
        $this->updateAddress = $id;
    }

    public function UpdatedAddress()
    {
        $this->emit('NewAddress', $this->updateAddress);
        $this->dispatchBrowserEvent('CloseAddressModal');
    }

    public function render()
    {
        $customer_id = Auth::guard('customer')->user()->id;
        $shippingaddresses = CustomerShippingAddress::where('customers_id', $customer_id)->get();

        return view('livewire.customer.checkout.change-address-form', [
            'shippingaddresses' => $shippingaddresses,
        ]);
    }
}
