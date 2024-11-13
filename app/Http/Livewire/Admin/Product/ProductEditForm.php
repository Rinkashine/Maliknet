<?php

namespace App\Http\Livewire\Admin\Product;

use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Supplier;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductEditForm extends Component
{
    use WithFileUploads;

    public $action;

    public $selectedItem;

    public $oldname;

    public $iteration = 1;

    public $name;

    public $category;

    public $description;

    public $price;

    public $status;

    public $images = [];

    public $product;


    protected $listeners = [
        'refreshChild' => '$refresh',
        'refreshParent' => '$refresh',
    ];

    public function selectItem($itemId, $action)
    {
        $this->selectedItem = $itemId;

        if ($action == 'delete') {
            $this->emit('getModelDeleteModalId', $this->selectedItem);
            $this->dispatchBrowserEvent('openDeleteModal');
        }
        $this->action = $action;
    }

    public function mount($product)
    {
        if ($product) {
            $this->product = $product;
            $this->name = $this->product->name;
            $this->category = $this->product->category->id;
            $this->description = $this->product->description;
            $this->price = $this->product->price;
            $this->status = $this->product->status;
        }
    }

    public function StoreNewImages()
    {
        $validatedData = $this->validate([
            'images.*' => 'required|image',
        ]);

        if (! Storage::disk('public')->exists('product_photos')) {
            Storage::disk('public')->makeDirectory('product_photos', 0775, true);
        }

        foreach ($this->images as $image) {
            $image->store('public/product_photos');
            ProductImage::create([
                'product_id' => $this->product->id,
                'images' => $image->hashName(),
            ]);
        }
        if ($this->images != []) {
            $this->dispatchBrowserEvent('SuccessAlert', [
                'name' => 'Image was sucessfully added for '.$this->name,
                'title' => 'Successfully Added New Image',
            ]);
        }
        $this->emit('refreshParent');
        $this->resetErrorBag();
        $this->images = [];
        $this->iteration++;
    }

    public function Cancel()
    {
        return redirect()->route('product.index');
    }

    public function UpdateProductData()
    {
        $this->validate();
        $product = Product::find($this->product->id);
        $this->oldname = $product->name;
        $product->name = $this->name;
        $product->category_id = $this->category;
        $product->description = $this->description;
        $product->price = $this->price;
        $product->status = $this->status;

        $update = $product->update();
        if ($update) {
            $this->dispatchBrowserEvent('SuccessAlert', [
                'name' => 'Product was succesfully edited',
                'title' => 'Record Successfully Edit',
            ]);
        }
        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('Scrollup');
    }

    public function cleanVars()
    {
        $this->name = null;
        $this->category = null;
        $this->description = null;
        $this->price = null;
        $this->images = [];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric|min:1',
            'description' => 'required',
            'status' => 'required',
            'images.*' => 'image',
        ]);
    }

    protected function rules()
    {
        return  [
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric|min:1',
            'description' => 'required',
            'status' => 'required',
            'images.*' => 'image',

        ];
    }

    public function render()
    {
        if ($this->price == null) {
            $this->price = 0;
        }

        $categories = Category::orderBy('name')->get();
        $product_images = $this->product->images;

        return view('livewire.admin.product.product-edit-form', [
            'categories' => $categories,
            'product_images' => $product_images,
        ]);
    }
}
