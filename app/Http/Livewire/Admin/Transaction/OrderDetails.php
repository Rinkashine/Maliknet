<?php

namespace App\Http\Livewire\Admin\Transaction;

use Livewire\Component;
use App\Models\Customer;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItems;
class OrderDetails extends Component
{
    public $model_id;

    protected $listeners = [
        'refreshParent' => '$refresh',
    ];

    public function mount($orderdetails){
        $this->model_id = $orderdetails->id;
    }

    public function selectItem($itemId, $action)
    {
        $this->selectedItem = $itemId;
        if($action == 'approve_order'){
            $this->emit('SetStatusToProcessing', $this->selectedItem);
            $this->dispatchBrowserEvent('ShowApprovedOrderModal');
        }elseif($action == 'reject_order') {
            $this->emit('getModelRejectId', $this->selectedItem);
            $this->dispatchBrowserEvent('openRejectOrderModal');
        }elseif($action == 'set_status_to_packed'){
            $this->emit('SetStatusToPacked', $this->selectedItem);
            $this->dispatchBrowserEvent('ShowSetOrderToPackedModal');
        }elseif($action == 'set_status_to_out_for_delivery'){
            $this->emit('SetStatusToOutForDelivery', $this->selectedItem);
            $this->dispatchBrowserEvent('ShowOutForDeliveryModal');
        }elseif($action == 'set_status_to_completed'){
            $this->emit('SetStatusToCompleted', $this->selectedItem);
            $this->dispatchBrowserEvent('ShowCompletedModal');
        }elseif($action == 'StoreOrderNotes'){
            $this->emit('getOrderIdModal', $this->selectedItem);
            $this->dispatchBrowserEvent('openOrderNotesModal');
        }elseif($action == 'reject_return'){
            $this->emit('getReturnOrderId', $this->selectedItem);
            $this->dispatchBrowserEvent('openRejectReturnModal');
        }elseif($action == 'accept_return'){
            $this->emit('getReturnOrderId', $this->selectedItem);
            $this->dispatchBrowserEvent('openAcceptReturnModal');
        }
        $this->action = $action;
    }

    public function render()
    {
        $orderdetails = CustomerOrder::findorfail($this->model_id);
        $customerinfo = Customer::withTrashed()->findorfail($orderdetails->customers_id);
        $products = CustomerOrderItems::where('customer_order_id', $orderdetails->id)->get();
        return view('livewire.admin.transaction.order-details',[
            'orderdetails' => $orderdetails,
            'products' => $products,
            'customerinfo' => $customerinfo,
        ]);
    }
}
