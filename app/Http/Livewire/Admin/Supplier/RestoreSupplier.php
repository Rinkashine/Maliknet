<?php

namespace App\Http\Livewire\Admin\Supplier;

use App\Models\Supplier;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class RestoreSupplier extends Component
{
    public $modelId;

    public function render()
    {
        return view('livewire.admin.supplier.restore-supplier');
    }

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

    public function getModelRestoreId($modelId)
    {
        $this->modelId = $modelId;
    }

    public function closeModal()
    {
        $this->cleanVars();
        $this->dispatchBrowserEvent('closeRestoreModal');
    }

    public function restore()
    {
        abort_if(Gate::denies('supplier_restore'), 403);
        $supplier = Supplier::onlyTrashed()->find($this->modelId);
        $supplier->restore();
        $this->dispatchBrowserEvent('SuccessAlert', [
            'name' => $supplier->name.' was successfully restored!',
            'title' => 'Record Restore',
        ]);

        $this->emit('refreshParent');
        $this->cleanVars();
        $this->dispatchBrowserEvent('closeRestoreModal');
    }
}
