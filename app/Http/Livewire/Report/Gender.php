<?php

namespace App\Http\Livewire\Report;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Gender extends Component
{
    public $gender;

    public $genderlabel = [];

    public $genderdataset = [];

    public function cleanvars()
    {
        $this->genderlabel = [];
        $this->genderdataset = [];
    }

    public function render()
    {
        $this->cleanvars();

        $this->gender = Customer::select([
            DB::raw('gender'),
            DB::raw(value : 'COUNT(gender) AS total'),
        ])->groupBy('gender')
        ->get();

        foreach ($this->gender as $data) {
            array_push($this->genderlabel, $data->gender);
            array_push($this->genderdataset, $data->total);
        }

        return view('livewire.report.gender');
    }
}
