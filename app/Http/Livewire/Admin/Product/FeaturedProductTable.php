<?php

namespace App\Http\Livewire\Admin\Product;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;

class FeaturedProductTable extends Component
{
    use WithPagination;

    public $sorting;

    public $perPage = 10;

    public $search = null;

    protected $queryString = ['search' => ['except' => '']];

    protected $paginationTheme = 'bootstrap';

    public $action;
    public $selectedItem;
    public $column_name;
    public $order_name;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected $listeners = [
        'refreshParent' => '$refresh',
    ];

    public function mount()
    {
        $this->sorting = 'nameaz';
        $this->perPage = 10;
    }

    public function RemoveToFeatured($productId){
        $product = Product::findorfail($productId);
        $product->featured = "0";
        $product->update();
        $this->emit('refreshParent');
    }
    public function AddFeaturedProduct(){
        $this->dispatchBrowserEvent('OpenAddFeaturedModal');
    }
    public function render()
    {
        if($this->sorting == 'nameaz'){
            $this->column_name = 'name';
            $this->order_name = 'asc';
        }elseif($this->sorting == 'nameza'){
            $this->column_name = 'name';
            $this->order_name = 'desc';
        }elseif($this->sorting == 'createdold'){
            $this->column_name = 'created_at';
            $this->order_name = 'asc';
        }elseif($this->sorting == 'creatednew'){
            $this->column_name = 'created_at';
            $this->order_name = 'desc';
        }elseif($this->sorting == 'updatedatold'){
            $this->column_name = 'updated_at';
            $this->order_name = 'asc';
        }elseif($this->sorting == 'updatedatnew'){
            $this->column_name = 'updated_at';
            $this->order_name = 'desc';
        }elseif($this->sorting == 'lowinventory'){
            $this->column_name = 'stock';
            $this->order_name = 'asc';
        }elseif($this->sorting == 'highinventory'){
            $this->column_name = 'stock';
            $this->order_name = 'desc';
        }elseif($this->sorting == 'catza'){
            $this->column_name = 'category_id';
            $this->order_name = 'asc';
        }elseif($this->sorting == 'cataz'){
            $this->column_name = 'category_id';
            $this->order_name = 'desc';
        }else{
            $this->column_name = 'name';
            $this->order_name = 'asc';
        }

        $products = Product::with('category', 'brand', 'images')
        ->where('name', 'like', '%'.$this->search.'%')
        ->where('featured',1)
        ->orderBy($this->column_name, $this->order_name)
        ->paginate($this->perPage);
        return view('livewire.admin.product.featured-product-table',[
            'products' => $products
        ]);
    }
}
