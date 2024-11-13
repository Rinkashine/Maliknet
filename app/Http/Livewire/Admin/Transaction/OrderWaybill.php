<?php

namespace App\Http\Livewire\Admin\Transaction;

use Livewire\Component;

class OrderWaybill extends Component
{
    public $orderdetails;

    protected $listeners = [
        'refreshWaybill' => '$refresh',
    ];

    public function mount($orderdetails){
        $this->orderdetails = $orderdetails;
    }

    public function render()
    {
        return view('livewire.admin.transaction.order-waybill');
    }
}
