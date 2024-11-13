<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductAddForm extends Component
{
    use WithFileUploads;

    public $name,$category,$description,$price,$status;


    public $images = [];

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
            'images.*' => 'image',
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
            'images.*' => 'image',
        ];
    }

    public function StoreProductData()
    {
        $this->validate();
        $product = Product::create([
            'name' => $this->name,
            'category_id' => $this->category,
            'price' => $this->price,
            'status' => $this->status,
            'description' => $this->description,
        ]);
        if ($product) {
            foreach ($this->images as $image) {
                $image->store('public/product_photos');
                ProductImage::create([
                    'product_id' => $product->id,
                    'images' => $image->hashName(),
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
