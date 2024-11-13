<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class DeleteProduct extends Component
{
    public $modelId;

    public function render()
    {
        return view('livewire.admin.product.delete-product');
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
        abort_if(Gate::denies('product_archive'), 403);
        $product = Product::find($this->modelId);
        $product->delete();
        $this->dispatchBrowserEvent('SuccessAlert', [
            'name' => $product->name.' was successfully deleted!',
            'title' => 'Record Deleted',
        ]);

        $this->emit('refreshParent');
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
    }
}
