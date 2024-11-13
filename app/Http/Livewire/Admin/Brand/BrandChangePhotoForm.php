<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class BrandChangePhotoForm extends Component
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
        $brand = Brand::findorFail($this->modelId);
        $this->name = $brand->name;
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

    public function ChangeBrandPhoto()
    {
        if (! Storage::disk('public')->exists('brand')) {
            Storage::disk('public')->makeDirectory('brand', 0775, true);
        }
        $this->validate();

        abort_if(Gate::denies('brand_edit'), 403);
        $model = Brand::find($this->modelId);
        Storage::delete('public/brand/'.$model->photo);
        $this->photo->store('public/brand');
        $model->photo = $this->photo->hashName();
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
        return view('livewire.admin.brand.brand-change-photo-form');
    }
}
