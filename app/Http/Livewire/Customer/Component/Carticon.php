<?php

namespace App\Http\Livewire\Customer\Component;

use Livewire\Component;
use App\Models\CustomerCart;
use Illuminate\Support\Facades\Auth;
class Carticon extends Component
{
    protected $listeners = [
        'refreshcarticon' => '$refresh',
    ];

    public function render()
    {
        $customer_id = Auth::guard('customer')->user()->id;
        $cart_count = CustomerCart::where('customers_id',$customer_id)->get()->count();

        return view('livewire.customer.component.carticon',[
            'cart_count' => $cart_count
        ]);
    }
}
