<?php

namespace App\Http\Livewire\Customer\Address;

use App\Models\CustomerShippingAddress;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SetDefaultAddress extends Component
{
    public $modelId;

    protected $listeners = [
        'getModelSetModalId',
        'forceCloseModal',
        'refreshChild' => '$refresh',
    ];

    public function forceCloseModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
    }

    public function getModelSetModalId($modelId)
    {
        $this->modelId = $modelId;
    }

    private function cleanVars()
    {
        $this->modelId = null;
    }

    public function closeModal()
    {
        $this->cleanVars();
        $this->dispatchBrowserEvent('closeSetModal');
    }

    public function SetDefaultAddress()
    {
        $customer_id = Auth::guard('customer')->user()->id;
        $oldshippingaddress = CustomerShippingAddress::where('customers_id', $customer_id)
        ->where('default_address', 1)
        ->get();

        foreach ($oldshippingaddress as $addresses) {
            $addresses->default_address = 0;
            $addresses->update();
        }

        $address = CustomerShippingAddress::find($this->modelId);
        $address->default_address = 1;
        $address->update();
        $this->dispatchBrowserEvent('SuccessAlert', [
            'name' => 'Default Shipping Address was changed successfully',
            'title' => 'Success',
        ]);

        $this->cleanVars();
        $this->dispatchBrowserEvent('closeSetModal');
        $this->emit('refreshParent');
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.customer.address.set-default-address');
    }
}
