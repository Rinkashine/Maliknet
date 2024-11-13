<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class BrandTable extends Component
{
    use WithPagination;

    public $perPage = 12;

    public $search = null;

    protected $queryString = ['search' => ['except' => '']];

    protected $paginationTheme = 'bootstrap';

    public $action;

    public $selectedItem;

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

    public function render()
    {
        abort_if(Gate::denies('brand_access'), 403);

        return view('livewire.admin.brand.brand-table', [
            'brands' => Brand::search($this->search)
            ->orderBy('name')
            ->paginate($this->perPage),
        ]);
    }
}
