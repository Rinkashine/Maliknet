<?php

namespace App\Http\Livewire\Admin\Customer;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CustomerOrder;
use Illuminate\Support\Facades\DB;
use App\Models\CustomerShippingAddress;

class CustomerShow extends Component
{
    use WithPagination;

    public $sorting;

    public $perPage = 10;

    public $search = null;

    protected $queryString = ['search' => ['except' => '']];

    protected $paginationTheme = 'bootstrap';

    public $customer_id;

    public $name;

    public $email;

    public $phone;

    public $gender;

    public $birthday;

    public $photo;

    public function mount($customer)
    {
        if ($customer) {
            $this->customer_id = $customer->id;
            $this->name = $customer->name;
            $this->email = $customer->email;
            $this->phone = $customer->phone_number;
            $this->gender = $customer->gender;
            $this->birthday = $customer->birthday;
            $this->photo = $customer->photo;
            $this->created_at = $customer->created_at->toDayDateTimeString();
        }
    }

    public function render()
    {
        $listoforders = CustomerOrder::where('customers_id', $this->customer_id)
        ->where('id', 'like', '%'.$this->search.'%')
        ->orderby('created_at', 'desc')
        ->paginate($this->perPage);

        $totalSpent = CustomerOrder::join('customer_order_item', 'customer_order.id', 'customer_order_item.customer_order_id')
        ->select(DB::raw(value: 'SUM( customer_order_item.price * customer_order_item.quantity) AS total_spent'))
        ->where('customer_order.status', 'Completed')
        ->where('customer_order.customers_id', $this->customer_id)
        ->get()->sum('total_spent');

        $totalOrders = CustomerOrder::select('customers_id')
        // ->where('customer_order.status', 'Completed')
        ->where('customer_order.customers_id', $this->customer_id)
        ->get()->count();

        $totalRejectedOrders = CustomerOrder::select('customers_id')
        ->where('customer_order.status', 'Rejected')
        ->where('customer_order.customers_id', $this->customer_id)
        ->get()->count();

        $totalCancelledOrders = CustomerOrder::select('customers_id')
        ->where('customer_order.status', 'Cancelled')
        ->where('customer_order.customers_id', $this->customer_id)
        ->get()->count();

        $totalCompletedOrders = CustomerOrder::select('customers_id')
        ->where('customer_order.status', 'Completed')
        ->where('customer_order.customers_id', $this->customer_id)
        ->get()->count();

        $totalCancelledOrders = CustomerOrder::select('customers_id')
        ->where('customer_order.status', 'Cancelled')
        ->where('customer_order.customers_id', $this->customer_id)
        ->get()->count();
        // dd($totalOrders);

        $totalProducts = CustomerOrder::join('customer_order_item', 'customer_order.id', 'customer_order_item.customer_order_id')
        ->where('customer_order.status', 'Completed')
        ->where('customer_order.customers_id', $this->customer_id)
        ->get()->sum('quantity');
        // dd($totalProducts);

        $address = CustomerShippingAddress::where('customers_id', $this->customer_id)->orderBy('name')->get();

        return view('livewire.admin.customer.customer-show', [
            'listoforders' => $listoforders,
            'totalSpent' => $totalSpent,
            'totalOrders' => $totalOrders,
            'totalRejectedOrders' => $totalRejectedOrders,
            'totalCancelledOrders' => $totalCancelledOrders,
            'totalCompletedOrders' => $totalCompletedOrders,
            'totalProducts' => $totalProducts,
            'address' => $address
        ]);
    }
}
