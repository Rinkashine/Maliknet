<?php

namespace App\Http\Livewire\Report;

use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class RejectedOrders extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $from ='2023-01-01T00:00';
    public $to ='2023-12-31T00:00';

    public $sorting = 'total_spent_desc';
    public $column_name;
    public $order_name;
    public $perPage = 10;
    public $search = null;
    protected $queryString = ['search' => ['except' => '']];
    public function render()
    {
        if($this->sorting == 'customer_name_asc'){
            $this->column_name = "customers.name";
            $this->order_name = "asc";
        }elseif($this->sorting == 'customer_name_desc'){
            $this->column_name = "customers.name";
            $this->order_name = 'desc';
        }elseif($this->sorting == 'cancellation_asc'){
            $this->column_name = 'total';
            $this->order_name = "asc";
        }elseif($this->sorting == 'cancellation_desc'){
            $this->column_name = 'total';
            $this->order_name = 'desc';
        }else{
            $this->column_name = "customers.name";
            $this->order_name = "asc";
        }

        $customers = Customer::select([
            'customers.id',
            'customers.name',
            'customers.email',
            DB::raw(value: 'COUNT(CASE WHEN customer_order.status = "Rejected" and customer_order.created_at >= "'.$this->from.'" and customer_order.created_at <= "'.$this->to.'" then customer_order.rejected_reason end) as total'),
        ])
        ->leftjoin('customer_order','customers.id','=','customer_order.customers_id')
        ->where('customers.name','like','%'.$this->search.'%')
        ->orwhere('customers.email','like','%'.$this->search.'%')
        ->groupBy('customers.name','customers.id','customers.email')
        ->orderBy($this->column_name, $this->order_name)
        ->paginate($this->perPage);

        return view('livewire.report.rejected-orders',[
            'customers' => $customers
        ]);
    }
}
