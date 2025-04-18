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
        $this->call(AdminAccountSeeder::class);
        $this->call(ProductSeeder::class);

    }
}
