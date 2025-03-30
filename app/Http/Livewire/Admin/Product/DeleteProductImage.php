<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\ProductGallery;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DeleteProductImage extends Component
{
    public $modelId;

    protected $listeners = [
        'getModelDeleteModalId',
        'refreshChild' => '$refresh',
        'forceCloseModal',
    ];

    public function getModelDeleteModalId($modelId)
    {
        $this->modelId = $modelId;
    }

    public function forceCloseModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
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
        $gallery = ProductGallery::findorfail($this->modelId);
        Storage::delete('public/product_gallery/'.$gallery->file);
        $gallery->delete();
        $this->emit('refreshParent');
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
        $this->dispatchBrowserEvent('SuccessAlert', [
            'name' => 'Image was permanently deleted',
            'title' => 'Image was Deleted Successfully',
        ]);
    }

    public function render()
    {
        return view('livewire.admin.product.delete-product-image');
    }
}
