<?php

namespace App\Http\Livewire\Admin\Transaction;

use Livewire\Component;
use App\Models\CustomerOrder;

class OrderCompletedModal extends Component
{
    public $model_id;

    protected $listeners = ['SetStatusToCompleted'];

    public function SetStatusToCompleted($orderid)
    {
        $this->model_id = $orderid;
    }

    public function cleanVars(){
        $this->orderdetails = null;
    }

    public function UpdateOrderStatus(){
        $customer = CustomerOrder::findorfail($this->model_id);
        $customer->status = "Completed";
        $customer->update();
        $this->dispatchBrowserEvent('HideCompletedModal');
        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('SuccessAlert', [
            'name' => 'Order status was set Completed',
            'title' => 'Status Updated Successfully',
        ]);

        $this->cleanVars();
        $this->resetErrorBag();
    }

    public function closeModal(){
        $this->cleanVars();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('HideCompletedModal');
    }

    public function render()
    {
        return view('livewire.admin.transaction.order-completed-modal');
    }
}
