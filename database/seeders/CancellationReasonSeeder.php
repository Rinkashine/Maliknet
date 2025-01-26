<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CancellationReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cancellation_reason')->insert([
            [
                'name' => 'Duplicated Order',
            ], [
                'name' => 'Seller request to cancel',
            ], [
                'name' => 'I change my mind',
            ], [
                'name' => 'I want to change my shipping address',
            ], [
                'name' => 'Change/combine order',
            ],
        ]);
    }
}
