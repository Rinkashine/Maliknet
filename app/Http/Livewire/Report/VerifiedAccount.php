<?php

namespace App\Http\Livewire\Report;

use Livewire\Component;
use App\Models\Customer;
use Livewire\WithPagination;

class VerifiedAccount extends Component
{
    use WithPagination;

    public $sorting = 'customer_name_asc';
    public $column_name;
    public $order_name;

    public $search = null;
    protected $queryString = ['search' => ['except' => '']];

    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public function render()
    {
        if($this->sorting == 'customer_name_asc'){
            $this->column_name = "name";
            $this->order_name = "asc";
        }elseif($this->sorting == 'customer_name_desc'){
            $this->column_name = "name";
            $this->order_name = 'desc';
        }else{
            $this->column_name = "name";
            $this->order_name = "asc";
        }

        $verified = Customer::select('name', 'email')->where('email_verified_at','!=',null)
        ->where('customers.name','like','%'.$this->search.'%')
        ->orderBy($this->column_name, $this->order_name)
        ->paginate($this->perPage);

        return view('livewire.report.verified-account',[
            'verified' => $verified
        ]);
    }
}
