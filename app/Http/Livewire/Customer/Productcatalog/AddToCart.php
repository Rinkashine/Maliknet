<?php

namespace App\Http\Livewire\Customer\Productcatalog;

use App\Models\CustomerCart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddToCart extends Component
{
    public $quantity = 1;

    public $product_id;

    public $price;

    protected function rules()
    {
        return[
            'quantity' => 'required|numeric|min:1',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'quantity' => 'required|numeric|min:1',
        ]);
    }

    public function StoreProductCart()
    {
        $this->validate();
        $customer_id = Auth::guard('customer')->user()->id;

        $productAlreadyOnCart = CustomerCart::where('product_id', $this->product_id)
            ->where('customers_id', $customer_id)
            ->exists();

        if ($productAlreadyOnCart) {
            CustomerCart::where('product_id', $this->product_id)
            ->where('customers_id', $customer_id)
            ->increment('quantity', $this->quantity);
        } else {
            $product = CustomerCart::create([
                'customers_id' => $customer_id,
                'product_id' => $this->product_id,
                'quantity' => $this->quantity,
                'check' => 1,
            ]);
        }
        $this->emit('refreshcarticon');

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Successfully Added To Cart',
        ]);
    }

    public function DecrementQuantity()
    {
        $this->quantity--;
    }

    public function IncrementQuantity()
    {
        $this->quantity++;
    }

    public function mount($product)
    {
        $this->price = $product->price;
        $this->product_id = $product->id;
    }

    public function LoginModal(){
        $this->dispatchBrowserEvent('openWarningModal');
    }

    public function render()
    {
        if ($this->quantity == null || $this->quantity <= 0) {
            $this->quantity = 1;
        }

        return view('livewire.customer.productcatalog.add-to-cart');
    }
}
