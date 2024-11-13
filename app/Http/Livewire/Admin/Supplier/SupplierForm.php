<?php

namespace App\Http\Livewire\Admin\Supplier;

use App\Models\Supplier;
use Livewire\Component;

class SupplierForm extends Component
{
    public $name;

    public $contact_name;

    public $address;

    public $email;

    public $contact_number;

    public $supplier;

    public function mount($supplier)
    {
        $this->supplier = null;
        if ($supplier) {
            $this->supplier = $supplier;
            $this->name = $this->supplier->name;
            $this->contact_name = $this->supplier->contact_name;
            $this->address = $this->supplier->address;
            $this->contact_number = $this->supplier->contact_number;
            $this->email = $this->supplier->email;
        }
    }

    protected function rules()
    {
        return [
            'name' => 'required',
            'contact_name' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'contact_number' => 'required|numeric|digits:11',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'contact_name' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'contact_number' => 'required|numeric|digits:11',
        ]);
    }

    public function StoreSupplierData()
    {
        $this->validate();
        $supplier = [
            'name' => $this->name,
            'contact_name' => $this->contact_name,
            'address' => $this->address,
            'contact_number' => $this->contact_number,
            'email' => $this->email,
        ];
        if ($this->supplier) {
            Supplier::find($this->supplier->id)->update($supplier);

            return redirect()->route('supplier.index')->with('editSuccess', $this->name.' was successfully edited');
        } else {
            Supplier::create($supplier);
            $this->dispatchBrowserEvent('SuccessAlert', [
                'name' => $this->name.' was successfully saved!',
                'title' => 'Record Saved',
            ]);

            return redirect()->route('supplier.index')->with('success', $this->name.' was successfully inserted');
        }
    }

    public function render()
    {
        return view('livewire.admin.supplier.supplier-form');
    }
}
