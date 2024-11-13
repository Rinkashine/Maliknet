<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ForceDeleteUser extends Component
{
    public $modelId;

    protected $listeners = [
        'getModelDeleteModalId',
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

    public function getModelDeleteModalId($modelId)
    {
        $this->modelId = $modelId;
    }

    public function closeModal()
    {
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
    }

    public function delete()
    {
        abort_if(Gate::denies('user_forcedelete'), 403);
        $user = User::onlyTrashed()->find($this->modelId);

        Storage::delete('public/employee_profile_picture/'.$user->photo);
        $user->forcedelete();
        $this->dispatchBrowserEvent('SuccessAlert', [
            'name' => $user->name.' was successfully deleted!',
            'title' => 'Record Deleted',
        ]);

        $this->emit('refreshParent');
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
    }

    public function render()
    {
        return view('livewire.admin.user.force-delete-user');
    }
}
