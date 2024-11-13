<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Component;

class ShowProduct extends Component
{
    public $modelId;

    public $name;

    public $category;

    public $brand;

    public $stock;

    public $sku;

    public $cprice;

    public $sprice;

    public $weight;

    public $description;

    protected $listeners = [
        'getProductModalId',
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

    public function getProductModalId($modelId)
    {
        $this->modelId = $modelId;
        $product = Product::onlyTrashed()->findorFail($this->modelId);
        $this->name = $product->name;
        $this->category = $product->category->name;
        $this->brand = $product->brand->name;
        $this->stock = $product->stock;
        $this->cprice = $product->cprice;
        $this->sprice = $product->sprice;
        $this->sku = $product->SKU;
        $this->description = $product->description;
        $this->weight = $product->weight;
    }

    private function cleanVars()
    {
        $this->modelId = null;
        $this->name = null;
    }

    public function render()
    {
        return view('livewire.admin.product.show-product');
    }
}
