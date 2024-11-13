<?php

namespace App\Http\Livewire\Customer\Productcatalog;

use App\Models\Product;
use Livewire\Component;

class SearchProductForm extends Component
{
    public $query;

    public $products = [];

    public $hasfocus = false;

    public function handleFocus(){
        $this->hasfocus = true;
    }
    public function handleBlur(){
        $this->hasfocus = false;
    }
    public function mount()
    {
        $this->query = '';
        $this->products = [];
    }

    public function SearchProduct()
    {
        return redirect()->route('product', ['search' => $this->query]);
    }

    public function updatedQuery()
    {
        $this->products = Product::where('name', 'like', '%'.$this->query.'%')->orderby('name', 'asc')->take(10)
        ->get();
    }

    public function render()
    {
        return view('livewire.customer.productcatalog.search-product-form');
    }
}
