<?php

namespace App\Http\Livewire\Report;

use Livewire\Component;
use App\Models\CustomerOrder;
use Illuminate\Support\Facades\DB;

class YearlySales extends Component
{
    public function render()
    {
        $yearlysales = CustomerOrder::join('customer_order_item', 'customer_order.id', '=', 'customer_order_item.customer_order_id')
        ->select([
            DB::raw(value: 'YEAR(customer_order.created_at) as year'),
            DB::raw(value: 'SUM(customer_order_item.quantity*customer_order_item.price) as total'),
        ])
        ->where('customer_order.status', 'Completed')
        ->groupBy( 'year')
        ->orderBy('year', 'asc')
        ->get();
        // dd($yearlysales->toArray());

        $saleschartlabel = [];
        $saleschartdataset = [];

        foreach ($yearlysales as $sales) {
            array_push($saleschartlabel, $sales->year);
            array_push($saleschartdataset, $sales->total);
        }
        // dd($saleschartdataset);
        return view('livewire.report.yearly-sales',[
            'yearlysales' => $yearlysales,
            'saleschartlabel' => $saleschartlabel,
            'saleschartdataset' => $saleschartdataset
        ]);
        return view('livewire.report.yearly-sales');
    }

    public function yearMonthSales (){
        return view('livewire.report.year-month-sales',[
            'yearlysales' => $yearlysales,
            'saleschartlabel' => $saleschartlabel,
            'saleschartdataset' => $saleschartdataset
        ]);
    }
}
