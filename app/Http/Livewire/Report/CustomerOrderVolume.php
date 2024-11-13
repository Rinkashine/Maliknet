<?php

namespace App\Http\Livewire\Report;

use Livewire\Component;
use App\Models\Customer;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class CustomerOrderVolume extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;

    public $from ='2023-01-01T00:00';
    public $to ='2023-12-31T00:00';

    public $sorting = 'total_quantity_desc';
    public $column_name;
    public $order_name;

    public $search = null;
    protected $queryString = ['search' => ['except' => '']];

    public function render()
    {
         if($this->sorting == 'customer_name_asc'){
            $this->column_name = "name";
            $this->order_name = "asc";
        }elseif($this->sorting == 'customer_name_desc'){
            $this->column_name = "name";
            $this->order_name = 'desc';
        }elseif($this->sorting == 'total_quantity_asc'){
            $this->column_name = 'total_quantity';
            $this->order_name = "asc";
        }elseif($this->sorting == 'total_quantity_desc'){
            $this->column_name = 'total_quantity';
            $this->order_name = 'desc';
        }else{
            $this->column_name = "name";
            $this->order_name = "asc";
        }

        $customers = Customer::select([
            'customers.id',
            'customers.name',
            'customers.email',
            DB::raw(value: 'sum(CASE WHEN customer_order.status = "Completed" then  customer_order_item.quantity end) AS total_quantity')
        ])
        ->leftjoin('customer_order','customers.id','=','customer_order.customers_id')
        ->leftjoin('customer_order_item',function($join){
            $join->on('customer_order_item.customer_order_id', '=', 'customer_order.id');
        })
        ->where('customers.name','like','%'.$this->search.'%')
        ->orwhere('customers.email','like','%'.$this->search.'%')
        ->groupBy('customers.name','customers.id','customers.email')
        ->orderBy($this->column_name, $this->order_name)
        ->paginate($this->perPage);

        return view('livewire.report.customer-order-volume', [
            'customers' => $customers
        ]);
    }
}
