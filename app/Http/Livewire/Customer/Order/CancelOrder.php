<?php

namespace App\Http\Livewire\Customer\Order;

use Livewire\Component;

class CancelOrder extends Component
{
    public $status;

    public $order_id;

    public $action;

    public $selectedItem;

    public function mount($orderdetails)
    {
        $this->status = $orderdetails->status;
        $this->order_id = $orderdetails->id;
    }

    public function selectItem($itemId, $action)
    {
        $this->selectedItem = $itemId;
        if ($action == 'cancel_order') {
            $this->emit('getOrderDetailsId', $this->selectedItem);
            $this->dispatchBrowserEvent('openCancelModal');
        }
        $this->action = $action;
    }

    public function render()
    {
        return view('livewire.customer.order.cancel-order');
    }
}
