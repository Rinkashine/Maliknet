<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;

class RestrictUserAccount extends Component
{
    public $modelId;

    protected $listeners = [
        'getRestrictModalId',
        'refreshChild' => '$refresh',
        'forceCloseModal',
    ];

    public function forceCloseModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
    }

    private function cleanVars()
    {
        $this->modelId = null;
    }

    public function getRestrictModalId($modelId)
    {
        $this->modelId = $modelId;
    }

    public function closeModal()
    {
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
    }

    public function restrict()
    {
        $user = User::find($this->modelId);
        $user->delete();
        $this->dispatchBrowserEvent('SuccessAlert', [
            'name' => $user->name.' was successfully restricted!',
            'title' => 'Customer Account was  Restricted',
        ]);
        $this->emit('refreshParent');
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
    }

    public function render()
    {
        return view('livewire.admin.user.restrict-user-account');
    }
}
