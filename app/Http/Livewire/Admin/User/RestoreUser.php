<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class RestoreUser extends Component
{
    public $modelId;

    protected $listeners = [
        'getModelRestoreId',
        'forceCloseModal',
        'refreshChild' => '$refresh',
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

    public function closeModal()
    {
        $this->cleanVars();
        $this->dispatchBrowserEvent('closeRestoreModal');
    }

    public function getModelRestoreId($modelId)
    {
        $this->modelId = $modelId;
    }

    public function restore()
    {
        abort_if(Gate::denies('user_restore'), 403);
        $user = User::onlyTrashed()->find($this->modelId);
        $user->restore();
        $this->dispatchBrowserEvent('SuccessAlert', [
            'name' => $user->name.' was successfully restored!',
            'title' => 'Record Restore',
        ]);

        $this->emit('refreshParent');
        $this->cleanVars();
        $this->dispatchBrowserEvent('closeRestoreModal');
    }

    public function render()
    {
        return view('livewire.admin.user.restore-user');
    }
}
