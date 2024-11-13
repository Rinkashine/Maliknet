<?php

namespace App\Http\Livewire\Admin\Transfer;

use Livewire\Component;
use App\Models\PurchaseOrder;

class EditPuchaseOrderRemarks extends Component
{
    public $purchase_order_id;
    public $remarks;
    protected $listeners = ['EditRemarks'];

    public function EditRemarks($id){
        $this->purchase_order_id = $id;
        $this->dispatchBrowserEvent('ShowEditModal');
    }
    private function cleanVars()
    {
        $this->purchase_order_id = null;
    }
    public function UpdateRemarksData(){
        $modal = PurchaseOrder::findorfail($this->purchase_order_id);
        $modal->remarks = $this->remarks;
        $modal->update();
        $this->cleanVars();
        return redirect()->route('transfer.show',$this->purchase_order_id);
    }
    public function closeEditModal()
    {
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseEditModal');
    }

    public function render()
    {
        return view('livewire.admin.transfer.edit-puchase-order-remarks');
    }
}
