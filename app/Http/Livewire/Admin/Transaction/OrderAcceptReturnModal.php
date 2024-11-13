<?php

namespace App\Http\Livewire\Admin\Transaction;

use Livewire\Component;
use Alert;
use App\Models\CustomerOrder;

class OrderAcceptReturnModal extends Component
{
    public $modelId;

    protected $listeners = [
        'getReturnOrderId',
        'refreshChild' => '$refresh',
        'forceCloseModal',
    ];

    public function getReturnOrderId($modelId)
    {
        $this->modelId = $modelId;
    }

    private function cleanVars()
    {
        $this->modelId = null;
    }

    public function closeModal()
    {
        $this->cleanVars();
        $this->dispatchBrowserEvent('closeApprovedReturn');
    }

    public function forceCloseModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
    }

    public function UpdateOrderStatus()
    {
        $order = CustomerOrder::findorfail($this->modelId);
        $order->status = 'Refunded';
        $order->update();

        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeApprovedReturn');

        $this->cleanVars();
        $this->resetErrorBag();
    }


    public function render()
    {
        return view('livewire.admin.transaction.order-accept-return-modal');
    }
}
