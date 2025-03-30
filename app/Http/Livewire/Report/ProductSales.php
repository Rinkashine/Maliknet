<?php

namespace App\Http\Livewire\Report;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ProductSales extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $from = null;

    public $to = null;

    public $sorting = 'product_name_asc';

    public $column_name;

    public $order_name;

    public $perPage = 15;

    public $search = null;

    protected $queryString = ['search' => ['except' => '']];

    public function render()
    {
        // Fetch min and max dates if not set
        $this->from = $this->from ?? DB::table('customer_order')->min('created_at');
        $this->to = $this->to ?? DB::table('customer_order')->max('created_at');

        // Determine sorting column and order
        if ($this->sorting == 'product_name_asc') {
            $this->column_name = 'name';
            $this->order_name = 'asc';
        } elseif ($this->sorting == 'product_name_desc') {
            $this->column_name = 'name';
            $this->order_name = 'desc';
        } elseif ($this->sorting == 'total_sales_asc') {
            $this->column_name = 'total_sales';
            $this->order_name = 'asc';
        } elseif ($this->sorting == 'total_sales_desc') {
            $this->column_name = 'total_sales';
            $this->order_name = 'desc';
        } elseif ($this->sorting == 'order_quantity_asc') {
            $this->column_name = 'quantity';
            $this->order_name = 'asc';
        } elseif ($this->sorting == 'order_quantity_desc') {
            $this->column_name = 'quantity';
            $this->order_name = 'desc';
        } else {
            $this->column_name = 'name';
            $this->order_name = 'asc';
        }

        // Fetch product sales data
        $products = Product::select([
            'product.id',
            'product.name',
            DB::raw('SUM(CASE WHEN customer_order.status = "Completed" then customer_order_item.quantity else 0 end) AS quantity'),
            DB::raw('SUM(CASE WHEN customer_order.status = "Completed" then customer_order_item.quantity * customer_order_item.price else 0 end) as total_sales'),
        ])
        ->leftJoin('customer_order_item', 'product.id', '=', 'customer_order_item.product_id')
        ->leftJoin('customer_order', function ($join) {
            $join->on('customer_order_item.customer_order_id', '=', 'customer_order.id')
                ->whereBetween('customer_order.created_at', [$this->from, $this->to]);
        })
        ->where('product.name', 'like', '%'.$this->search.'%')
        ->groupBy('product.name', 'product.id')
        ->orderBy($this->column_name, $this->order_name)
        ->paginate($this->perPage);

        return view('livewire.report.product-sales', [
            'products' => $products,
        ]);
    }

}
