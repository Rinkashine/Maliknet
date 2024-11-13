<?php

namespace App\Http\Livewire\Report;

use Livewire\Component;
use App\Models\Customer;
use App\Models\CustomerOrder;
use Illuminate\Support\Facades\DB;

class MonthlyCancellation extends Component
{
    public function mount($from, $to, $month, $year){
        $this->from = $from;
        $this->to = $to;
        $this->month = $month;
        $this->year = $year;

    }
    public function render()
    {
        $cancellations = CustomerOrder::select([
            'customers.name as customer_name',
            'customer_order.id as id',
            'cancellation_reason.name as reason_name',

            DB::raw(value: 'COUNT(CASE WHEN customer_order.status = "Cancelled" then customer_order.cancellation_reason_id end) as total'),
        ])

        ->leftjoin('cancellation_reason',function($join){
            $join->on('cancellation_reason.id', '=', 'customer_order.cancellation_reason_id');
        })
        ->where('customer_order.created_at', '>=', $this->from)
        ->where('customer_order.created_at', '<=', $this->to)
        ->where('customer_order.status','Cancelled' )
        ->leftjoin('customers', 'customers.id', '=', 'customer_order.customers_id')
        ->groupBy('customer_order.id','cancellation_reason.name','customers.name')
        ->get();

        return view('livewire.report.monthly-cancellation',[
            'cancellations'=> $cancellations,
            'date' => date("F", mktime(0, 0, 0, $this->month, 10)).' '.$this->year,
            'month' => $this->month,
            'year' => $this->year,
        ]);
    }
}
