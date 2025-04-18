<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductTable extends Component
{
    use WithPagination;

    public $sorting;

    public $perPage = 10;

    public $search = null;

    protected $queryString = ['search' => ['except' => '']];

    protected $paginationTheme = 'bootstrap';

    public $action;

    public $selectedItem;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected $listeners = [
        'refreshParent' => '$refresh',
    ];

    public function mount()
    {
        $this->sorting = 'nameaz';
        $this->perPage = 10;
    }

    public function render()
    {
        if ($this->sorting == 'nameaz') {
            $products = Product::search($this->search)->with('category')
            ->orderBy('name', 'asc')
            ->paginate($this->perPage);
        } elseif ($this->sorting == 'nameza') {
            $products = Product::search($this->search)->with('category')
            ->orderBy('name', 'desc')
            ->paginate($this->perPage);
        } elseif ($this->sorting == 'createdold') {
            $products = Product::search($this->search)->with('category')
            ->orderBy('created_at', 'asc')
            ->paginate($this->perPage);
        } elseif ($this->sorting == 'creatednew') {
            $products = Product::search($this->search)->with('category')
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);
        } elseif ($this->sorting == 'updatedatold') {
            $products = Product::search($this->search)->with('category')
            ->orderBy('updated_at', 'asc')
            ->paginate($this->perPage);
        } elseif ($this->sorting == 'updatedat') {
            $products = Product::search($this->search)->with('category')
            ->orderBy('updated_at', 'desc')
            ->paginate($this->perPage);
        }elseif ($this->sorting == 'cataz') {
            $products = Product::search($this->search)->with('category')
            ->orderBy('category_id', 'asc')
            ->paginate($this->perPage);
        } elseif ($this->sorting == 'catza') {
            $products = Product::search($this->search)->with('category')
            ->orderBy('category_id', 'desc')
            ->paginate($this->perPage);
        } else {
            $products = Product::search($this->search)->with('category')
            ->paginate($this->perPage);
        }

        return view('livewire.admin.product.product-table', [
            'products' => $products,
        ]);
    }


    public function selectItem($itemId, $action)
    {
        $this->selectedItem = $itemId;

        if ($action == 'delete') {
            $this->emit('getModelDeleteModalId', $this->selectedItem);
            $this->dispatchBrowserEvent('openDeleteModal');
        }
        $this->action = $action;
    }
}
