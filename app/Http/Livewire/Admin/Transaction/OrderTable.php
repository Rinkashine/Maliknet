<?php

namespace App\Http\Livewire\Admin\Transaction;

use App\Models\CustomerOrder;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class OrderTable extends Component
{
    use WithPagination;

    public $perPage = 10;

    public $search = null;

    public $sorting = null;

    protected $queryString = ['search' => ['except' => '']];

    protected $paginationTheme = 'bootstrap';

    public $action;

    public $selectItem;

    public function selectItem($itemId, $action)
    {
        $this->selectedItem = $itemId;
        if ($action == 'changeorderstatus') {
            $this->emit('getChangeOrderStatusId', $this->selectedItem);
            $this->dispatchBrowserEvent('openChangeOrderStatusModal');
        }
        $this->action = $action;
    }

    public function render()
    {
        abort_if(Gate::denies('order_access'), 403);
        if ($this->sorting == null) {
            $orders = CustomerOrder::search($this->search)
            ->with('customers')
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);
        } else {
            $orders = CustomerOrder::search($this->search)
            ->where('status', $this->sorting)
            ->with('customers')
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);
        }

        return view('livewire.admin.transaction.order-table', [
            'orders' => $orders,
        ]);
    }
}
