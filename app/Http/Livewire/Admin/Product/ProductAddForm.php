<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductAddForm extends Component
{
    use WithFileUploads;

    public $name,$category,$description,$price,$status;


    public $galleries = [];

    protected $listeners = [
        'refreshChild' => '$refresh',
    ];

    public function cleanVars()
    {
        $this->name = null;
        $this->category = null;
        $this->description = null;
        $this->price = null;
        $this->status = null;
    }

    public function render()
    {
        if ($this->price == null) {
            $this->price = 0;
        }
        $categories = Category::orderBy('name')->get();

        return view('livewire.admin.product.product-add-form', [
            'categories' => $categories,
        ]);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric|min:1',
            'description' => 'required',
            'status' => 'required',
            'galleries.*' => 'mimes:jpeg,png,jpg,gif,mp4,mov,avi,wmv|max:10240', // Accepts images & videos up to 10MB
        ]);
    }

    protected function rules()
    {
        return [
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric|min:1',
            'description' => 'required',
            'status' => 'required',
            'galleries.*' => 'mimes:jpeg,png,jpg,gif,mp4,mov,avi,wmv|max:10240', // Accepts images & videos up to 10MB
        ];
    }

    public function StoreProductData()
    {
        $this->validate();
        // Save the product with the video path

        $product = Product::create([
            'name' => $this->name,
            'category_id' => $this->category,
            'price' => $this->price,
            'status' => $this->status,
            'description' => $this->description,
        ]);

        if ($product) {
            foreach ($this->galleries as $gallery) {
                $gallery->store('public/product_gallery');
                ProductGallery::create([
                    'product_id' => $product->id,
                    'file' => $gallery->hashName(),
                ]);
            }
        }

        return redirect()->route('product.edit', $product)->with('success', $this->name.' was successfully inserted');

        $this->cleanVars();
    }

    public function Cancel()
    {
        return redirect()->route('product.index');
    }
}
