<?php

namespace App\Http\Livewire\Admin\RoleAndPermission;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class DeleteRole extends Component
{
    public $modelId;

    protected $listeners = [
        'getModelDeleteModalId',
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
        $role = Role::find($this->modelId);
        $users = User::all();
        $count = 0;
        foreach ($users as $user) {
            $result = $user->hasExactRoles($role->name);
            if ($result) {
                $count++;
            }
        }
        if ($count == 0) {
            $role->delete();
            $this->dispatchBrowserEvent('SuccessAlert', [
                'name' => $role->name.' was successfully deleted!',
                'title' => 'Record Deleted',
            ]);
        } else {
            $this->dispatchBrowserEvent('InvalidAlert', [
                'name' => $role->name.' has a user records!',
                'title' => 'Delete Failed!',
            ]);
        }

        $this->emit('refreshParent');
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
    }

    public function render()
    {
        return view('livewire.admin.role-and-permission.delete-role');
    }
}
