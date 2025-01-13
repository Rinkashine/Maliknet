<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Jay Jayme',
            'email' => 'nightcrows016@gmail.com',
            'phone_number' => '09175934434',
            'password' => 'Onepiece25!',
        ]);
        $user->assignRole('Super Admin');
    }
}
