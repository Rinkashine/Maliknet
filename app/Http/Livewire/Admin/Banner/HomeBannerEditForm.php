<?php

namespace App\Http\Livewire\Admin\Banner;

use App\Models\Home;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class HomeBannerEditForm extends Component
{
    public $title;

    public $status;

    public $modelId;

    protected $listeners = [
        'refreshChild' => '$refresh',
        'forceCloseEditModal',
        'getEditModalId',
    ];

    public function getEditModalId($modelId)
    {
        $this->modelId = $modelId;
        if ($this->modelId != null) {
            $content = Home::find($this->modelId);
            $this->title = $content->title;
            $this->status = $content->status;
        }
    }

    protected function rules()
    {
        return [
            'title' => 'required|max:40',
            'status' => 'required|max:100',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'title' => 'required|max:40',
            'status' => 'required|max:100',
        ]);
    }

    private function cleanVars()
    {
        $this->title = null;
        $this->status = null;
        $this->modelId = null;
    }

    public function forceCloseEditModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
    }

    public function closeModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('CloseEditModal');
    }

    public function UpdateBannerData()
    {
        abort_if(Gate::denies('post_edit'), 403);
        $this->validate();
        $home = Home::find($this->modelId);
        $home->title = $this->title;
        $home->status = $this->status;
        $home->update();

        $this->dispatchBrowserEvent('SuccessAlert', [
            'name' => 'Success edit operation',
            'title' => 'Home Banner was sucessfully edited',
        ]);
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseEditModal');
        $this->emit('refreshParent');
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.admin.banner.home-banner-edit-form');
    }
}
