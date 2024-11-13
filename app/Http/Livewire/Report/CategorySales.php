<?php

namespace App\Http\Livewire\Report;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class CategorySales extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $from = '2023-01-01T00:00';

    public $to = '2023-12-31T00:00';

    public $sorting = 'total_sales_desc';

    public $column_name;

    public $order_name;

    public $perPage = 10;

    public $search = null;

    protected $queryString = ['search' => ['except' => '']];

    public $categorylabel = [];

    public $categorysalesdataset = [];

    public function cleanvars()
    {
        $this->categorylabel = [];
        $this->categorysalesdataset = [];
    }

    public function render()
    {
        $this->cleanvars();

        if ($this->sorting == 'category_name_asc') {
            $this->column_name = 'name';
            $this->order_name = 'asc';
        } elseif ($this->sorting == 'category_name_desc') {
            $this->column_name = 'name';
            $this->order_name = 'desc';
        } elseif ($this->sorting == 'total_sales_asc') {
            $this->column_name = 'total_sales';
            $this->order_name = 'asc';
        } elseif ($this->sorting == 'total_sales_desc') {
            $this->column_name = 'total_sales';
            $this->order_name = 'desc';
        } else {
            $this->column_name = 'name';
            $this->order_name = 'asc';
        }

        $categories = Category::select([
            'category.id',
            'category.name',
            DB::raw(value: 'SUM(CASE WHEN customer_order.status = "Completed" then customer_order_item.quantity * customer_order_item.price else 0 end) as total_sales'),
        ])->leftjoin('product', 'category.id', '=', 'product.category_id')
            ->leftjoin('customer_order_item', 'product.id', '=', 'customer_order_item.product_id')
            ->leftjoin('customer_order', function ($join) {
                $join->on('customer_order_item.customer_order_id', '=', 'customer_order.id')
                ->where('customer_order.created_at', '>', $this->from)
                ->where('customer_order.created_at', '<', $this->to);
            })
            ->where('category.name', 'like', '%'.$this->search.'%')
            ->groupBy('category.id', 'category.name')
            ->orderBy($this->column_name, $this->order_name)
            ->paginate($this->perPage);

        $categorieschart = Category::select([
            'category.id',
            'category.name',
            DB::raw(value: 'SUM(CASE WHEN customer_order.status = "Completed" then customer_order_item.quantity * customer_order_item.price else 0 end) as total_sales'),
        ])->leftjoin('product', 'category.id', '=', 'product.category_id')
            ->leftjoin('customer_order_item', 'product.id', '=', 'customer_order_item.product_id')
            ->leftjoin('customer_order', function ($join) {
                $join->on('customer_order_item.customer_order_id', '=', 'customer_order.id')
                ->where('customer_order.created_at', '>', $this->from)
                ->where('customer_order.created_at', '<', $this->to);
            })
            ->groupBy('category.id', 'category.name')
            ->orderBy($this->column_name, $this->order_name)
            ->get();

        foreach ($categorieschart as $category) {
            array_push($this->categorylabel, $category->name);
            array_push($this->categorysalesdataset, $category->total_sales);
        }

        $this->dispatchBrowserEvent('render-chart', [
            'label' => $this->categorylabel,
            'salesdataset' => $this->categorysalesdataset,
        ]);

        return view('livewire.report.category-sales', [
            'categories' => $categories,
        ]);
    }
}
