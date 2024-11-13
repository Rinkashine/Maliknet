<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryTable extends Component
{
    use WithPagination;

    public $perPage = 12;

    public $search = null;

    protected $queryString = ['search' => ['except' => '']];

    protected $paginationTheme = 'bootstrap';

    public $action;

    public $selectedItem;

    public function render()
    {
        return view('livewire.admin.category.category-table', [
            'category' => Category::search($this->search)
            ->orderBy('name')
            ->paginate($this->perPage),
        ]);
    }

    protected $listeners = [
        'refreshParent' => '$refresh',
    ];

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
        } elseif ($action == 'change_photo') {
            $this->emit('getModelInfo', $this->selectedItem);
            $this->dispatchBrowserEvent('openChangePhotoModal');
        } else {
            $this->emit('getModelId', $this->selectedItem);
            $this->dispatchBrowserEvent('OpenEditModal');
        }
        $this->action = $action;
    }
}
