<?php

namespace App\Http\Livewire\Report;

use App\Models\CustomerOrder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MonthlySales extends Component
{
    public function render()
    {
        $monthlysales = CustomerOrder::join('customer_order_item', 'customer_order.id', '=', 'customer_order_item.customer_order_id')
        ->select([
            DB::raw(value: 'YEAR(customer_order.created_at) as year'),
            DB::raw(value: 'MONTHNAME(customer_order.created_at) as month_name'),
            DB::raw(value: 'MONTH(customer_order.created_at) as month'),
            DB::raw(value: 'SUM(customer_order_item.quantity*customer_order_item.price) as total'),
        ])
        ->where('customer_order.status', 'Completed')
        ->groupBy('month_name', 'year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();

        $saleschartlabel = [];
        $saleschartdataset = [];

        foreach ($monthlysales as $sales) {
            array_push($saleschartlabel, $sales->year.'-'.$sales->month_name);
            array_push($saleschartdataset, $sales->total);
        }

        return view('livewire.report.monthly-sales', [
            'monthlysales' => $monthlysales,
            'saleschartlabel' => $saleschartlabel,
            'saleschartdataset' => $saleschartdataset,
        ]);
    }
}
