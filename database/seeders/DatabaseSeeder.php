<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CancellationReasonSeeder::class);
        $this->call(RoleAndPermissionsSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(AdminAccountSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(CustomerShippingAddressSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(HomeSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductImageSeeder::class);
        $this->call(CustomerCartSeeder::class);
        $this->call(CustomerOrdersSeeder::class);
        $this->call(CustomerOrderedProductSeeder::class);
        $this->call(PurchaseOrderSeeder::class);
        $this->call(PurchaseOrderItemSeeder::class);
        $this->call(PurchaseOrderTimelineSeeder::class);
        $this->call(ProductReviewSeeder::class);
        $this->call(InventoryHistorySeeder::class);
        $this->call(ReturnReasonSeeder::class);

    }
}
