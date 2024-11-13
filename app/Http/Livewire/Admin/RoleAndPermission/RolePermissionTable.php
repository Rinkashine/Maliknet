<?php

namespace App\Http\Livewire\Admin\RoleAndPermission;

use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class RolePermissionTable extends Component
{
    public $role;

    protected $listeners = [
        'refreshParent' => '$refresh',
    ];

    public $action;

    public $selectedId;

    public $permissionId;

    public function selectItem($role, $permission, $action)
    {
        $this->selectedId = $role;
        $this->permissionId = $permission;
        if ($action == 'revoke') {
            $this->emit('getRevokeModelId', $this->selectedId, $this->permissionId);
            $this->dispatchBrowserEvent('openRevokeModal');
        }
        $this->action = $action;
    }

    public function mount($role)
    {
        $this->role = $role;
    }

    public function render()
    {
        abort_if(Gate::denies('role_edit'), 403);

        return view('livewire.admin.role-and-permission.role-permission-table');
    }
}
