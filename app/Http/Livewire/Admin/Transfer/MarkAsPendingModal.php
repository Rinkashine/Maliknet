<?php

namespace App\Http\Livewire\Admin\Transfer;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderTimeline;
use Livewire\Component;

class MarkAsPendingModal extends Component
{
    public $model_id;

    protected $listeners = [
        'forceCloseModal',
        'getInventoryTransferId',
    ];

    public function getInventoryTransferId($modelId)
    {
        $this->model_id = $modelId;
    }

    public function closeModal()
    {
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseMarkAsPendingModal');
    }

    public function forceCloseModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
    }

    public function cleanVars()
    {
        $this->model_id = null;
    }

    public function approve()
    {
        $model = PurchaseOrder::findorfail($this->model_id);
        $model->status = 'Pending';
        $model->update();

        PurchaseOrderTimeline::create([
            'purchase_order_id' => $this->model_id,
            'title' => 'Mark As Pending',
        ]);

        return redirect()->route('transfer.edit', $this->model_id);
    }

    public function render()
    {
        return view('livewire.admin.transfer.mark-as-pending-modal');
    }
}
