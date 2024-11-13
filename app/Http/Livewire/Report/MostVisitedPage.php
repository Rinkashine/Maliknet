<?php

namespace App\Http\Livewire\Report;

use Analytics;
use Carbon\Carbon;
use Livewire\Component;
use Spatie\Analytics\Period;

class MostVisitedPage extends Component
{
    public $startdate = '2023-01-01T00:00';

    public $enddate = '2023-12-31T00:00';

    public $mostvisitedpage;

    public $mostvisitedlabel = [];

    public $mostvisiteddataset = [];

    protected $listeners = [
        'refreshParent' => '$refresh',
    ];

    public function render()
    {
        $this->mostvisitedlabel = [];
        $this->mostvisiteddataset = [];

        if ($this->enddate < $this->startdate) {
            $this->startdate = $this->enddate;
        } else {
            $st = new Carbon($this->startdate);
            $ed = new Carbon($this->enddate);
            $period = Period::create($st, $ed);

            $this->mostvisitedpage = Analytics::fetchMostVisitedPages($period, 10);

            foreach ($this->mostvisitedpage as $page) {
                array_push($this->mostvisitedlabel, $page['pageTitle']);
                array_push($this->mostvisiteddataset, $page['pageViews']);
            }

            $this->dispatchBrowserEvent('render-chart', [
                'label' => $this->mostvisitedlabel,
                'dataset' => $this->mostvisiteddataset,
            ]);

        }





        return view('livewire.report.most-visited-page', [
            'mostvisitedpage' => $this->mostvisitedpage,
            'mostvisitedlabel' => $this->mostvisitedlabel,
            'mostvisiteddataset' => $this->mostvisiteddataset,
        ]);
    }
}
