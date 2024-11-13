<?php

namespace App\Http\Livewire\Admin\RoleAndPermission;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RolesTable extends Component
{
    use WithPagination;

    public $perPage = 10;

    public $search = null;

    protected $queryString = ['search' => ['except' => '']];

    protected $paginationTheme = 'bootstrap';

    public $action;

    public $selectedItem;

    protected $listeners = [
        'refreshParent' => '$refresh',
    ];

    public function render()
    {
        $roles = Role::whereNotIn('name', ['Super Admin'])->where('name', 'like', '%'.$this->search.'%')->paginate($this->perPage);

        return view('livewire.admin.role-and-permission.roles-table', compact('roles'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function selectItem($itemId, $action)
    {
        $this->selectedItem = $itemId;

        if ($action == 'delete') {
            $this->emit('getModelDeleteModalId', $this->selectedItem);
            $this->dispatchBrowserEvent('openDeleteModal');
        } elseif ($action == 'manage') {
        } else {
            $this->emit('getModelId', $this->selectedItem);
            $this->dispatchBrowserEvent('OpenModal');
        }
        $this->action = $action;
    }
}
