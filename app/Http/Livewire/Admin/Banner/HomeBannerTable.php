<?php

namespace App\Http\Livewire\Admin\Banner;

use App\Models\Home;
use Livewire\Component;
use Livewire\WithPagination;

class HomeBannerTable extends Component
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

    public function selectItem($itemId, $action)
    {
        $this->selectedItem = $itemId;

        if ($action == 'delete') {
            $this->emit('getModelDeleteModalId', $this->selectedItem);
            $this->dispatchBrowserEvent('openDeleteModal');
        } elseif ($action == 'edit') {
            $this->emit('getEditModalId', $this->selectedItem);
            $this->dispatchBrowserEvent('openEditModal');
        }elseif ($action == 'change_photo') {
            $this->emit('getModelInfo', $this->selectedItem);
            $this->dispatchBrowserEvent('openChangePhotoModal');
        }
        $this->action = $action;
    }

    public function render()
    {
        $banners = Home::search($this->search)->paginate($this->perPage);

        return view('livewire.admin.banner.home-banner-table', [
            'banners' => $banners,
        ]);
    }
}
