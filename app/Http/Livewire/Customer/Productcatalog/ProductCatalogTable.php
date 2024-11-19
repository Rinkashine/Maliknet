<?php

namespace App\Http\Livewire\Customer\Productcatalog;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductCatalogTable extends Component
{
    public function render()
    {
        $categories = Category::with(['categoryTransactions' => function ($query) {
            $query->where('status', 1)->with('images')->orderBy('name', 'asc');
        }])->get();


        return view('livewire.customer.productcatalog.product-catalog-table', [
            'categories' => $categories,
        ]);

    }
}
