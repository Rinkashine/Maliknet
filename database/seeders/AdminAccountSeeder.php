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
            'name' => 'Mark Joseph Manalo',
            'email' => 'markjosephmanalo1110@gmail.com',
            'phone_number' => '09452692274',
            'password' => 'Onepiece25!',
        ]);
        $user->assignRole('Super Admin');

        User::create([
            'name' => 'Rinkashine Manalo',
            'email' => 'programmingmind1110@gmail.com',
            'phone_number' => '09369332354',
            'password' => 'Onepiece25!',
        ])->assignRole('Head Manager');

        User::create([
            'name' => 'Gene Vincent Soriano',
            'email' => 'gvasoriano2511@gmail.com',
            'phone_number' => '09611212652',
            'password' => 'Onepiece25!',
        ])->assignRole('Inventory Employee');
    }
}
