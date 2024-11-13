<?php

namespace App\Http\Livewire\Customer\Cart;

use App\Models\CustomerCart;
use Livewire\Component;

class RemoveProductCart extends Component
{
    public $modelId;

    protected $listeners = [
        'getModelDeleteModalId',
        'refreshChild' => '$refresh',
        'forceCloseModal',
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
        $cart = CustomerCart::find($this->modelId);
        $cart->delete();
        $this->emit('refreshParent');
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
        $this->emit('refreshcarticon');
    }

    public function render()
    {
        return view('livewire.customer.cart.remove-product-cart');
    }
}
