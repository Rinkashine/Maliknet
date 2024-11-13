<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->insert([
            [
                'name' => 'Colgate',
                'email' => 'supplier1@gmail.com',
                'contact_number' => '09452692274',
                'contact_name' => 'Mark Joseph Manalo',
                'address' => '283 Ramos Compound Baesa Quezon City',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Dental Org',
                'email' => 'supplier2@gmail.com',
                'contact_number' => '09452874489',
                'contact_name' => 'Gene Vincent Soriano',
                'address' => 'Grand Royale subd. Malolos Bulacan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Dental Inc',
                'email' => 'supplier3@gmail.com',
                'contact_number' => '09452692274',
                'contact_name' => 'Paul Cedrick Reyes',
                'address' => '#19 Block A. Sto. Nino St. Barangay San antonio Quezon City',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Dental Sin',
                'email' => 'supplier4@gmail.com',
                'contact_number' => '09452621223',
                'contact_name' => 'Miguel Jerome Silverio',
                'address' => '261 Ramos Compound Baesa Quezon City',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Go Sin',
                'email' => 'supplier5@gmail.com',
                'contact_number' => '09369332354',
                'contact_name' => 'John Zenmar Repil',
                'address' => '#71 St. John Compound Pingkian 1 brgy. Pasong tamo Q,C',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'STI',
                'email' => 'supplier6@gmail.com',
                'contact_number' => '09452692274',
                'contact_name' => 'Aaron Delos Angeles',
                'address' => '19# Antonia St. Centerville Quezon City',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Dove',
                'email' => 'supplier8@gmail.com',
                'contact_number' => '09789825587',
                'contact_name' => 'Ryan Ali',
                'address' => '122 - 10 Bayan St, SFDM Q.C',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Safeguard',
                'email' => 'supplier10@gmail.com',
                'contact_number' => '09452692274',
                'contact_name' => 'Ryan Ventura',
                'address' => '#19 Block A. Sto. Nino St. Barangay San antonio Quezon City',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Kogie',
                'email' => 'supplier11@gmail.com',
                'contact_number' => '09872587741',
                'contact_name' => 'Charmiss Lindo',
                'address' => '26 manga st brgy katipunan sfdm qc',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Microsoft',
                'email' => 'micro@gmail.com',
                'contact_number' => '09875782245',
                'contact_name' => 'Patrik Burgos',
                'address' => '1281 Int 1 Tambunting St. Sta Cruz Manila',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Google',
                'email' => 'google@gmail.com',
                'contact_number' => '09875478987',
                'contact_name' => 'Jason Alinton',
                'address' => '8 Mangachapoy Brgy. Veterans Village',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
