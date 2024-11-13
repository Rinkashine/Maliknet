<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReturnReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('refund_reason')->insert([
            [
                'name' => 'Wrong Item Receive',
            ], [
                'name' => 'Seller request to return',
            ], [
                'name' => 'Damaged Product',
            ], [
                'name' => 'Changed Mind',
            ],
        ]);
    }
}
