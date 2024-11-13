<?php

namespace App\Http\Livewire\Customer\Productcatalog;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductCatalogTable extends Component
{
    use WithPagination;

    public $search;

    public $filterbycategory;

    public $filterbybrand;

    public $perPage = 24;

    protected $queryString = [
        'search' => ['except' => ''],
        'filterbycategory' => ['except' => ''],
        'filterbybrand' => ['except' => ''],
    ];

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'refreshParent' => '$refresh',
        'load-more' => 'loadMore',
    ];

    public function load()
    {
        $this->perPage = $this->perPage + 24;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterbycategory()
    {
        $this->resetPage();
    }

    public function updatingFilterbybrand()
    {
        $this->resetPage();
    }

    public function render()
    {
        $categories = Category::orderby('name')->get();
        $brands = Brand::orderby('name')->get();

        if ($this->filterbybrand == null && $this->filterbycategory == null) {
            $products = Product::where('status', 1)
            ->where('name', 'like', '%'.$this->search.'%')
            ->with('images', 'category', 'brand')
            ->orderby('name', 'asc')
            ->paginate($this->perPage);
        } elseif ($this->filterbybrand != null && $this->filterbycategory != null) {
            $products = Product::where('status', 1)
            ->where('name', 'like', '%'.$this->search.'%')
            ->where('category_id', $this->filterbycategory)
            ->where('brand_id', '=', $this->filterbybrand)
            ->with('images', 'category', 'brand')
            ->orderby('name', 'asc')
            ->paginate($this->perPage);
        } elseif ($this->filterbybrand == null && $this->filterbycategory != null) {
            $products = Product::where('status', 1)
            ->where('name', 'like', '%'.$this->search.'%')
            ->where('category_id', $this->filterbycategory)
            //->where('brand_id', '=' , $this->filterbybrand)
            ->with('images', 'category', 'brand')
            ->orderby('name', 'asc')
            ->paginate($this->perPage);
        } elseif ($this->filterbybrand != null && $this->filterbycategory == null) {
            $products = Product::where('status', 1)
            ->where('name', 'like', '%'.$this->search.'%')
            //->where('category_id', $this->filterbycategory)
            ->where('brand_id', '=', $this->filterbybrand)
            ->with('images', 'category', 'brand')
            ->orderby('name', 'asc')
            ->paginate($this->perPage);
        } else {
            $products = Product::where('status', 1)
            ->where('name', 'like', '%'.$this->search.'%')
            ->where('category_id', $this->filterbycategory)
            ->where('brand_id', '=', $this->filterbybrand)
            ->with('images', 'category', 'brand')
            ->orderby('name', 'asc')
            ->paginate($this->perPage);
        }

        return view('livewire.customer.productcatalog.product-catalog-table', [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,

        ]);
    }
}
