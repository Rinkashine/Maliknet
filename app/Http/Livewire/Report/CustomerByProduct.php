<?php

namespace App\Http\Livewire\Report;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class CustomerByProduct extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;

    public $from ='2023-01-01T00:00';
    public $to ='2023-12-31T00:00';

    public $sorting = 'total_quantity_desc';
    public $column_name;
    public $order_name;
    
    public $search = null;
    protected $queryString = ['search' => ['except' => '']];

    public function mount($name, $id){
        $this->customer_name = $name;
        $this->customer_id = $id;
        // dd($this->customer_name);
    }
    public function render()
    {
         if($this->sorting == 'product_name_asc'){
            $this->column_name = "name";
            $this->order_name = "asc";
        }elseif($this->sorting == 'product_name_desc'){
            $this->column_name = "name";
            $this->order_name = 'desc';
        }elseif($this->sorting == 'total_quantity_asc'){
            $this->column_name = 'total_quantity';
            $this->order_name = "asc";
        }elseif($this->sorting == 'total_quantity_desc'){
            $this->column_name = 'total_quantity';
            $this->order_name = 'desc';
        }else{
            $this->column_name = "name";
            $this->order_name = "asc";
        }
        $products = Product::select([
            'product.name',
            
            DB::raw(value: 'SUM(CASE WHEN customer_order.status = "Completed" then customer_order_item.quantity end) AS total_quantity')
        ])
        ->leftjoin('customer_order_item','product.id','=','customer_order_item.product_id')
        ->leftjoin('customer_order',function($join){
            $join->on('customer_order_item.customer_order_id', '=', 'customer_order.id')
            ->where('customer_order.customers_id', '=', $this->customer_id);
            // ->where('customer_order.created_at', '>=', $this->from)
            // ->where('customer_order.created_at', '<=', $this->to);
        })
        // ->where('product.name','like','%'.$this->search.'%')
        ->groupBy('product.name')
        ->orderBy($this->column_name, $this->order_name)
        // ->get();
        // dd($products->toArray());
        ->paginate($this->perPage);
        return view('livewire.report.customer-by-product',[
            'products' => $products,
            'customer_name' => $this->customer_name,
            'customer_id' => $this->customer_id
        ]);
    }
}
