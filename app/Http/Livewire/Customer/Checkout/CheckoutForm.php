<?php

namespace App\Http\Livewire\Customer\Checkout;

use Alert;
use App\Models\CustomerCart;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItems;
use App\Models\CustomerShippingAddress;
use App\Models\InventoryHistory;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CheckoutForm extends Component
{
    public $updateAddress;

    public $address;

    public $action;

    public $selectedItem;

    public $customer_id;

    public $subtotal;

    public $shipping;

    public $total;

    public $orders;

    public $status;

    public $modeofpayment;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'NewAddress',
        'transactionEmit' => 'paidByPaypal',
    ];

    public function NewAddress($id)
    {
        $this->updateAddress = $id;
        $this->address = CustomerShippingAddress::where('id', $id)->get();
    }

    public function selectItem($itemId, $action)
    {
        $this->selectedItem = $itemId;

        if ($action == 'remove') {
            $this->emit('getModelDeleteModalId', $this->selectedItem);
            $this->dispatchBrowserEvent('openRemoveModal');
        } elseif ($action == 'editaddress') {
            $this->emit('getAddressId', $this->selectedItem);
            $this->dispatchBrowserEvent('openAddressModal');
        }
        $this->action = $action;
    }

    public function UpdatedAddress()
    {
        $this->address = CustomerShippingAddress::where('id', $this->updateAddress)->get();
    }

    public function StoreCustomerOrder()
    {
        $this->modeofpayment = 'Cash On Delivery';
        foreach ($this->address as $info) {
            $order_id = CustomerOrder::create([
                'customers_id' => $this->customer_id,
                'total' => $this->total,
                'mode_of_payment' => $this->modeofpayment,
                'status' => $this->status,
                'received_by' => $info->name,
                'phone_number' => $info->phone_number,
                'notes' => $info->notes,
                'house' => $info->house,
                'province' => $info->province,
                'city' => $info->city,
                'barangay' => $info->barangay,
            ]);

            foreach ($this->orders as $item) {
                CustomerOrderItems::create([
                    'customer_order_id' => $order_id->id,
                    'product_id' => $item->product->id,
                    'product_name' => $item->product->name,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                ]);


                $item->delete();
            }
        }

        Alert::success('Successfully Checkout');

        return redirect()->route('cart.index');
    }

    public function mount()
    {
        $this->customer_id = Auth::guard('customer')->user()->id;
        $this->status = 'Pending for Approval';
        $this->address = CustomerShippingAddress::where('default_address', 1)
        ->where('customers_id', $this->customer_id)->get();
        foreach ($this->address as $pickaddress) {
            $this->updateAddress = $pickaddress->id;
        }
    }

    public function render()
    {
        $this->orders = CustomerCart::with('product')->where('check', 1)
        ->where('customers_id', $this->customer_id)->get();

        $this->total = 0;
        $this->subtotal = 0;

        foreach ($this->orders as $checkoutorders) {
            $qty = $checkoutorders->quantity;
            $price = $checkoutorders->product->price;
            $totalprice = $qty * $price;
            $this->subtotal += $totalprice;
        }

        $this->total = $this->subtotal;

        return view('livewire.customer.checkout.checkout-form');
    }
}
