<?php

namespace App\Http\Livewire\Admin\Transaction;

use Livewire\Component;
use App\Models\CustomerOrder;
use App\Jobs\OrderIsOutForDeliveryJob;

class OrderOutForDeliveryModal extends Component
{
    public $model_id;

    protected $listeners = ['SetStatusToOutForDelivery'];

    public function SetStatusToOutForDelivery($orderid)
    {
        $this->model_id = $orderid;
    }

    public function cleanVars(){
        $this->orderdetails = null;
    }

    public function UpdateOrderStatus(){
        $customer = CustomerOrder::findorfail($this->model_id);
        $customer->status = "Out For Delivery";
        $customer->update();

        dispatch(new OrderIsOutForDeliveryJob($customer));

        $this->dispatchBrowserEvent('HideOutForDeliveryModal');
        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('SuccessAlert', [
            'name' => 'Order status was set to Out For Delivery',
            'title' => 'Status Updated Successfully',
        ]);

        $this->cleanVars();
        $this->resetErrorBag();
    }

    public function closeModal(){
        $this->cleanVars();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('HideOutForDeliveryModal');
    }

    public function render()
    {
        return view('livewire.admin.transaction.order-out-for-delivery-modal');
    }
}
