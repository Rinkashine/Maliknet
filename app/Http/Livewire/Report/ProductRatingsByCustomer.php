<?php

namespace App\Http\Livewire\Report;

use App\Models\Review;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductRatingsByCustomer extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $from = '2023-01-01T00:00';

    public $to = '2023-12-31T00:00';

    public $sorting = 'recent';

    public $column_name;

    public $order_name;

    public $perPage = 10;

    public $search = null;

    protected $queryString = ['search' => ['except' => '']];

    public function mount($product_id, $from, $to){
        $this->product_id = $product_id;
        $this->from = $from;
        $this->to = $to;
    }

    public function render()
    {
        if ($this->sorting == 'customer_name_asc') {
            $this->column_name = 'customers.name';
            $this->order_name = 'asc';
        } elseif ($this->sorting == 'customer_name_desc') {
            $this->column_name = 'customers.name';
            $this->order_name = 'desc';
        } elseif ($this->sorting == 'recent') {
            $this->column_name = 'product_review.created_at';
            $this->order_name = 'desc';
        } elseif ($this->sorting == 'total_rating_asc') {
            $this->column_name = 'rate';
            $this->order_name = 'asc';
        } elseif ($this->sorting == 'total_rating_desc') {
            $this->column_name = 'rate';
            $this->order_name = 'desc';
        }
        $product_info = Product::findorfail($this->product_id);
        $product_name = $product_info->name;

        $rating = Review::join('customer_order_item', 'product_review.customer_order_item_id', '=', 'customer_order_item.id')
        ->leftjoin('customers','customers.id','=','product_review.customer_id')
        ->select([
            'rate',
            'customer_order_item.customer_order_id',
            'customers.name',
            'customers.id as customer_id',
            DB::raw('(SELECT customers.name FROM customers WHERE customers.id = product_review.customer_id) as customer_name'),
            DB::raw('(SELECT customers.photo FROM customers WHERE customers.id = product_review.customer_id) as customer_photo'),
            'product_review.created_at'])
        ->where('product_id', $this->product_id)
        ->where('product_review.created_at', '>=', $this->from)
        ->where('product_review.created_at', '<=', $this->to)
        ->where('customers.name','like','%'.$this->search.'%')
        ->orderby($this->column_name, $this->order_name)
        ->paginate($this->perPage);

        return view('livewire.report.product-ratings-by-customer',[
            'rating' => $rating,
            'product_name' => $product_name,
            'product_id' => $this->product_id
        ]);
    }
}
