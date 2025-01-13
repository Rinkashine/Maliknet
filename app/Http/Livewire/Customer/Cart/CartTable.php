<?php

namespace App\Http\Livewire\Customer\Cart;

use App\Models\CustomerCart;
use App\Models\CustomerShippingAddress;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartTable extends Component
{
    public $subtotal = 0;

    public $val;

    public $total = 0;

    public $action;

    public $selectedItem;

    public function ProceedToCheckout()
    {
        $customer_id = Auth::guard('customer')->user()->id;
        $cart_count = CustomerCart::with('product', 'customer')
        ->where('customers_id', $customer_id)
        ->where('check', 1)
        ->get();

        if (count($cart_count) == 0) {
            return;
        } else {
            return redirect()->route('checkout.index');
        }
    }

    protected $listeners = [
        'refreshParent' => '$refresh',
    ];

    public function selectItem($itemId, $action)
    {
        $this->selectItem = $itemId;

        if ($action == 'remove') {
            $this->emit('getModelDeleteModalId', $this->selectItem);
            $this->dispatchBrowserEvent('openRemoveModal');
        } elseif ($action == 'adjust') {
            $this->emit('getModelAdjustModalId', $this->selectItem);
            $this->dispatchBrowserEvent('openAdjustModal');
        } else {
        }
        $this->action = $action;
    }

    public function add($id)
    {
        $customer_id = Auth::guard('customer')->user()->id;
        $itemsincart = CustomerCart::with('product')->where('id', $id)->where('customers_id', $customer_id)->get();
        foreach ($itemsincart as $item) {
            if ($item->check == 1) {
                $item->check = 0;
                $item->update();
            } else {
                $item->check = 1;
                $item->update();
            }
        }
    }



    public function render()
    {
        if (Auth::guard('customer')->check()) {
            $customer_id = Auth::id();
            $cart = CustomerCart::with('product', 'customer')->where('customers_id', $customer_id)->get();
        } else {
            return redirect()->route('CLogin.index');
        }

        $this->total = 0;
        $this->subtotal = 0;

        $checkitem = CustomerCart::with('product', 'customer')
            ->where('customers_id', $customer_id)
            ->where('check', 1)
            ->get();

        foreach ($checkitem as $checkitem) {
            $qty = $checkitem->quantity;
            $price = $checkitem->product->price;
            $totalprice = $qty * $price;
            $this->val += $totalprice;
        }

        $this->subtotal += $this->val;
        $this->val = 0;

        if ($this->subtotal != 0) {
            $this->total = $this->subtotal ;
        }

        $customer_id = Auth::guard('customer')->user()->id;
        $shippingaddresscount = CustomerShippingAddress::where('customers_id', $customer_id)->count();

        return view('livewire.customer.cart.cart-table', [
            'cart' => $cart,
            'shippingaddresscount' => $shippingaddresscount,
        ]);
    }
}
