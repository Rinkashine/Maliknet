<?php

namespace App\Http\Livewire\Customer\Productcatalog;

use App\Models\CustomerOrder;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ProductShow extends Component
{
    use WithPagination;

    public $product;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function render()
    {
        $sold = CustomerOrder::join('customer_order_item', 'customer_order_item.customer_order_id', '=', 'customer_order.id')
        ->where('customer_order_item.product_id', $this->product->id)
        ->where('customer_order.status', 'Completed')
        ->sum('quantity');

        $reviews = Review::join('customer_order_item', 'product_review.customer_order_item_id', '=', 'customer_order_item.id')
        ->select(['product_name', 'rate', 'comment',
            DB::raw('(SELECT customers.name FROM customers WHERE customers.id = product_review.customer_id) as customer_name'),
            DB::raw('(SELECT customers.photo FROM customers WHERE customers.id = product_review.customer_id) as customer_photo'),

            'product_review.created_at'])
        ->where('product_id', $this->product->id)
        ->orderby('product_review.created_at', 'desc')
        ->paginate(5);

        $sum_rate = Review::join('customer_order_item', 'product_review.customer_order_item_id', '=', 'customer_order_item.id')
        ->select('product_name', 'rate')
        ->where('product_name', $this->product->name)
        ->get()->sum('rate');

        $count_rate = Review::join('customer_order_item', 'product_review.customer_order_item_id', '=', 'customer_order_item.id')
        ->select('product_name', 'rate')
        ->where('product_name', $this->product->name)
        ->get()->count();

        if ($sum_rate != 0 || $count_rate != 0) {
            $ave_rate = $sum_rate / $count_rate;
        } else {
            $ave_rate = 0;
        }
        $rate1 = Review::join('customer_order_item', 'product_review.customer_order_item_id', '=', 'customer_order_item.id')
        ->select('product_name', 'rate')
        ->where('product_name', $this->product->name)
        ->where('rate', '1')
        ->get()->count();
        $rate2 = Review::join('customer_order_item', 'product_review.customer_order_item_id', '=', 'customer_order_item.id')
        ->select('product_name', 'rate')
        ->where('product_name', $this->product->name)
        ->where('rate', '2')
        ->get()->count();
        $rate3 = Review::join('customer_order_item', 'product_review.customer_order_item_id', '=', 'customer_order_item.id')
        ->select('product_name', 'rate')
        ->where('product_name', $this->product->name)
        ->where('rate', '3')
        ->get()->count();
        $rate4 = Review::join('customer_order_item', 'product_review.customer_order_item_id', '=', 'customer_order_item.id')
        ->select('product_name', 'rate')
        ->where('product_name', $this->product->name)
        ->where('rate', '4')
        ->get()->count();
        $rate5 = Review::join('customer_order_item', 'product_review.customer_order_item_id', '=', 'customer_order_item.id')
        ->select('product_name', 'rate')
        ->where('product_name', $this->product->name)
        ->where('rate', '5')
        ->get()->count();

        return view('livewire.customer.productcatalog.product-show', [
            'reviews' => $reviews,
            'sum_rate' => $sum_rate,
            'ave_rate' => $ave_rate,
            'count_rate' => $count_rate,
            'rate1' => $rate1,
            'rate2' => $rate2,
            'rate3' => $rate3,
            'rate4' => $rate4,
            'rate5' => $rate5,
            'sold' => $sold,
        ]);
    }
}
