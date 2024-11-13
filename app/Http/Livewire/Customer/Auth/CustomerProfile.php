<?php

namespace App\Http\Livewire\Customer\Auth;

use Livewire\Component;

class CustomerProfile extends Component
{
    protected $listeners = [
        'refreshParent' => '$refresh',
    ];

    public $action;

    public $selectedItem;

    public function selectItem($itemId, $action)
    {
        $this->selectedItem = $itemId;

        if ($action == 'edit') {
            $this->emit('getModelId', $this->selectedItem);
            $this->dispatchBrowserEvent('openEditInformationModal');
        }elseif($action == 'SetPassword'){
            $this->emit('getCustomerId',$this->selectedItem);
            $this->dispatchBrowserEvent('openSetPasswordModal');
        }

        $this->action = $action;
    }

    public function render()
    {
        return view('livewire.customer.auth.customer-profile');
    }
}
