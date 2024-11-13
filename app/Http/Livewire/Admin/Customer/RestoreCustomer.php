<?php

namespace App\Http\Livewire\Admin\Customer;

use App\Models\Customer;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class RestoreCustomer extends Component
{
    public $modelId;

    protected $listeners = [
        'getModelRestoreId',
        'forceCloseModal',
        'refreshChild' => '$refresh',
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

    public function closeModal()
    {
        $this->cleanVars();
        $this->dispatchBrowserEvent('closeRestoreModal');
    }

    public function getModelRestoreId($modelId)
    {
        $this->modelId = $modelId;
    }

    public function restore()
    {
        abort_if(Gate::denies('customer_restore'), 403);
        $customer = Customer::onlyTrashed()->find($this->modelId);
        $customer->restore();
        $this->dispatchBrowserEvent('SuccessAlert', [
            'name' => $customer->name.' was successfully restored!',
            'title' => 'Record Restore',
        ]);

        $this->emit('refreshParent');
        $this->cleanVars();
        $this->dispatchBrowserEvent('closeRestoreModal');
    }

    public function render()
    {
        return view('livewire.admin.customer.restore-customer');
    }
}
