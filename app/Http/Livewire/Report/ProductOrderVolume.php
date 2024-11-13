<?php

namespace App\Http\Livewire\Report;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class ProductOrderVolume extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;

    public $sorting = 'order_quantity_desc';
    public $column_name;
    public $order_name;

    public $search = null;
    protected $queryString = ['search' => ['except' => '']];

    public function render()
    {
        if($this->sorting == 'product_name_asc'){
            $this->column_name = "name";
            $this->order_name = "asc";
        }elseif($this->sorting == 'product_name_desc'){
            $this->column_name = "name";
            $this->order_name = 'desc';
        }elseif($this->sorting == 'order_quantity_asc'){
            $this->column_name = 'order_quantity';
            $this->order_name = "asc";
        }elseif($this->sorting == 'order_quantity_desc'){
            $this->column_name = 'order_quantity';
            $this->order_name = 'desc';
        }else{
            $this->column_name = "name";
            $this->order_name = "asc";
        }
        $products = Product::select([
            'product.id',
            'product.name',
            DB::raw(value: 'SUM(CASE WHEN customer_order.status = "Completed" then customer_order_item.quantity
            end) as order_quantity'),
        ])
        ->leftjoin('customer_order_item', 'product.name', '=', 'customer_order_item.product_name')
        ->leftjoin('customer_order', function($join){
            $join->on('customer_order_item.customer_order_id', '=', 'customer_order.id');
        })
        ->where('product.name','like','%'.$this->search.'%')
        ->groupBy('product.name','product.id' )
        ->orderBy($this->column_name, $this->order_name)
        ->paginate($this->perPage);
        return view('livewire.report.product-order-volume',[
            'products' => $products
    ]);
    }
}
