<?php

namespace App\Http\Livewire\Customer\Auth;

use Alert;
use App\Models\Customer;
use Livewire\Component;

class CustomerChangeInformation extends Component
{
    public $name;

    public $phone;

    public $customer_id;

    protected $listeners = [
        'ForceClose',
        'refreshChild' => '$refresh',
        'getModelId',
    ];

    public function getModelId($modelId)
    {
        $this->customer_id = $modelId;
        $customerinfo = Customer::findorfail($this->customer_id);
        $this->name = $customerinfo->name;
        $this->phone = $customerinfo->phone_number;
    }

    protected function rules()
    {
        return [
            'name' => 'required|max:50',
            'phone' => 'required|phone:PH',
        ];
    }

    public function update($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|max:50',
            'phone' => 'required|phone:PH',
        ]);
    }

    public function cleanVars()
    {
        $this->name = null;
        $this->phone = null;
    }

    public function UpdateProfileInformation()
    {
        $this->validate();
        $updatecustomerinfo = Customer::findorfail($this->customer_id);
        $updatecustomerinfo->name = $this->name;
        $updatecustomerinfo->phone_number = $this->phone;
        $updatecustomerinfo->update();
        Alert::success('Success', 'Profile Information was updated successfully');

        return redirect()->route('customer.profile');
        $this->emit('CloseModal');
    }

    public function CloseModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('CloseInformationModal');
    }

    public function ForceClose()
    {
        $this->emit('CloseModal');
    }

    public function render()
    {
        return view('livewire.customer.auth.customer-change-information');
    }
}
