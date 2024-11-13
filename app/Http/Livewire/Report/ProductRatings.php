<?php

namespace App\Http\Livewire\Report;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class ProductRatings extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $from = '2023-01-01T00:00';

    public $to = '2023-12-31T00:00';

    public $sorting = 'product_name_asc';

    public $column_name;

    public $order_name;

    public $perPage = 10;

    public $search = null;

    protected $queryString = ['search' => ['except' => '']];

    public function render()
    {
        if ($this->sorting == 'product_name_asc') {
            $this->column_name = 'product.name';
            $this->order_name = 'asc';
        } elseif ($this->sorting == 'product_name_desc') {
            $this->column_name = 'product.name';
            $this->order_name = 'desc';
        } elseif ($this->sorting == 'total_number_asc') {
            $this->column_name = 'total';
            $this->order_name = 'asc';
        } elseif ($this->sorting == 'total_number_desc') {
            $this->column_name = 'total';
            $this->order_name = 'desc';
        } elseif ($this->sorting == 'total_rating_asc') {
            $this->column_name = 'rate';
            $this->order_name = 'asc';
        } elseif ($this->sorting == 'total_rating_desc') {
            $this->column_name = 'rate';
            $this->order_name = 'desc';
        } elseif ($this->sorting == 'ratingLow') {
            $this->column_name = 'ave';
            $this->order_name = 'asc';
        } elseif ($this->sorting == 'ratingHigh') {
            $this->column_name = 'ave';
            $this->order_name = 'desc';
        } else {
            $this->column_name = 'product.name';
            $this->order_name = 'asc';
        }

        $products = Product::select([
            'product.name',
            'product.id',

            DB::raw(value: 'COUNT(CASE WHEN product_review.customer_order_item_id = customer_order_item.id then product.id end) AS total'),
            DB::raw(value: 'SUM(CASE WHEN product_review.customer_order_item_id = customer_order_item.id then rate end) AS rate'),
            DB::raw(value: '(SUM(CASE WHEN product_review.customer_order_item_id = customer_order_item.id then rate end)/COUNT(CASE WHEN product_review.customer_order_item_id = customer_order_item.id then product.id end)) AS ave')
        ])
        ->leftjoin('customer_order_item', 'product.id', '=', 'customer_order_item.product_id')
        ->leftjoin('product_review',function($join){
            $join->on('product_review.customer_order_item_id', '=', 'customer_order_item.id')
            ->where('product_review.created_at', '>=', $this->from)
            ->where('product_review.created_at', '<=', $this->to);
        })
        ->where('product.name','like','%'.$this->search.'%')
        ->groupBy('product.id','product.name')
        ->orderBy($this->column_name, $this->order_name)
        ->paginate($this->perPage);

        return view('livewire.report.product-ratings',[
            'products' => $products,
        ]);
    }
}
