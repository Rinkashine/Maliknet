<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert([
            [
                'name' => 'Gloves', //1
                'photo' => 'Gloves.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Mask', //2
                'photo' => 'Mask.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Bib', //3
                'photo' => 'Bib.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Suction Tip', //4
                'photo' => 'Suction_Tip.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Dental Stones', //5
                'photo' => 'Dental_Stones.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Suturing Materials', //6
                'photo' => 'Suturing_Materials.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Root Canal Materials', //7
                'photo' => 'Root_Canal_Materials.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Prophylaxis Materials', //8
                'photo' => 'Prophylaxis_Materials.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Bonding Agent', //9
                'photo' => 'Bonding_Agent.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Consumable Item', //10
                'photo' => 'Consumable_Item.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Cleaner Solution', //11
                'photo' => 'Cleaner_Solution.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Cements', //12
                'photo' => 'Cement.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Restorative Materials', //13
                'photo' => 'Restorative_Materials.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Local Anesthesia', //14
                'photo' => 'Local_Anesthesia.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Others', //15
                'photo' => 'Others.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Alginate', //16
                'photo' => 'Alginate.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Appliances', //17
                'photo' => 'Appliances.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Brackets', //18
                'photo' => 'Brackets.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Buccal Tubes', //19
                'photo' => 'Buccal_Tubes.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Dental Arch Wires', //20
                'photo' => 'Dental_Arch_Wires.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Ortho Appliance', //21
                'photo' => 'Ortho_Appliances.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Ortho Elastics', //22
                'photo' => 'Ortho_Elastics.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Topical Anesthesia', //23
                'photo' => 'Topical_Anesthesia.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        //Category::factory(100)->create();
    }
}
