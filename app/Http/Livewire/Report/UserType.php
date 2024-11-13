<?php

namespace App\Http\Livewire\Report;

use Analytics;
use Carbon\Carbon;
use Livewire\Component;
use Spatie\Analytics\Period;

class UserType extends Component
{
    public $startdate = '2023-01-01T00:00';

    public $enddate = '2023-12-31T00:00';

    public $usertype;

    public $usertypelabel = [];

    public $usertypedataset = [];

    public function cleanVars()
    {
        $this->usertypelabel = [];
        $this->usertypedataset = [];
    }

    public function render()
    {
        $this->cleanVars();

        if ($this->enddate < $this->startdate) {
            $this->startdate = $this->enddate;
        } else {
            $st = new Carbon($this->startdate);
            $ed = new Carbon($this->enddate);
            $period = Period::create($st, $ed);

            $this->usertype = Analytics::fetchUserTypes($period);

            foreach ($this->usertype as $type) {
                array_push($this->usertypelabel, $type['type']);
                array_push($this->usertypedataset, $type['sessions']);
            }

            $this->dispatchBrowserEvent('render-chart', [
                'label' => $this->usertypelabel,
                'dataset' => $this->usertypedataset,
            ]);
       }

        return view('livewire.report.user-type', [
            'usertype' => $this->usertype,
            'usertypelabel' => $this->usertypelabel,
            'usertypedataset' => $this->usertypedataset,
        ]);
    }
}
