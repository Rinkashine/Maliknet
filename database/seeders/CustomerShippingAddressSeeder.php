<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerShippingAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customer_shipping_address')->insert([
            [
                'customers_id' => 1,
                'name' => 'Mark Joseph Manalo',
                'phone_number' => '09369332354',
                'notes' => 'Yellow Gate',
                'house' => '283 Ramos Compound Baesa Quezon City',
                'province' => 'Second District(NCR)',
                'city' => 'Quezon City',
                'barangay' => 'Baesa',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'default_address' => 1,
            ],
            [
                'customers_id' => 1,
                'name' => 'Rossana Manalo',
                'phone_number' => '09452692274',
                'notes' => 'Yellow Gate',
                'house' => '283 Ramos Compound Baesa Quezon City',
                'province' => 'Second District(NCR)',
                'city' => 'Quezon City',
                'barangay' => 'Baesa',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'default_address' => 0,
            ],
            [
                'customers_id' => 1,
                'name' => 'Jovy Manalo',
                'phone_number' => '09158535547',
                'notes' => 'Yellow Gate',
                'house' => '283 Ramos Compound Baesa Quezon City',
                'province' => 'Second District(NCR)',
                'city' => 'Quezon City',
                'barangay' => 'Baesa',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'default_address' => 0,
            ],
            [
                'customers_id' => 1,
                'name' => 'Gene Vincent Soriano',
                'phone_number' => '09611212652',
                'notes' => 'Walter Mart',
                'house' => '122 - 10 Bayan St, SFDM Q.C',
                'province' => 'Second District(NCR)',
                'city' => 'Quezon City',
                'barangay' => 'Baesa',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'default_address' => 0,
            ],
            [
                'customers_id' => 1,
                'name' => 'Aaron Delos Angeles',
                'phone_number' => '09494816995',
                'notes' => 'Walter Mart',
                'house' => '19# Antonia St. Centerville Quezon City',
                'province' => 'Second District(NCR)',
                'city' => 'Quezon City',
                'barangay' => 'Baesa',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'default_address' => 0,
            ],
        ]);
    }
}
