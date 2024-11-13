<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
class PurchaseOrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('purchase_order_items') ->insert([
            [//Received - Begin
                'purchase_order_id' => 1000,
                'product_id' => 38,
                'quantity' => 5,
                'accepted_quantity' => 5,
                'price' => 1100,
                'discount' => 40,
                'created_at' => '2022-12-23 00:00:00',
                'updated_at' => '2022-12-23 00:00:00',
            ],
            [
                'purchase_order_id' => 1001,
                'product_id' => 35,
                'quantity' => 3,
                'accepted_quantity' => 2,
                'price' => 780,
                'discount' => 20,
                'created_at' => '2023-01-5 00:00:00',
                'updated_at' => '2023-01-5 00:00:00',
            ],
            [
                'purchase_order_id' => 1002,
                'product_id' => 80,
                'quantity' => 3,
                'accepted_quantity' => 1,
                'price' => 650,
                'discount' => 0,
                'created_at' => '2023-01-5 00:00:00',
                'updated_at' => '2023-01-5 00:00:00',
            ],
            [
                'purchase_order_id' => 1003,
                'product_id' => 48,
                'quantity' => 12,
                'accepted_quantity' => 12,
                'price' => 30,
                'discount' => 30,
                'created_at' => '2023-01-15 00:00:00',
                'updated_at' => '2023-01-15 00:00:00',
            ],
            [
                'purchase_order_id' => 1004,
                'product_id' => 141,
                'quantity' => 20,
                'accepted_quantity' => 15,
                'price' => 70,
                'discount' => 0,
                'created_at' => '2023-01-15 00:00:00',
                'updated_at' => '2023-01-15 00:00:00',
            ],//Received - End
            [//Draft - Begin
                'purchase_order_id' => 1005,
                'product_id' => 118,
                'quantity' => 10,
                'accepted_quantity' => 0,
                'price' => 600,
                'discount' => 10,
                'created_at' => '2023-02-25 00:00:00',
                'updated_at' => '2023-02-25 00:00:00',
            ],
            [
                'purchase_order_id' => 1006,
                'product_id' => 55,
                'quantity' => 10,
                'accepted_quantity' => 0,
                'price' => 55,
                'discount' => 0,
                'created_at' => '2023-02-25 00:00:00',
                'updated_at' => '2023-02-25 00:00:00',
            ],
            [
                'purchase_order_id' => 1007,
                'product_id' => 115,
                'quantity' => 5,
                'accepted_quantity' => 0,
                'price' => 80,
                'discount' => 5,
                'created_at' => '2023-02-04 00:00:00',
                'updated_at' => '2023-02-04 00:00:00',
            ],
            [
                'purchase_order_id' => 1008,
                'product_id' => 81,
                'quantity' => 5,
                'accepted_quantity' => 0,
                'price' => 380,
                'discount' => 0,
                'created_at' => '2023-02-04 00:00:00',
                'updated_at' => '2023-02-04 00:00:00',
            ],//Draft - End
            [//Pending - Begin
                'purchase_order_id' => 1009,
                'product_id' => 44,
                'quantity' => 5,
                'accepted_quantity' => 0,
                'price' => 40,
                'discount' => 30,
                'created_at' => '2023-03-05 00:00:00',
                'updated_at' => '2023-03-05 00:00:00',
            ],
            [
                'purchase_order_id' => 1010,
                'product_id' => 42,
                'quantity' => 5,
                'accepted_quantity' => 0,
                'price' => 40,
                'discount' => 0,
                'created_at' => '2023-03-06 00:00:00',
                'updated_at' => '2023-03-06 00:00:00',
            ],
            [
                'purchase_order_id' => 1011,
                'product_id' => 129,
                'quantity' => 5,
                'accepted_quantity' => 0,
                'price' => 500,
                'discount' => 0,
                'created_at' => '2023-03-07 00:00:00',
                'updated_at' => '2023-03-07 00:00:00',
            ],
            [
                'purchase_order_id' => 1012,
                'product_id' => 15,
                'quantity' => 5,
                'accepted_quantity' => 0,
                'price' => 55,
                'discount' => 0,
                'created_at' => '2023-03-08 00:00:00',
                'updated_at' => '2023-03-08 00:00:00',
            ],
            [
                'purchase_order_id' => 1013,
                'product_id' => 4,
                'quantity' => 5,
                'accepted_quantity' => 0,
                'price' => 600,
                'discount' => 0,
                'created_at' => '2023-03-09 00:00:00',
                'updated_at' => '2023-03-09 00:00:00',
            ],
            [
                'purchase_order_id' => 1014,
                'product_id' => 68,
                'quantity' => 5,
                'accepted_quantity' => 0,
                'price' => 520,
                'discount' => 10,
                'created_at' => '2023-03-10 00:00:00',
                'updated_at' => '2023-03-10 00:00:00',
            ],//Pending - End
        ]);
    }
}
