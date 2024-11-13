<?php

namespace App\Http\Livewire\Admin\Inventory;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ProductInventoryTable extends Component
{
    use WithPagination;

    public $sorting;

    public $perPage = 10;

    public $search = null;

    protected $queryString = ['search' => ['except' => '']];

    protected $paginationTheme = 'bootstrap';

    public $action;

    public $selectedItem;

    public $x = 'asc';

    protected $listeners = [
        'refreshParent' => '$refresh',
    ];

    public function mount()
    {
        $this->perPage = 10;
    }

    public function selectItem($itemId, $action)
    {
        $this->selectedItem = $itemId;

        if ($action == 'adjust') {
            $this->emit('getAdjustModalId', $this->selectedItem);
            $this->dispatchBrowserEvent('openAdjustModal');
        } else {
            $this->emit('getEditModalId', $this->selectedItem);
            $this->dispatchBrowserEvent('openEditModal');
        }
        $this->action = $action;
    }

    public function render()
    {
        if ($this->sorting == 'nameaz') {
            $this->sorting = 'name';
            $this->x = 'asc';
        } elseif ($this->sorting == 'nameza') {
            $this->sorting = 'name';
            $this->x = 'desc';
        } elseif ($this->sorting == 'createdold') {
            $this->sorting = 'product.created_at';
            $this->x = 'asc';
        } elseif ($this->sorting == 'creatednew') {
            $this->sorting = 'product.created_at';
            $this->x = 'desc';
        } elseif ($this->sorting == 'updatedatold') {
            $this->sorting = 'product.updated_at';
            $this->x = 'asc';
        } elseif ($this->sorting == 'updatedat') {
            $this->sorting = 'product.updated_at';
            $this->x = 'desc';
        } elseif ($this->sorting == 'lowinventory') {
            $this->sorting = 'stock';
            $this->x = 'asc';
        } elseif ($this->sorting == 'highinventory') {
            $this->sorting = 'stock';
            $this->x = 'desc';
        } elseif ($this->sorting == 'cataz') {
            $this->sorting = 'category_id';
            $this->x = 'asc';
        } elseif ($this->sorting == 'catza') {
            $this->sorting = 'category_id';
            $this->x = 'desc';
        } else {
            $this->sorting = 'name';
        }
        $products = Product::search($this->search)->select([
            'product.id',
            'product.name',
            'product.stock',
            'product.SKU',
            DB::raw('COALESCE(co.commited,0) as committed'),
            DB::raw('COALESCE(po.incoming, 0) as incoming'),
            DB::raw('(SELECT brand.name FROM brand WHERE brand.id = product.brand_id) as brand_name'),
            DB::raw('(SELECT category.name FROM category WHERE category.id = product.category_id) as category_name'),

        ])
        ->leftjoin(DB::raw("  (
            SELECT customer_order_item.product_id, SUM(customer_order_item.quantity) as commited
            FROM customer_order
            LEFT JOIN customer_order_item on customer_order.id = customer_order_item.customer_order_id
            WHERE customer_order.status = 'Pending for Approval'
            GROUP BY customer_order_item.product_id
        )  as co  "), function ($join) {
            $join->on('product.id', '=', 'co.product_id');
        })
        ->leftjoin(DB::raw(" (
            SELECT  purchase_order_items.product_id, sum(purchase_order_items.quantity) as incoming FROM purchase_order_items
        LEFT JOIN
             purchase_order on purchase_order_items.purchase_order_id = purchase_order.id
             WHERE purchase_order.status = 'Pending'
             GROUP BY purchase_order_items.product_id
            ) as po"), function ($join) {
            $join->on('product.id', '=', 'po.product_id');
        })

        ->groupby('product.id', 'product.name', 'committed', 'product.stock', 'product.SKU', 'incoming', 'product.brand_id', 'product.category_id')
        ->orderBy($this->sorting, $this->x)
        ->paginate($this->perPage);

        return view('livewire.admin.inventory.product-inventory-table', [
            'products' => $products,
        ]);
    }
}
