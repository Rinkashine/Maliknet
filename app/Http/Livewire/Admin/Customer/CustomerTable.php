<?php

namespace App\Http\Livewire\Admin\Customer;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerTable extends Component
{
    use WithPagination;

    public $perPage = 10;

    public $search = null;

    protected $queryString = ['search' => ['except' => '']];

    protected $paginationTheme = 'bootstrap';

    public $action;

    public $selectedItem;

    protected $listeners = [
        'refreshParent' => '$refresh',
    ];

    public function render()
    {
        $customers = Customer::search($this->search)
        ->paginate($this->perPage);

        return view('livewire.admin.customer.customer-table', [
            'customers' => $customers,
        ]);
    }

    public function selectItem($itemId, $action)
    {
        $this->selectedItem = $itemId;

        if ($action == 'restrict') {
            $this->emit('getRestrictModalId', $this->selectedItem);
            $this->dispatchBrowserEvent('openRestrictModal');
        }
        $this->action = $action;
    }
}
