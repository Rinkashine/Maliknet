<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PurchaseOrderTimelineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('purchase_order_timeline') ->insert([
            [//Received - Begin
                'purchase_order_id' => 1000,
                'title' => 'Created as Draft',
                'created_at' => '2022-12-23 00:00:00',
                'updated_at' => '2022-12-23 00:00:00',
            ],
            [
                'purchase_order_id' => 1000,
                'title' => 'Mark as Pending',
                'created_at' => '2022-12-24 00:00:00',
                'updated_at' => '2022-12-24 00:00:00',
            ],
            [
                'purchase_order_id' => 1000,
                'title' => 'Received the Items',
                'created_at' => '2023-01-4 00:00:00',
                'updated_at' => '2023-01-4 00:00:00',
            ],
            [
                'purchase_order_id' => 1001,
                'title' => 'Created as Draft',
                'created_at' => '2023-01-4 00:00:00',
                'updated_at' => '2023-01-4 00:00:00',
            ],
            [
                'purchase_order_id' => 1001,
                'title' => 'Mark as Pending',
                'created_at' => '2023-01-5 00:00:00',
                'updated_at' => '2023-01-5 00:00:00',
            ],
            [
                'purchase_order_id' => 1001,
                'title' => 'Received the Items',
                'created_at' => '2023-01-13 00:00:00',
                'updated_at' => '2023-01-13 00:00:00',
            ],
            [
                'purchase_order_id' => 1002,
                'title' => 'Created as Draft',
                'created_at' => '2023-01-4 12:00:00',
                'updated_at' => '2023-01-4 12:00:00',
            ],
            [
                'purchase_order_id' => 1002,
                'title' => 'Mark as Pending',
                'created_at' => '2023-01-5 12:00:00',
                'updated_at' => '2023-01-5 12:00:00',
            ],
            [
                'purchase_order_id' => 1002,
                'title' => 'Received the Items',
                'created_at' => '2023-01-13 00:00:00',
                'updated_at' => '2023-01-13 00:00:00',
            ],
            [
                'purchase_order_id' => 1003,
                'title' => 'Created as Draft',
                'created_at' => '2023-01-5 00:00:00',
                'updated_at' => '2023-01-5 00:00:00',
            ],
            [
                'purchase_order_id' => 1003,
                'title' => 'Mark as Pending',
                'created_at' => '2023-01-6 00:00:00',
                'updated_at' => '2023-01-6 00:00:00',
            ],
            [
                'purchase_order_id' => 1003,
                'title' => 'Received the Items',
                'created_at' => '2023-01-15 00:00:00',
                'updated_at' => '2023-01-15 00:00:00',
            ],
            [
                'purchase_order_id' => 1004,
                'title' => 'Created as Draft',
                'created_at' => '2023-01-5 12:00:00',
                'updated_at' => '2023-01-5 12:00:00',
            ],
            [
                'purchase_order_id' => 1004,
                'title' => 'Mark as Pending',
                'created_at' => '2023-01-6 12:00:00',
                'updated_at' => '2023-01-6 12:00:00',
            ],
            [
                'purchase_order_id' => 1004,
                'title' => 'Received the Items',
                'created_at' => '2023-01-15 00:00:00',
                'updated_at' => '2023-01-15 00:00:00',
            ],//Received - End
            [//Draft - Begin
                'purchase_order_id' => 1005,
                'title' => 'Created as Draft',
                'created_at' => '2023-02-25 00:00:00',
                'updated_at' => '2023-02-25 00:00:00',
            ],
            [
                'purchase_order_id' => 1006,
                'title' => 'Created as Draft',
                'created_at' => '2023-02-25 12:00:00',
                'updated_at' => '2023-02-25 12:00:00',
            ],
            [
                'purchase_order_id' => 1007,
                'title' => 'Created as Draft',
                'created_at' => '2023-03-04 00:00:00',
                'updated_at' => '2023-03-04 00:00:00',
            ],
            [
                'purchase_order_id' => 1008,
                'title' => 'Created as Draft',
                'created_at' => '2023-03-04 12:00:00',
                'updated_at' => '2023-03-04 12:00:00',
            ],//Draft - End
            [//Pending - Begin
                'purchase_order_id' => 1009,
                'title' => 'Created as Draft',
                'created_at' => '2023-03-05 00:00:00',
                'updated_at' => '2023-03-05 00:00:00',
            ],
            [
                'purchase_order_id' => 1009,
                'title' => 'Marked as Pending',
                'created_at' => '2023-03-06 00:00:00',
                'updated_at' => '2023-03-06 00:00:00',
            ],
            [
                'purchase_order_id' => 1010,
                'title' => 'Created as Draft',
                'created_at' => '2023-03-06 00:00:00',
                'updated_at' => '2023-03-06 00:00:00',
            ],
            [
                'purchase_order_id' => 1010,
                'title' => 'Marked as Pending',
                'created_at' => '2023-03-07 00:00:00',
                'updated_at' => '2023-03-07 00:00:00',
            ],
            [
                'purchase_order_id' => 1011,
                'title' => 'Created as Draft',
                'created_at' => '2023-03-07 00:00:00',
                'updated_at' => '2023-03-07 00:00:00',
            ],
            [
                'purchase_order_id' => 1011,
                'title' => 'Marked as Pending',
                'created_at' => '2023-03-08 00:00:00',
                'updated_at' => '2023-03-08 00:00:00',
            ],
            [
                'purchase_order_id' => 1012,
                'title' => 'Created as Draft',
                'created_at' => '2023-03-08 00:00:00',
                'updated_at' => '2023-03-08 00:00:00',
            ],
            [
                'purchase_order_id' => 1012,
                'title' => 'Marked as Pending',
                'created_at' => '2023-03-09 00:00:00',
                'updated_at' => '2023-03-09 00:00:00',
            ],
            [
                'purchase_order_id' => 1013,
                'title' => 'Created as Draft',
                'created_at' => '2023-03-09 00:00:00',
                'updated_at' => '2023-03-09 00:00:00',
            ],
            [
                'purchase_order_id' => 1013,
                'title' => 'Marked as Pending',
                'created_at' => '2023-03-10 00:00:00',
                'updated_at' => '2023-03-10 00:00:00',
            ],
            [
                'purchase_order_id' => 1014,
                'title' => 'Created as Draft',
                'created_at' => '2023-03-10 00:00:00',
                'updated_at' => '2023-03-10 00:00:00',
            ],
            [
                'purchase_order_id' => 1014,
                'title' => 'Marked as Pending',
                'created_at' => '2023-03-11 00:00:00',
                'updated_at' => '2023-03-11 00:00:00',
            ],//Pending - End
        ]);
    }
}
