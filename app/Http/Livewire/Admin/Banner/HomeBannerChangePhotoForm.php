<?php

namespace App\Http\Livewire\Admin\Banner;

use Livewire\Component;
use App\Models\Home;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class HomeBannerChangePhotoForm extends Component
{
    use WithFileUploads;

    public $modelId,$name,$photo;

    protected $listeners = [
        'getModelInfo',
        'refreshChild' => '$refresh',
        'forceCloseInfoModal',
    ];

    protected function rules()
    {
        return [
            'photo' => 'required|image',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'photo' => 'required|image',
        ]);
    }

    public function forceClosePhotoModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
    }

    public function getModelInfo($modelId)
    {
        $this->modelId = $modelId;
        $banner = Home::findorFail($this->modelId);
        $this->name = $banner->name;
    }

    public function closeChangePhotoModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('closeChangePhotoModal');
    }

    private function cleanVars()
    {
        $this->modelId = null;
        $this->name = null;
        $this->oldname = null;
    }

    public function ChangeHomeBannerPhoto()
    {
        if (! Storage::disk('public')->exists('banner')) {
            Storage::disk('public')->makeDirectory('banner', 0775, true);
        }

        $this->validate();

        abort_if(Gate::denies('post_edit'), 403);
        $model = Home::find($this->modelId);
        Storage::delete('public/banner/'.$model->photo);
        $this->photo->store('public/banner');
        $model->featured_image = $this->photo->hashName();
        $model->update();

        $this->dispatchBrowserEvent('SuccessAlert', [
            'name' => $this->name.' was successfully saved!',
            'title' => 'Record Edited Successfully',
        ]);

        $this->cleanVars();
        $this->dispatchBrowserEvent('closeChangePhotoModal');
        $this->emit('refreshParent');
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.admin.banner.home-banner-change-photo-form');
    }
}
