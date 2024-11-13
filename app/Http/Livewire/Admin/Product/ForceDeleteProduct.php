<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ForceDeleteProduct extends Component
{
    public $modelId;

    public function render()
    {
        return view('livewire.admin.product.force-delete-product');
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
        abort_if(Gate::denies('product_forcedelete'), 403);
        $product = Product::onlyTrashed()->find($this->modelId);
        $image = ProductImage::where('product_id', '=', $product->id)->get();

        foreach ($image as $item) {
            Storage::delete('public/product_photos/'.$item->images);
        }
        $product->forcedelete();
        $this->dispatchBrowserEvent('SuccessAlert', [
            'name' => $product->name.' was successfully deleted!',
            'title' => 'Record Deleted',
        ]);

        $this->emit('refreshParent');
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
    }
}
