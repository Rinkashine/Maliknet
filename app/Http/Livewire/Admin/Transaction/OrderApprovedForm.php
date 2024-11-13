<?php

namespace App\Http\Livewire\Admin\Transaction;

use Alert;
use App\Models\CustomerOrder;
use Livewire\Component;
use App\Jobs\OrderApprovedJob;
class OrderApprovedForm extends Component
{
    public $modelId;

    protected $listeners = [
        'SetStatusToProcessing',
        'forceCloseModal',
        'refreshChild' => '$refresh',
    ];

    public function SetStatusToProcessing($orderid)
    {
        $this->modelId = $orderid;
    }

    private function cleanVars()
    {
        $this->modelId = null;
    }

    public function forceCloseModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
    }

    public function closeModal()
    {
        $this->cleanVars();
        $this->dispatchBrowserEvent('closeApprovedModal');
    }

    public function approve()
    {
        $approveorder = CustomerOrder::findorfail($this->modelId);

        $approveorder->status = 'Processing';
        $approveorder->update();
        Alert::success('Order Approved Successfully', '');

        dispatch(new OrderApprovedJob($approveorder));

        $this->dispatchBrowserEvent('closeApprovedModal');
        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('SuccessAlert', [
            'name' => 'Order status was set to Processing',
            'title' => 'Status Updated Successfully',
        ]);

        $this->cleanVars();
        $this->resetErrorBag();
        $this->emit('refreshWaybill');
    }

    public function render()
    {
        return view('livewire.admin.transaction.order-approved-form');
    }
}
