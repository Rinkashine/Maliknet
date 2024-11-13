<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class CategoryChangePhotoForm extends Component
{
    use WithFileUploads;

    public $modelId;

    public $name;

    public $photo;

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
        $brand = Category::findorFail($this->modelId);
        $this->name = $brand->name;
    }

    public function closeChangePhotoModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('closeChangePhotoModal');
    }

    public function ChangeCategoryPhoto()
    {
        if (! Storage::disk('public')->exists('category')) {
            Storage::disk('public')->makeDirectory('category', 0775, true);
        }
        $this->validate();
        abort_if(Gate::denies('category_edit'), 403);
        $model = Category::find($this->modelId);
        Storage::delete('public/category/'.$model->photo);
        $this->photo->store('public/category');
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

    private function cleanVars()
    {
        $this->modelId = null;
        $this->name = null;
        $this->oldname = null;
    }

    public function render()
    {
        return view('livewire.admin.category.category-change-photo-form');
    }
}
