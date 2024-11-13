<?php

namespace App\Http\Livewire\Report;
use App\Models\User;
use Livewire\Component;
use App\Models\Customer;
use Livewire\WithPagination;
use App\Models\CustomerOrder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class MonthlyGainedCustomer extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = null;
    protected $queryString = ['search' => ['except' => '']];
    protected $paginationTheme = 'bootstrap';

    public $action;
    public $from;
    public $to;
    public $sorting = 'January';

    public function render()
    {
        $monthlysales = Customer::select([
            DB::raw(value: 'YEAR(created_at) as year'),
            DB::raw(value: 'MONTHNAME(created_at) as month_name'),
            DB::raw(value: 'MONTH(created_at) as month'),
            DB::raw(value: 'COUNT(name) as total'),
        ])
        ->groupBy('month_name', 'year','month')
        ->orderBy('year','asc')
        ->orderBy('month','asc')
        ->get();
        return view('livewire.report.monthly-gained-customer', [
            'monthlysales' => $monthlysales
        ]);
    }
}
