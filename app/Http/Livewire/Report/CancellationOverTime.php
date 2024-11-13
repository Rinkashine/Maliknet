<?php

namespace App\Http\Livewire\Report;

use Livewire\Component;
use App\Models\CustomerOrder;
use Illuminate\Support\Facades\DB;

class CancellationOverTime extends Component
{
    public function render()
    {
        $monthlycancellations = CustomerOrder::select([
            DB::raw(value: 'YEAR(customer_order.created_at) as year'),
            DB::raw(value: 'MONTHNAME(customer_order.created_at) as month_name'),
            DB::raw(value: 'MONTH(customer_order.created_at) as month'),
            DB::raw(value: 'COUNT(*) as total'),
        ])
        ->where('customer_order.status','Cancelled')
        ->groupBy('month_name', 'year','month')
        ->orderBy('year','asc')
        ->orderBy('month','asc')
        ->get();
        return view('livewire.report.cancellation-over-time',[
            'monthlycancellations' => $monthlycancellations

        ]);
        
    }
}
