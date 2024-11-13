<?php

namespace App\Http\Livewire\Admin\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserInfo extends Component
{
    public $action;

    public $selectedItem;
    public function render()
    {

        return view('livewire.admin.profile.user-info');
    }

    public function selectItem( $action)
    {
        if ($action == 'change_photo') {
            $this->dispatchBrowserEvent('openChangePhotoModal');
        } elseif ($action == 'edit_info') {
            $this->dispatchBrowserEvent('openEditInfoModal');
            $employee_id = Auth::guard('web')->user()->id;
            $this->emit('getModelInfo', $employee_id);
        }
        $this->action = $action;
    }
}
