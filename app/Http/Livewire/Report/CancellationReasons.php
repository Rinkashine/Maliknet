<?php

namespace App\Http\Livewire\Report;

use Livewire\Component;
use App\Models\CancellationReason;
use Illuminate\Support\Facades\DB;

class CancellationReasons extends Component
{
    protected $paginationTheme = 'bootstrap';

    public $from ='2023-01-01T00:00';
    public $to ='2023-12-31T00:00';

    public $sorting = 'total_spent_desc';
    public $cancelled_reason_label = [];
    public $cancelled_reason_dataset = [];
    public $column_name;
    public $order_name;
    public $perPage = 10;
    public $search = null;
    protected $queryString = ['search' => ['except' => '']];

    public function cleanVars(){
        $this->cancelled_reason_label = [];
        $this->cancelled_reason_dataset = [];
    }
    public function render()
    {
        $this->cleanVars();
        if($this->sorting == 'cancellation_name_asc'){
            $this->column_name = "name";
            $this->order_name = "asc";
        }elseif($this->sorting == 'cancellation_name_desc'){
            $this->column_name = "name";
            $this->order_name = 'desc';
        }elseif($this->sorting == 'total_spent_asc'){
            $this->column_name = 'total';
            $this->order_name = "asc";
        }elseif($this->sorting == 'total_spent_desc'){
            $this->column_name = 'total';
            $this->order_name = 'desc';
        }else{
            $this->column_name = "name";
            $this->order_name = "asc";
        }
        $cancellations = CancellationReason::select([
            'name',
            'cancellation_reason.id',
            DB::raw(value: 'COUNT(CASE WHEN customer_order.status = "Cancelled" then customer_order.cancellation_reason_id end) as total'),
        ])
        ->leftjoin('customer_order',function($join){
            $join->on('cancellation_reason.id', '=', 'customer_order.cancellation_reason_id')
            ->where('customer_order.created_at', '>=', $this->from)
            ->where('customer_order.created_at', '<=', $this->to);
        })
        ->where('cancellation_reason.name','like','%'.$this->search.'%')
        ->groupBy('name','cancellation_reason.id')
        ->orderBy($this->column_name, $this->order_name)
        ->paginate($this->perPage);

        $cancellationschart = CancellationReason::select([
            'name',
            'cancellation_reason.id',
            DB::raw(value: 'COUNT(CASE WHEN customer_order.status = "Cancelled" then customer_order.cancellation_reason_id end) as total'),
        ])
        ->leftjoin('customer_order',function($join){
            $join->on('cancellation_reason.id', '=', 'customer_order.cancellation_reason_id')
            ->where('customer_order.created_at', '>=', $this->from)
            ->where('customer_order.created_at', '<=', $this->to);
        })
        ->where('cancellation_reason.name','like','%'.$this->search.'%')
        ->groupBy('name','cancellation_reason.id')
        ->get();

         foreach ($cancellationschart as $chart) {
            array_push($this->cancelled_reason_label, $chart->name);
            array_push($this->cancelled_reason_dataset, $chart->total);
        }

        $this->dispatchBrowserEvent('render-chart', [
            'label' => $this->cancelled_reason_label,
            'reasons' => $this->cancelled_reason_dataset,
        ]);


        return view('livewire.report.cancellation-reasons',[
            'cancellations' => $cancellations
        ]);
    }
}
