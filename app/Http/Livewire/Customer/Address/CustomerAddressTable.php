<?php

namespace App\Http\Livewire\Customer\Address;

use App\Models\CustomerShippingAddress;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CustomerAddressTable extends Component
{
    public $action;

    public $selectedItem;

    protected $listeners = [
        'refreshParent' => '$refresh',
    ];

    public function selectItem($itemId, $action)
    {
        $this->selectedItem = $itemId;

        if ($action == 'delete') {
            $this->emit('getModelDeleteModalId', $this->selectedItem);
            $this->dispatchBrowserEvent('openDeleteModal');
        } elseif ($action == 'set') {
            $this->emit('getModelSetModalId', $this->selectedItem);
            $this->dispatchBrowserEvent('openSetModal');
        }
        $this->action = $action;
    }

    public function render()
    {
        if (Auth::guard('customer')->check()) {
            $customer_id = Auth::id();
            $address = CustomerShippingAddress::where('customers_id', $customer_id)->orderBy('name')->get();
            $customeraddress = CustomerShippingAddress::where('customers_id', $customer_id)->count();
        } else {
            return redirect()->route('CLogin.index');
        }

        return view('livewire.customer.address.customer-address-table', [
            'address' => $address,
            'countaddress' => $customeraddress,
        ]);
    }
}
