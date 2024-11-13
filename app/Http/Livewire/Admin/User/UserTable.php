<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserTable extends Component
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

        if ($action == 'restrict') {
            $this->emit('getRestrictModalId', $this->selectedItem);
            $this->dispatchBrowserEvent('openRestrictModal');
        }
        $this->action = $action;
    }

    public function render()
    {
        $users = User::search($this->search)
        ->whereNotIn('id', ['1'])
        ->paginate($this->perPage);

        return view('livewire.admin.user.user-table', [
            'users' => $users,
        ]);
    }
}
