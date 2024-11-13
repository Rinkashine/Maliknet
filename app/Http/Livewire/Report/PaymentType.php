<?php

namespace App\Http\Livewire\Report;

use App\Models\CustomerOrder;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
class PaymentType extends Component
{
    public $startdate = '2023-01-01T00:00';

    public $enddate = '2023-12-31T00:00';
    public $paymenttypelabel = [];
    public $paymenttypedataset = [];

    public function cleanVars(){
        $this->paymenttypelabel = [];
        $this->paymenttypedataset = [];
    }
    public function render()
    {
        $this->cleanVars();
        $typeofpayment = CustomerOrder::select([
            DB::raw('mode_of_payment AS type'),
            DB::raw(value: 'COUNT(mode_of_payment) AS total'),
        ])->where('status',"Completed")
        ->where('created_at', '>=', $this->startdate)
        ->where('created_at', '<=', $this->enddate)
        ->groupBy('mode_of_payment')
        ->get();


        foreach($typeofpayment as $data){
            array_push($this->paymenttypelabel, $data->type);
            array_push($this->paymenttypedataset, $data->total);
        }



        $this->dispatchBrowserEvent('render-chart', [
            'label' => $this->paymenttypelabel,
            'dataset' => $this->paymenttypedataset,
        ]);

        return view('livewire.report.payment-type', [
            'typeofpayment' => $typeofpayment,
            'paymenttypelabel' => $this->paymenttypelabel,
            'paymenttypedataset' => $this->paymenttypedataset,
        ]);
    }
}
