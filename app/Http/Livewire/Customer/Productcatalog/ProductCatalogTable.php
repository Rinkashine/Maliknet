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

    public $perPage = 24;

    protected $queryString = [
        'search' => ['except' => ''],
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

    public function render()
    {
        $products = Product::where('status', 1)
        ->where('name', 'like', '%'.$this->search.'%')
        ->with('images', 'category')
        ->orderby('name', 'asc')
        ->paginate($this->perPage);

        return view('livewire.customer.productcatalog.product-catalog-table', [
            'products' => $products,

        ]);
    }
}
