<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class CategoryForm extends Component
{
    use WithFileUploads;

    public $name;

    public $modelId;

    public $oldname;

    public $photo;

    protected $listeners = [
        'refreshChild' => '$refresh',
        'forceCloseModal',
    ];

    protected $validationAttributes = [
        'name' => 'category name',
        'photo' => 'category image',
    ];

    protected function rules()
    {
        return [
            'name' => ['required', Rule::unique('category')->ignore($this->modelId)],
            'photo' => 'required|image',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|unique:category,name,'.$this->modelId.'',
            'photo' => 'required|image',
        ]);
    }

    public function forceCloseModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
    }

    public function closeModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('CloseAddItemModal');
    }

    private function cleanVars()
    {
        $this->modelId = null;
        $this->name = null;
        $this->oldname = null;
    }

    public function StoreCategoryData()
    {
        if (! Storage::disk('public')->exists('category')) {
            Storage::disk('public')->makeDirectory('category', 0775, true);
        }
        $model = Category::find($this->modelId);
        abort_if(Gate::denies('category_create'), 403);
        $this->validate();
        if (! empty($this->photo)) {
            $this->photo->store('public/category');
        }
        $data = [
            'name' => $this->name,
            'photo' => $this->photo->hashName(),
        ];
        Category::create($data);
        $this->dispatchBrowserEvent('SuccessAlert', [
            'name' => $this->name.' was successfully saved!',
            'title' => 'Record Saved',
        ]);

        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseAddItemModal');
        $this->emit('refreshParent');
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.admin.category.category-form');
    }

}
