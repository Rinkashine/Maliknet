<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserArchiveTable extends Component
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

    public function selectItem($itemId, $action)
    {
        $this->selectedItem = $itemId;
        if ($action == 'restore') {
            $this->emit('getModelRestoreId', $this->selectedItem);
            $this->dispatchBrowserEvent('OpenRestoreModal');
        } elseif ($action == 'delete') {
            $this->emit('getModelDeleteModalId', $this->selectedItem);
            $this->dispatchBrowserEvent('openDeleteModal');
        } else {
            $this->action = null;
        }
        $this->action = $action;
    }

    public function render()
    {
        $users = User::onlyTrashed()
        ->where('name', 'like', '%'.$this->search.'%')
        ->paginate($this->perPage);

        return view('livewire.admin.user.user-archive-table', [
            'users' => $users,
        ]);
    }
}
