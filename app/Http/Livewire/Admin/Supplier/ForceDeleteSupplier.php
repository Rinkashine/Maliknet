<?php

namespace App\Http\Livewire\Admin\Supplier;

use App\Models\Supplier;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class ForceDeleteSupplier extends Component
{
    public $modelId;

    public function render()
    {
        return view('livewire.admin.supplier.force-delete-supplier');
    }

    protected $listeners = [
        'getModelDeleteModalId',
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
        abort_if(Gate::denies('supplier_forcedelete'), 403);
        $supplier = Supplier::onlyTrashed()->find($this->modelId);
        $supplier->forcedelete();
        $this->dispatchBrowserEvent('SuccessAlert', [
            'name' => $supplier->name.' was successfully deleted!',
            'title' => 'Record Deleted',
        ]);

        $this->emit('refreshParent');
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
    }
}
