<?php

namespace App\Http\Livewire\Admin\Inventory;

use App\Models\InventoryHistory;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InventoryEditForm extends Component
{
    public $inventoryedit;

    public $modelId;

    public $productname;

    protected $listeners = [
        'getEditModalId',
        'refreshChild' => '$refresh',
        'forceCloseModal',
    ];

    protected function rules()
    {
        return [
            'inventoryedit' => 'required|numeric|min:0',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'inventoryedit' => 'required|numeric|min:0',
        ]);
    }

    protected $messages = [
        'inventoryedit.min' => 'Product Stock Cannot Be A Negative Value',
        'inventoryedit.required' => 'Product Stock Cannot Be Empty',
        'inventoryedit.numeric' => 'Product Stock Must Be A Number',
    ];

    public function forceCloseModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
    }

    public function getEditModalId($modelId)
    {
        $this->modelId = $modelId;
        $product = Product::findorFail($this->modelId);
        $this->inventoryedit = $product->stock;
        $this->productname = $product->name;
    }

    public function EditInventoryData()
    {
        $product = Product::findorFail($this->modelId);
        $old = $product->stock;
        $this->validate();
        $product->stock = $this->inventoryedit;
        $product->update();
        $total = $this->inventoryedit - $old;
        if ($total != 0) {
            if ($total >= 1) {
                $value = '+'.$total;
            } else {
                $value = $total;
            }
            $operationvalue = '('.$value.')';
            $latestvalue = $product->stock;
            //$available =   '('.$value.')'.$product->stock;
            InventoryHistory::create([
                'product_id' => $product->id,
                'activity' => 'Inventory Correction',
                'adjusted_by' => Auth::guard('web')->user()->name,
                'operation_value' => $operationvalue,
                'latest_value' => $latestvalue,
            ]);
            $this->dispatchBrowserEvent('SuccessAlert', [
                'name' => $this->productname.' stock was successfully edited!',
                'title' => 'Product Inventory Edited',
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
        $this->inventoryedit = null;
        $this->productname = null;
    }

    public function closeModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('CloseModal');
    }

    public function render()
    {
        return view('livewire.admin.inventory.inventory-edit-form');
    }
}
