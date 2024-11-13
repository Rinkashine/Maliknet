<?php

namespace App\Http\Livewire\Admin\Supplier;

use App\Models\Supplier;
use Livewire\Component;

class ShowSupplier extends Component
{
    public $modelId;

    public $name;

    public $contact_name;

    public $contact_number;

    public $email;

    public $address;

    protected $listeners = [
        'getSupplierModalId',
        'forceCloseModal',
    ];

    public function closeModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('CloseShowModal');
    }

    public function forceCloseModal()
    {
        $this->cleanVars();
    }

    public function getSupplierModalId($modelId)
    {
        $this->modelId = $modelId;
        $supplier = Supplier::onlyTrashed()->findorFail($this->modelId);
        $this->name = $supplier->name;
        $this->contact_name = $supplier->contact_name;
        $this->contact_number = $supplier->contact_number;
        $this->email = $supplier->email;
        $this->address = $supplier->address;
    }

    private function cleanVars()
    {
        $this->modelId = null;
        $this->name = null;
        $this->contact_name = null;
        $this->contactcontact_number_name = null;
        $this->email = null;
        $this->address = null;
    }

    public function render()
    {
        return view('livewire.admin.supplier.show-supplier');
    }
}
