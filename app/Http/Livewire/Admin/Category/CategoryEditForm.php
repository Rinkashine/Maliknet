<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CategoryEditForm extends Component
{
    public $name;

    public $modelId;

    public $oldname;

    protected $listeners = [
        'getModelId',
        'refreshChild' => '$refresh',
        'forceCloseEditModal',
    ];

    protected function rules()
    {
        return [
            'name' => ['required', Rule::unique('category')->ignore($this->modelId)],
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|unique:category,name,'.$this->modelId.'',
        ]);
    }

    public function forceCloseEditModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
    }

    public function getModelId($modelId)
    {
        $this->modelId = $modelId;
        $category = Category::findorFail($this->modelId);
        $this->name = $category->name;
    }

    public function closeEditModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('closeEditModal');
    }

    public function UpdateCategoryData()
    {
        $model = Category::find($this->modelId);
        if ($this->modelId) {
            abort_if(Gate::denies('brand_edit'), 403);
            $this->validate();
            $this->oldname = $model->name;
            $model->name = $this->name;
            $model->update();

            $this->dispatchBrowserEvent('SuccessAlert', [
                'name' => $this->oldname.' was sucessfully changed to '.$this->name,
                'title' => 'Record Successfully Edit',
            ]);
        }
        $this->cleanVars();
        $this->dispatchBrowserEvent('closeEditModal');
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
        return view('livewire.admin.category.category-edit-form');
    }
}
