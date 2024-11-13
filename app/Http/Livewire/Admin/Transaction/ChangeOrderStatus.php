<?php

namespace App\Http\Livewire\Admin\Transaction;

use Livewire\Component;

class ChangeOrderStatus extends Component
{
    public $order_id;

    public $order;

    public $created_at;

    public $status;

    public $action;

    public $selectItem;

    protected $listeners = [
        'refreshParent' => '$refresh',
    ];

    public function mount($order)
    {
        $this->order = $order;
    }

    public function selectItem($itemId, $action)
    {
        $this->selectedItem = $itemId;

        if ($action == 'changeorderstatus') {
            $this->emit('getChangeOrderStatusId', $this->selectedItem);
            $this->dispatchBrowserEvent('openChangeOrderStatusModal');
        }
        $this->action = $action;
    }

    public function render()
    {
        $this->order_id = $this->order->id;
        $this->created_at = $this->order->created_at;
        $this->status = $this->order->status;

        return view('livewire.admin.transaction.change-order-status');
    }
}
