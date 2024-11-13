<?php

namespace App\Http\Livewire\Report;

use Analytics;
use Carbon\Carbon;
use Livewire\Component;
use Spatie\Analytics\Period;

class Browser extends Component
{
     public $startdate = '2023-01-01T00:00';

     public $enddate = '2023-12-31T00:00';

    public $browsers;

    public $browserchartlabel = [];

    public $browserchartdataset = [];

    public function cleanVars(){
        $this->browserchartdataset = [];
        $this->browserchartlabel = [];
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

            $this->browsers = Analytics::fetchTopBrowsers($period, 20);
            foreach ($this->browsers as $browser) {
                array_push($this->browserchartlabel, $browser['browser']);
                array_push($this->browserchartdataset, $browser['sessions']);
            }

            $this->dispatchBrowserEvent('render-chart', [
                'label' => $this->browserchartlabel,
                'dataset' => $this->browserchartdataset,
            ]);
        }

        return view('livewire.report.browser', [
            'browsers' => $this->browsers,
            'browserchartlabel' => $this->browserchartlabel,
            'browserchartdataset' => $this->browserchartdataset,
        ]);
    }
}
