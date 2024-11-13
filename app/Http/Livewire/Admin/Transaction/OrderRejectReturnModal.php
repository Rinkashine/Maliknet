<?php

namespace App\Http\Livewire\Admin\Transaction;

use Livewire\Component;
use Alert;
use App\Models\CustomerOrder;


class OrderRejectReturnModal extends Component
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
        $this->dispatchBrowserEvent('closeRejectReturnModal');
    }

    public function forceCloseModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
    }

    public function RejectReturn()
    {
        $order = CustomerOrder::findorfail($this->modelId);
        $order->status = 'Return Request Rejected';
        $order->update();

        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeRejectReturnModal');

        $this->cleanVars();
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.admin.transaction.order-reject-return-modal');
    }
}
