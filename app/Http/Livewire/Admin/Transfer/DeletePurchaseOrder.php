<?php

namespace App\Http\Livewire\Admin\Transfer;

use Alert;
use App\Models\PurchaseOrder;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class DeletePurchaseOrder extends Component
{
    public $model_id;

    protected $listeners = ['PurchaseOrderID'];

    public function PurchaseOrderID($purchaseorderid)
    {
        $this->model_id = $purchaseorderid;
        $this->dispatchBrowserEvent('showDeleteModal');
    }

    private function cleanVars()
    {
        $this->model_id = null;
    }

    public function forceCloseModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
    }

    public function closeModal()
    {
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
    }

    public function delete()
    {
        abort_if(Gate::denies('inventory_transfer_delete'), 403);
        $purchase_order = PurchaseOrder::findorfail($this->model_id);
        $purchase_order->delete();
        $this->cleanVars();
        Alert::success('Purchase Order was Deleted', '');

        return redirect()->route('transfer.index');
    }

    public function render()
    {
        return view('livewire.admin.transfer.delete-purchase-order');
    }
}
