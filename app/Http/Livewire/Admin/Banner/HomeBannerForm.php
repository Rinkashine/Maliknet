<?php

namespace App\Http\Livewire\Admin\Banner;

use App\Models\Home;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
class HomeBannerForm extends Component
{
    use WithFileUploads;

    public $title;

    public $status;

    public $picture;

    protected $listeners = [
        'refreshChild' => '$refresh',
        'forceCloseModal',
    ];

    protected function rules()
    {
        return [
            'title' => 'required|max:40',
            'status' => 'required|max:100',
            'picture' => 'required|image',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'title' => 'required|max:40',
            'status' => 'required|max:100',
            'picture' => 'required|image',
        ]);
    }

    private function cleanVars()
    {
        $this->title = null;
        $this->status = null;
        $this->picture = null;
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
        $this->dispatchBrowserEvent('CloseModal');
    }

    public function StoreBannerData()
    {

        if (! Storage::disk('public')->exists('banner')) {
            Storage::disk('public')->makeDirectory('banner', 0775, true);
        }

        abort_if(Gate::denies('post_create'), 403);
        $this->validate();
        if (! empty($this->picture)) {
            $this->picture->store('public/banner');
        }
        $data = [
            'title' => $this->title,
            'status' => $this->status,
            'featured_image' => $this->picture->hashName(),
        ];
        Home::create($data);
        $this->dispatchBrowserEvent('SuccessAlert', [
            'name' => $this->title.' was successfully saved!',
            'title' => 'Record Saved',
        ]);

        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseModal');
        $this->emit('refreshParent');
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.admin.banner.home-banner-form');
    }
}
