<?php

namespace App\Http\Livewire\Customer\Address;

use App\Models\CustomerShippingAddress;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DeleteCustomerAddress extends Component
{
    public $modelId;

    protected $listeners = [
        'getModelDeleteModalId',
        'refreshChild' => '$refresh',
        'forceCloseModal',
    ];

    public function forceCloseModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
    }

    private function cleanVars()
    {
        $this->modelId = null;
    }

    public function getModelDeleteModalId($modelId)
    {
        $this->modelId = $modelId;
    }

    public function closeModal()
    {
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
    }

    public function delete()
    {
        $address = CustomerShippingAddress::find($this->modelId);
        $address->delete();
        $this->dispatchBrowserEvent('SuccessAlert', [
            'name' => $address->name.' was successfully deleted!',
            'title' => 'Record Deleted',
        ]);
        $customer_id = Auth::guard('customer')->user()->id;
        $HasNoDefaultAddress = CustomerShippingAddress::where('customers_id', $customer_id)
        ->where('default_address', 1)
        ->count();

        if ($HasNoDefaultAddress == 0) {
            $AddNewShippingAddress = CustomerShippingAddress::where('customers_id', $customer_id)
            ->where('default_address', 0)
            ->take(1)
            ->get();
            foreach ($AddNewShippingAddress as $address) {
                $address->default_address = 1;
                $address->update();
            }
        }

        $this->emit('refreshParent');
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
    }

    public function render()
    {
        return view('livewire.customer.address.delete-customer-address');
    }
}
