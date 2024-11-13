<?php

namespace App\Http\Livewire\Customer\Cart;

use App\Models\CustomerCart;
use Livewire\Component;

class AdjustProductCart extends Component
{
    public $modelId;

    public $product_name;

    public $stocksleft;

    public $quantity;

    public $unitprice;

    public $totalprice;

    protected $listeners = [
        'getModelAdjustModalId',
        'refreshChild' => '$refresh',
        'forceCloseModal',
    ];

    public function closeModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('CloseAdjustModal');
    }

    public function forceCloseModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
    }

    public function getModelAdjustModalId($modelId)
    {
        $this->modelId = $modelId;
        $cart = CustomerCart::findorfail($this->modelId);
        $this->quantity = $cart->quantity;
        $this->unitprice = $cart->product->sprice;
        $this->product_name = $cart->product->name;
        $this->stocksleft = $cart->product->stock;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'quantity' => 'required|numeric|min:1|max:'.$this->stocksleft,
        ]);
    }

    protected function rules()
    {
        return [
            'quantity' => 'required|numeric|min:1|max:'.$this->stocksleft,
        ];
    }

    public function UpdateProductQuantity()
    {
        $this->validate();
        $customercart = CustomerCart::find($this->modelId);
        $customercart->quantity = $this->quantity;
        $customercart->update();
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseAdjustModal');
        $this->emit('refreshParent');
        $this->resetErrorBag();
    }

    private function cleanVars()
    {
        $this->modelId = null;
        $this->quantity = null;
        $this->product_name = null;
        $this->stocksleft = null;
        $this->unitprice = null;
        $this->totalprice = null;
    }

    public function render()
    {
        if ($this->quantity != null) {
            $this->totalprice = $this->quantity * $this->unitprice;
        } else {
            $this->totalprice = 0;
        }
        if ($this->quantity <= 0) {
            $this->quantity = 1;
            $this->totalprice = $this->quantity * $this->unitprice;
        }

        return view('livewire.customer.cart.adjust-product-cart');
    }
}
