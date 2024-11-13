<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteEmailVerifyTokenHourly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:records';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Customer Verify Everyday once the created at is now 1 day';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::table('verify_customers')->where('created_at', '<=', Carbon::now()->subDay())->delete();
    }
}
