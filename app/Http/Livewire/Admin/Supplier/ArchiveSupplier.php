<?php

namespace App\Http\Livewire\Admin\Supplier;

use App\Models\Supplier;
use Livewire\Component;

class ArchiveSupplier extends Component
{
    public $modelId;

    protected $listeners = [
        'getModelArchiveID',
        'refreshChild' => '$refresh',
        'forceCloseModal',
    ];

    public function forceCloseModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
    }

    public function getModelArchiveID($modelId)
    {
        $this->modelId = $modelId;
    }

    public function closeModal()
    {
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
    }

    private function cleanVars()
    {
        $this->modelId = null;
    }

    public function delete()
    {
        $supplier = Supplier::find($this->modelId);
        $supplier->delete();
        $this->dispatchBrowserEvent('SuccessAlert', [
            'name' => $supplier->name.' was successfully archived!',
            'title' => 'Record Archived',
        ]);

        $this->emit('refreshParent');
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
    }

    public function render()
    {
        return view('livewire.admin.supplier.archive-supplier');
    }
}
