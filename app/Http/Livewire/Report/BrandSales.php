<?php

namespace App\Http\Livewire\Report;

use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class BrandSales extends Component
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

    public $brandlabel = [];

    public $brandsalesdataset = [];

    public function cleanvars()
    {
        $this->brandlabel = [];
        $this->brandsalesdataset = [];
    }

    public function render()
    {
        $this->cleanvars();

        if ($this->sorting == 'brand_name_asc') {
            $this->column_name = 'name';
            $this->order_name = 'asc';
        } elseif ($this->sorting == 'brand_name_desc') {
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

        $brands = Brand::select([
            'brand.id',
            'brand.name',
            DB::raw(value: 'SUM(CASE WHEN customer_order.status = "Completed" then customer_order_item.quantity * customer_order_item.price else 0 end) as total_sales'),
        ])->leftjoin('product', 'brand.id', '=', 'product.brand_id')
            ->leftjoin('customer_order_item', 'product.id', '=', 'customer_order_item.id')
            ->leftjoin('customer_order', function ($join) {
                $join->on('customer_order_item.customer_order_id', '=', 'customer_order.id')
                ->where('customer_order.created_at', '>', $this->from)
                ->where('customer_order.created_at', '<', $this->to);
            })
            ->where('brand.name', 'like', '%'.$this->search.'%')
            ->groupBy('brand.id', 'brand.name')
            ->orderBy($this->column_name, $this->order_name)
            ->paginate($this->perPage);

        $brandchart = Brand::select([
            'brand.id',
            'brand.name',
            DB::raw(value: 'SUM(CASE WHEN customer_order.status = "Completed" then customer_order_item.quantity * customer_order_item.price else 0 end) as total_sales'),
        ])
        ->leftjoin('product', 'brand.id', '=', 'product.brand_id')
        ->leftjoin('customer_order_item', 'product.id', '=', 'customer_order_item.id')
        ->leftjoin('customer_order', function ($join) {
            $join->on('customer_order_item.customer_order_id', '=', 'customer_order.id')
            ->where('customer_order.created_at', '>', $this->from)
            ->where('customer_order.created_at', '<', $this->to);
        })
        ->groupBy('brand.id', 'brand.name')
        ->get();

        foreach ($brandchart as $brand) {
            array_push($this->brandlabel, $brand->name);
            array_push($this->brandsalesdataset, $brand->total_sales);
        }

        $this->dispatchBrowserEvent('render-chart', [
            'label' => $this->brandlabel,
            'salesdataset' => $this->brandsalesdataset,
        ]);

        return view('livewire.report.brand-sales', [
            'brands' => $brands,
        ]);
    }
}
