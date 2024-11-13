<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product') ->insert([
            //Clutch Spring
            [
                'name' => '800RPM, TPs Clutch Spring',
                'category_id' => 1,
                'price' => 200,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => '1000RPM,TPs Clutch Spring',
                'category_id' => 1,
                'price' => 200,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            //Original Belt
            [
                'name' => 'Bando 835-20-30',
                'category_id' => 2,
                'price' => 825,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bando 819-19-30',
                'category_id' => 2,
                'price' => 820,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bando 842-20-30',
                'category_id' => 2,
                'price' => 950,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bando 820-22-30',
                'category_id' => 2,
                'price' => 700,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bando 799-19.5-30',
                'category_id' => 2,
                'price' => 575,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bando 816-22-30',
                'category_id' => 2,
                'price' => 650,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bando 781.5-19.9-30',
                'category_id' => 2,
                'price' => 625,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bando 828-18.1-28',
                'category_id' => 2,
                'price' => 450,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bando 779-18.5-30',
                'category_id' => 2,
                'price' => 500,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bando 867-22-28',
                'category_id' => 2,
                'price' => 500,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bando 792-20.7-28',
                'category_id' => 2,
                'price' => 450,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bando 872-24.4-28',
                'category_id' => 2,
                'price' => 800,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bando 818-19.7-28',
                'category_id' => 2,
                'price' => 1300,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bando 842-22.6-30',
                'category_id' => 2,
                'price' => 950,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bando 887-25.3-30',
                'category_id' => 2,
                'price' => 600,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bando 782-19.5-28',
                'category_id' => 2,
                'price' => 600,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            //Regroove Ordinary Bell
            [
                'name' => 'ADV / PCX 150-160',
                'category_id' => 3,
                'price' => 799,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Click, Airblade',
                'category_id' => 3,
                'price' => 799,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'ER 150N, 150Q, 150P',
                'category_id' => 3,
                'price' => 799,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'RFi175,Gala,Royal',
                'category_id' => 3,
                'price' => 799,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'RGY6, Passion, Venus',
                'category_id' => 3,
                'price' => 799,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => '150CL,Rapid,Ntorq',
                'category_id' => 3,
                'price' => 799,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            //Regroove Racing Bell
            [
                'name' => 'ADV / PCX 150-160',
                'category_id' => 4,
                'price' => 1099,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Click, Airblade',
                'category_id' => 4,
                'price' => 1099,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'ER 150N, 150Q, 150P',
                'category_id' => 4,
                'price' => 1099,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'RFi175,Gala,Royal',
                'category_id' => 4,
                'price' => 1099,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'RGY6, Passion, Venus',
                'category_id' => 4,
                'price' => 1099,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => '150CL,Rapid,Ntorq',
                'category_id' => 4,
                'price' => 1099,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            //Hard Rebonded Lining
            [
                'name' => 'ADV / PCX 150-160',
                'category_id' => 5,
                'price' => 1100,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Click, Airblade',
                'category_id' => 5,
                'price' => 1100,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'ER 150N, 150Q, 150P',
                'category_id' => 5,
                'price' => 1100,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'RFi175,Gala,Royal',
                'category_id' => 5,
                'price' => 1100,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'RGY6, Passion, Venus',
                'category_id' => 5,
                'price' => 1100,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => '150CL,Rapid,Ntorq',
                'category_id' => 5,
                'price' => 1100,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            //Soft Rebonded Lining
            [
                'name' => 'ADV / PCX 150-160',
                'category_id' => 6,
                'price' => 950,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Click, Airblade',
                'category_id' => 6,
                'price' => 950,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'ER 150N, 150Q, 150P',
                'category_id' => 6,
                'price' => 950,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'RFi175,Gala,Royal',
                'category_id' => 6,
                'price' => 950,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'RGY6, Passion, Venus',
                'category_id' => 6,
                'price' => 950,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => '150CL,Rapid,Ntorq',
                'category_id' => 6,
                'price' => 950,
                'status' => 1,
                'description' => "<p>The Glomed Disposable Non Sterile Gloves is powder-free and non-sterile latex and is both ambidextrous and suitable for single use.</p><br>
                                  <p>Manufactured in Malaysia.</p><br>
                                  <p>100 Pcs per box</p>",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
