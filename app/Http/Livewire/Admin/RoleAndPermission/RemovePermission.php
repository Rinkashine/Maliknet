<?php

namespace App\Http\Livewire\Admin\RoleAndPermission;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RemovePermission extends Component
{
    public $role;

    public $permission;

    protected $listeners = [
        'getRevokeModelId',
        'refreshChild' => '$refresh',
        'forceCloseModal',
    ];

    public function getRevokeModelId($roleid, $permissionid)
    {
        $this->role = Role::find($roleid);
        $this->permission = Permission::find($permissionid);
    }

    private function cleanVars()
    {
        $this->modelId = null;
    }

    public function forceCloseModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
    }

    public function closeModal()
    {
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseRevokeModal');
    }

    public function revoke()
    {
        if ($this->role->hasPermissionTo($this->permission)) {
            $this->role->revokePermissionTo($this->permission);
            $this->dispatchBrowserEvent('SuccessAlert', [
                'name' => 'Permission was successfully revoked',
                'title' => 'Success Action',
            ]);
        } else {
            $this->dispatchBrowserEvent('InvalidAlert', [
                'name' => 'Permission does not exists',
                'title' => 'Invalid Action',
            ]);
        }
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseRevokeModal');
        $this->emit('refreshParent');
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.admin.role-and-permission.remove-permission');
    }
}
