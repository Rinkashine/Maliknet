<?php

namespace App\Http\Livewire\Admin\Transaction;

use Livewire\Component;
use App\Models\CustomerOrder;
use App\Jobs\OrderIsPackedJob;
class SetStatusToPacked extends Component
{

    public $model_id;

    protected $listeners = ['SetStatusToPacked'];

    public function SetStatusToPacked($orderid)
    {
        $this->model_id = $orderid;
    }

    public function cleanVars(){
        $this->orderdetails = null;
    }

    public function UpdateOrderStatus(){
        $customer = CustomerOrder::findorfail($this->model_id);
        $customer->status = "Packed";
        $customer->update();
        $email = $customer->customers->email;
        dispatch(new OrderIsPackedJob($customer,$email));
        $this->dispatchBrowserEvent('HideSetOrderToPackedModal');
        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('SuccessAlert', [
            'name' => 'Order status was set to Packed',
            'title' => 'Status Updated Successfully',
        ]);

        $this->cleanVars();
        $this->resetErrorBag();
    }

    public function closeModal(){
        $this->cleanVars();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('HideSetOrderToPackedModal');
    }
    public function render()
    {
        return view('livewire.admin.transaction.set-status-to-packed');
    }
}
