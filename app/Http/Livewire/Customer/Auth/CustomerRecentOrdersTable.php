<?php

namespace App\Http\Livewire\Customer\Auth;

use App\Models\CustomerOrder;
use App\Models\CustomerOrderItems;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CustomerRecentOrdersTable extends Component
{
    public function render()
    {
        $customer_id = Auth::guard('customer')->user()->id;
        $Orders = CustomerOrder::with('customers')->where('customers_id', $customer_id)->orderBy('created_at', 'desc')->take(5)->get();
        $ProductsOrdered = CustomerOrderItems::with('customer_orders')->get();

        return view('livewire.customer.auth.customer-recent-orders-table', [
            'Orders' => $Orders,
            'ProductsOrdered' => $ProductsOrdered,
        ]);
    }
}
