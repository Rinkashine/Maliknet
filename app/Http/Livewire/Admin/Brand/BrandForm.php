<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class BrandForm extends Component
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
        'name' => 'brand name',
        'photo' => 'brand image',
    ];

    protected function rules()
    {
        return [
            'name' => ['required', Rule::unique('brand')->ignore($this->modelId)],
            'photo' => 'required|image',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|unique:brand,name,'.$this->modelId.'',
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

    public function StoreBrandData()
    {
        if (! Storage::disk('public')->exists('brand')) {
            Storage::disk('public')->makeDirectory('brand', 0775, true);
        }

        $model = Brand::find($this->modelId);
        abort_if(Gate::denies('brand_create'), 403);
        $this->validate();
        if (! empty($this->photo)) {
            $this->photo->store('public/brand');
        }
        $data = [
            'name' => $this->name,
            'photo' => $this->photo->hashName(),
        ];
        Brand::create($data);
        $this->dispatchBrowserEvent('SuccessAlert', [
            'name' => $this->name.' was successfully saved!',
            'title' => 'Record Saved',
        ]);

        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseAddItemModal');
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
        return view('livewire.admin.brand.brand-form');
    }
}
