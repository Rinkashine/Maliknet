<?php

namespace App\Http\Livewire\Admin\Banner;

use App\Models\Home;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DeleteBanner extends Component
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
        abort_if(Gate::denies('post_delete'), 403);
        $home = Home::find($this->modelId);
        Storage::delete('public/banner/'.$home->featured_image);
        $home->delete();
        $this->dispatchBrowserEvent('SuccessAlert', [
            'name' => $home->name.' was successfully deleted!',
            'title' => 'Home Banner Deleted',
        ]);

        $this->emit('refreshParent');
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
    }

    public function render()
    {
        return view('livewire.admin.banner.delete-banner');
    }
}
