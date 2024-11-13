<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
class PurchaseOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('purchase_order') ->insert([
            [//Received - Begin
                'suppliers_id' => 2,
                'status' => "Received",
                'shipping_date' => '2023-01-4',
                'tracking' => "11109414",
                'remarks' => null,
                'created_at' => '2022-12-23 00:00:00',
                'updated_at' => '2022-12-23 00:00:00',
            ],
            [
                'suppliers_id' => 3,
                'status' => "Received",
                'shipping_date' => '2023-01-13',
                'tracking' => "11109415",
                'remarks' => null,
                'created_at' => '2023-01-4 00:00:00',
                'updated_at' => '2023-01-4 00:00:00',
            ],
            [
                'suppliers_id' => 3,
                'status' => "Received",
                'shipping_date' => '2023-01-13',
                'tracking' => "11109416",
                'remarks' => null,
                'created_at' => '2023-01-4 12:00:00',
                'updated_at' => '2023-01-4 12:00:00',
            ],
            [
                'suppliers_id' => 4,
                'status' => "Received",
                'shipping_date' => '2023-01-15',
                'tracking' => "11109417",
                'remarks' => null,
                'created_at' => '2023-01-5 00:00:00',
                'updated_at' => '2023-01-5 00:00:00',
            ],
            [
                'suppliers_id' => 5,
                'status' => "Received",
                'shipping_date' => '2023-01-15',
                'tracking' => "11109418",
                'remarks' => null,
                'created_at' => '2023-01-5 12:00:00',
                'updated_at' => '2023-01-5 12:00:00',
            ], //Received - End
            [ //Draft - Begin
                'suppliers_id' => 6,
                'status' => "Draft",
                'shipping_date' => '2023-03-30',
                'tracking' => null,
                'remarks' => null,
                'created_at' => '2023-03-10 00:00:00',
                'updated_at' => '2023-03-10 00:00:00',
            ],
            [
                'suppliers_id' => 6,
                'status' => "Draft",
                'shipping_date' => '2023-03-30',
                'tracking' => null,
                'remarks' => null,
                'created_at' => '2023-03-09 00:00:00',
                'updated_at' => '2023-03-09 00:00:00',

            ],
            [
                'suppliers_id' => 7,
                'status' => "Draft",
                'shipping_date' => '2023-04-05',
                'tracking' => null,
                'remarks' => null,
                'created_at' => '2023-03-08 00:00:00',
                'updated_at' => '2023-03-08 00:00:00',

            ],
            [
                'suppliers_id' => 8,
                'status' => "Draft",
                'shipping_date' => '2023-04-05',
                'tracking' => null,
                'remarks' => null,
                'created_at' => '2023-03-07 00:00:00',
                'updated_at' => '2023-03-07 00:00:00',

            ],//Draft - End
            [//Pending - Begin
                'suppliers_id' => 1,
                'status' => "Pending",
                'shipping_date' => '2023-04-11',
                'tracking' => null,
                'remarks' => null,
                'created_at' => '2023-03-05 00:00:00',
                'updated_at' => '2023-03-05 00:00:00',
            ],
            [
                'suppliers_id' => 3,
                'status' => "Pending",
                'shipping_date' => '2023-04-12',
                'tracking' => null,
                'remarks' => null,
                'created_at' => '2023-03-06 00:00:00',
                'updated_at' => '2023-03-06 00:00:00',
            ],
            [
                'suppliers_id' => 5,
                'status' => "Pending",
                'shipping_date' => '2023-04-13',
                'tracking' => null,
                'remarks' => null,
                'created_at' => '2023-03-04 12:00:00',
                'updated_at' => '2023-03-04 12:00:00',

            ],
            [
                'suppliers_id' => 7,
                'status' => "Pending",
                'shipping_date' => '2023-04-14',
                'tracking' => null,
                'remarks' => null,
                'created_at' => '2023-03-04 00:00:00',
                'updated_at' => '2023-03-04 00:00:00',

            ],
            [
                'suppliers_id' => 9,
                'status' => "Pending",
                'shipping_date' => '2023-04-15',
                'tracking' => null,
                'remarks' => null,
                'created_at' => '2023-02-25 12:00:00',
                'updated_at' => '2023-02-25 12:00:00',

            ],
            [
                'suppliers_id' => 11,
                'status' => "Pending",
                'shipping_date' => '2023-04-16',
                'tracking' => null,
                'remarks' => null,
                'created_at' => '2023-02-25 00:00:00',
                'updated_at' => '2023-02-25 00:00:00',
            ],//Pending - End

        ]);
    }
}
