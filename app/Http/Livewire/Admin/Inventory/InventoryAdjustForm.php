<?php

namespace App\Http\Livewire\Admin\Inventory;

use App\Models\InventoryHistory;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InventoryAdjustForm extends Component
{
    public $inventoryAdjust;

    public $modelId;

    public $productname;

    public $total;

    public $reason;

    public $original;

    protected $listeners = [
        'getAdjustModalId',
        'refreshChild' => '$refresh',
        'forceCloseModal',
    ];

    public function render()
    {
        return view('livewire.admin.inventory.inventory-adjust-form');
    }

    public function forceCloseModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
    }

    public function getAdjustModalId($modelId)
    {
        $this->modelId = $modelId;
        $product = Product::findorFail($this->modelId);
        $this->inventoryedit = $product->stock;
        $this->productname = $product->name;
        $this->original = $product->stock;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'inventoryAdjust' => 'required|numeric',
            'reason' => 'required',
        ]);
    }

    protected function rules()
    {
        return [
            'inventoryAdjust' => 'required|numeric',
            'reason' => 'required',
        ];
    }

    public function AdjustInventoryData()
    {
        $product = Product::findorFail($this->modelId);
        $this->validate();
        if ($this->inventoryAdjust != 0) {
            $total = $product->stock + $this->inventoryAdjust;
            $product->stock = $total;
            $product->update();

            if ($this->inventoryAdjust >= 1) {
                $value = '+'.$this->inventoryAdjust;
            } else {
                $value = $this->inventoryAdjust;
            }

            $operationvalue = '('.$value.')';
            $latest_value = $product->stock;

            InventoryHistory::create([
                'product_id' => $product->id,
                'activity' => $this->reason,
                'adjusted_by' => Auth::guard('web')->user()->name,
                'operation_value' => $operationvalue,
                'latest_value' => $latest_value,
            ]);

            $this->dispatchBrowserEvent('SuccessAlert', [
                'name' => $this->productname.' was successfully saved!',
                'title' => 'Product Inventory Adjusted',
            ]);
        }

        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseModal');
        $this->emit('refreshParent');
        $this->resetErrorBag();
    }

    private function cleanVars()
    {
        $this->modelId = null;
        $this->inventoryAdjust = null;
        $this->productname = null;
        $this->total = null;
    }

    public function closeModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('CloseModal');
    }
}
