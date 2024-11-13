<?php

namespace App\Http\Livewire\Admin\Transfer;

use Livewire\Component;

class InventoryTransferMarkAsPending extends Component
{
    public $transfer_id;

    public function mount($info)
    {
        $this->transfer_id = $info->id;
    }

    public function selectItem($itemId, $action)
    {
        $this->selectedItem = $itemId;

        if ($action == 'MarkAsPending') {
            $this->emit('getInventoryTransferId', $this->selectedItem);
            $this->dispatchBrowserEvent('OpenMarkAsPendingModal');
        }
        $this->action = $action;
    }

    public function render()
    {
        return view('livewire.admin.transfer.inventory-transfer-mark-as-pending');
    }
}
