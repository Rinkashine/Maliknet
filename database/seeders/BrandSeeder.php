<?php

namespace Database\Seeders;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brand')->insert([
            [
                'name' => 'Glomed', //1
                'photo' => 'Glomed.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Microsuper', //2
                'photo' => 'Microsuper.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'HomeCareDelivered', //3
                'photo' => 'homecaredelivered.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Defender', //4
                'photo' => 'Defender.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'WorldWork', //5
                'photo' => 'WorldWork.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Armstrong', //6
                'photo' => 'Armstrong.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Cyanamid', //7
                'photo' => 'Cyanamid.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Denject', //8
                'photo' => 'Denject.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Misawa Medical', //9
                'photo' => 'Misawa_Medical.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Tudor', //10
                'photo' => 'Tudor.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Dochem', //11
                'photo' => 'Dochem.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Thomas', //12
                'photo' => 'Thomas.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Vericom', //13
                'photo' => 'Vericom.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'WP Dental', //14
                'photo' => 'WP_Dental.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'R&S', //15
                'photo' => 'R&S.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Medicom', //16
                'photo' => 'Medicom.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'ZT Dental', //17
                'photo' => 'ZT_Dental.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Technew', //18
                'photo' => 'Technew.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'GC America', //19
                'photo' => 'GC_America.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Densply Sirona', //20
                'photo' => 'Dentsply_Sirona.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Wards', //21
                'photo' => 'Wards.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Itena', //22
                'photo' => 'Itena.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => '3M', //23
                'photo' => '3M.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Mega Physik', //24
                'photo' => 'Mega-Physik.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Megadenta', //25
                'photo' => 'Megadenta.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Bosworth', //26
                'photo' => 'Bosworth.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Spident', //27
                'photo' => 'Spident.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Zeyco', //28
                'photo' => 'Zeyco.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'AstraZeneca', //29
                'photo' => 'AstraZeneca.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'New Stetic', //30
                'photo' => 'New_Stetic.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Hizon', //31
                'photo' => 'Hizon.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'GC Australia', //32
                'photo' => 'GC_Australia.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Dentflex', //33
                'photo' => 'Dentflex.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'PGO Dental', //34
                'photo' => 'PGO_Dental.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Zhermack', //35
                'photo' => 'Zhermack.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Sky Ortho', //36
                'photo' => 'SkyOrtho.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'G&H', //37
                'photo' => 'G&H.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Suntem', //38
                'photo' => 'Suntem.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Dental America', //39
                'photo' => 'Dental_America.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Resplendent', //40
                'photo' => 'Resplendent.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'name' => 'Unbranded', //41
                'photo' => 'Unbranded.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        //Brand::factory(100)->create();
    }
}
