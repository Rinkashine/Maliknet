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

    public $name,$category,$brand,$description,$sprice,$cprice,$sku,$weight,$status,$margin,$profit;

    public $weight_measurement = 'g';

    public $stock = 0;

    public $w_stock = 0;

    public $images = [];

    protected $listeners = [
        'refreshChild' => '$refresh',
    ];

    public function cleanVars()
    {
        $this->name = null;
        $this->category = null;
        $this->brand = null;
        $this->description = null;
        $this->sprice = null;
        $this->cprice = null;
        $this->sku = null;
        $this->weight = null;
        $this->weight_measurement = null;
        $this->status = null;
        $this->stock = null;
        $this->w_stock = null;
    }

    public function render()
    {
        if ($this->sprice == null) {
            $this->sprice = 0;
        }
        if ($this->cprice == null) {
            $this->cprice = 0;
        }

        if($this->sprice == 0 || $this->cprice == 0){
            $this->profit = 0;
        }else{
            $this->profit = $this->sprice - $this->cprice;
            if ($this->sprice != null) {
                $this->margin = ($this->profit / $this->sprice) * 100;
            }
        }


        $categories = Category::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();

        return view('livewire.admin.product.product-add-form', [
            'categories' => $categories,
            'brands' => $brands,
            'suppliers' => $suppliers,
        ]);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'category' => 'required',
            'brand' => 'required',
            'stock' => 'integer|min:0',
            'cprice' => 'required|numeric|min:1',
            'sprice' => 'numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'weight_measurement' => 'required',
            'description' => 'required',
            'sku' => 'required|unique:product,SKU',
            'status' => 'required',
            'images.*' => 'image',
        ]);
    }

    protected function rules()
    {
        return [
            'name' => 'required',
            'category' => 'required',
            'brand' => 'required',
            'stock' => 'integer|min:0',
            'cprice' => 'required|numeric|min:1',
            'sprice' => 'numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'weight_measurement' => 'required',
            'description' => 'required',
            'sku' => 'required|unique:product,SKU',
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
            'brand_id' => $this->brand,
            'stock' => $this->stock,
            'SKU' => $this->sku,
            'cprice' => $this->cprice,
            'sprice' => $this->sprice,
            'weight' => $this->weight,
            'weight_measurement' => $this->weight_measurement,
            'status' => $this->status,
            'stock_warning' => $this->w_stock,
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
