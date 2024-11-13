<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_images')->insert([
            [
                'images' => 'Gloves_Glomed.png',
                'product_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Gloves_Microsuper.png',
                'product_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Gloves_HCD.png',
                'product_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'images' => 'Mask_Disposable_Defender.png',
                'product_id' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Mask_Disposable_Unbranded.png',
                'product_id' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Mask_KN-95_Unbranded.png',
                'product_id' => 6,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Bib_2-Ply_Unbranded.jpg',
                'product_id' => 7,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Saliva_Ejector_WorldWork.png',
                'product_id' => 8,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Saliva_Ejector_MICRO.png',
                'product_id' => 9,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Saliva_Ejector_Flexi.png',
                'product_id' => 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Surgical_Suction_Tip_Unbranded.png',
                'product_id' => 11,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Die_Stone_Armstrong.png',
                'product_id' => 12,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Cast_Stone_Armstrong.jpg',
                'product_id' => 13,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Plaster_Of_Paris_Unbranded.png',
                'product_id' => 14,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Surgical_Silk_Cyanamid.png',
                'product_id' => 15,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Dental_Needle_Denject.png',
                'product_id' => 16,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Dental_Needle_Misawa_Medical.png',
                'product_id' => 17,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Dental_Needle_Vject.png',
                'product_id' => 18,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Chromic_Absorbable_Suture_Tudor.png',
                'product_id' => 19,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Silk_Non-Absorbable_Suture_Tudor.png',
                'product_id' => 20,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Gutta_Percha_Dochem.png',
                'product_id' => 21,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Paper_Point_Unbranded.png',
                'product_id' => 22,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'L-25MM_K-Files_Thomas.png',
                'product_id' => 23,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Well-Pex_Vericom.png',
                'product_id' => 24,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Well-Paste_Vericom.png',
                'product_id' => 25,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Well-Root_Vericom.png',
                'product_id' => 26,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Well-Prep_Vericom.png',
                'product_id' => 27,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Prophy_Brush_Unbranded.png',
                'product_id' => 28,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Prophy_Cup_Unbranded.png',
                'product_id' => 29,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Prophy_Paste_Unbranded.png',
                'product_id' => 30,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Flouride_Varnish_V-varnish.png',
                'product_id' => 31,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Pumice_Unbranded.png',
                'product_id' => 32,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Pumice_Mint_Unbranded.png',
                'product_id' => 33,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Taxi_Solution_Unbranded.png',
                'product_id' => 34,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'C-Bond_WP_Dental.png',
                'product_id' => 35,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Unibond_R&S.png',
                'product_id' => 36,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'U-Bond_Vericom.png',
                'product_id' => 37,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'BC-Plus_Bond_Vericom.png',
                'product_id' => 38,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Applicator_Tips_Unbranded.png',
                'product_id' => 39,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Headcap_Unbranded.png',
                'product_id' => 40,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Mouth_Mirror_Head_Unbranded.png',
                'product_id' => 41,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Cottonroll_Medicom.jpg',
                'product_id' => 42,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Guaze_Medicom.jpg',
                'product_id' => 43,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Cotton_Swab_Medicom.png',
                'product_id' => 44,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Rubber_Dam_Unbranded.png',
                'product_id' => 45,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Matrix_Band_ZT_Dental.png',
                'product_id' => 46,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Foot_Cover_Unbranded.png',
                'product_id' => 47,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Celluloid_Strips_Unbranded.png',
                'product_id' => 48,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Articulating_Paper_Unbranded.png',
                'product_id' => 49,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Finishing_Strips_ZT_Dental.png',
                'product_id' => 50,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Metal_Strips_Double_Sided_Unbranded.png',
                'product_id' => 51,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Metal_Strips_Single_Sided_Unbranded.png',
                'product_id' => 52,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Patient_Dental_Record_Unbranded.png',
                'product_id' => 53,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Hemospon_Technew.png',
                'product_id' => 54,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Cocoa_Butter_Paste_Unbranded.png',
                'product_id' => 55,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Dual_Vac_Vericom.png',
                'product_id' => 56,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Dual_Clean_Vericom.png',
                'product_id' => 57,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Glass_Ionomer_Luting_Cement_Fuji_Big.png',
                'product_id' => 58,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Glass_Ionomer_Luting_Cement_Fuji_Small.png',
                'product_id' => 58,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Glass_Ionomer_Restorative_Fuji_Big.png',
                'product_id' => 59,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Glass_Ionomer_Restorative_Fuji_Small.png',
                'product_id' => 59,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Glass_Ionomer_Restorative_Fuji_Small.png',
                'product_id' => 59,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Glass_Ionomer_Restorative_Fuji_Small.png',
                'product_id' => 59,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Packable_Restorative_Posterior_Fuji_Big.png',
                'product_id' => 60,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Packable_Restorative_Posterior_Fuji_Small.png',
                'product_id' => 60,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'IRM_Densply_Sirona.png',
                'product_id' => 61,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Temrex_Unbranded.jpeg',
                'product_id' => 62,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Tempak_Zoe_Wards.png',
                'product_id' => 63,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Glass_Ionomer_Cement_Ionocem.png',
                'product_id' => 64,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'U-cem_Vericom.png',
                'product_id' => 65,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Dual-Core_Vericom.png',
                'product_id' => 66,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'U-Bond_Ortho_Vericom.png',
                'product_id' => 67,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Denfil_Composite_Vericom.jpg',
                'product_id' => 68,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Denfil_Flow_Vericom.jpg',
                'product_id' => 69,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Denfil_Etchant_Vericom.jpeg',
                'product_id' => 70,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Denfil-Kit_Hybrid_Vericom.png',
                'product_id' => 71,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Denfil-Kit_Nano_Hybrid_Vericom.png',
                'product_id' => 72,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Denfil_Composite_Capsule_Vericom.png',
                'product_id' => 73,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Filtek_Composite_3M.png',
                'product_id' => 74,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Filtek_Flow_3M.png',
                'product_id' => 75,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Composite_Hybrisun.jpg',
                'product_id' => 76,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Flow_Hybrisun.jpg',
                'product_id' => 77,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Megafill_Composite_Megadenta.jpg',
                'product_id' => 78,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Megafill_Flow_Megadenta.jpg',
                'product_id' => 79,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Cav_Liner_Unbranded.png',
                'product_id' => 80,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Copalite_Intermediatary_Varnish_Bosworth.png',
                'product_id' => 81,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Eco-S_Vericom.png',
                'product_id' => 82,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'NOP_Dental_Needle_Spident.png',
                'product_id' => 83,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Topacaina_Zeyco.png',
                'product_id' => 84,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Zeyco_FD.png',
                'product_id' => 85,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Lidocaine_Ointment_Mint_Unbranded.png',
                'product_id' => 86,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Xylocaine_Pump_Spray_AztraZeneca.png',
                'product_id' => 87,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Xylestesin_3M.png',
                'product_id' => 88,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Lidocaine_New_Stetic.png',
                'product_id' => 89,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Atricaine_Artheek.png',
                'product_id' => 90,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Lidocaine_HCI_Ephiniprine_Hizon.png',
                'product_id' => 91,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Turbocaina_Zeyco.png',
                'product_id' => 92,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Dentocain_Zeyco.png',
                'product_id' => 93,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Tooth_Mousse_GC.png',
                'product_id' => 94,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Denture_Case_Unbranded.png',
                'product_id' => 95,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Retainer_Case_Unbranded.png',
                'product_id' => 96,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Hygietol_Unbranded.png',
                'product_id' => 97,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Mirror_Defogger_Unbranded.png',
                'product_id' => 98,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Self-Curing_Liquid_Unbranded.png',
                'product_id' => 99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Self-Curing_Powder_Unbranded.png',
                'product_id' => 100,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Jeltrate_Densply.jpg',
                'product_id' => 101,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Dental_Alginate_Dentflex.png',
                'product_id' => 102,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Dental_Alginate_Makintal.png',
                'product_id' => 103,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Hydrogum_5_Zhermack.jpeg',
                'product_id' => 104,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Hydrogum_Zhermack.jpg',
                'product_id' => 105,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Tropicalgin_Zhermack.jpeg',
                'product_id' => 106,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Surgical_Handpiece_Resplendent.png',
                'product_id' => 107,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Micro_Motor_Unbranded.png',
                'product_id' => 108,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Dental_Chair_Suntem.jpg',
                'product_id' => 109,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Edgewise_Sky_Ortho.png',
                'product_id' => 110,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Mini_MBT_Sky_Ortho.png',
                'product_id' => 111,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Mini_ROTH_Sky_Ortho.png',
                'product_id' => 112,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Standard_MBT_Sky_Ortho.png',
                'product_id' => 113,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Standard_ROTH_Sky_Ortho.png',
                'product_id' => 114,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Convertible_Buccal_Tubes_Sky_Ortho.png',
                'product_id' => 115,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Second_Molar Buccal_Tubes_Sky_Ortho.jpg',
                'product_id' => 116,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Standard_Buccal_Tubes_Sky_Ortho.png',
                'product_id' => 117,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Co_axial_wire_Sky_Ortho.jpg',
                'product_id' => 118,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Nickel_Titanium_Upper_&_Lower_Coated_Ovoid_Sky_Ortho.jpg',
                'product_id' => 119,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Nickel_Titanium_Upper_&_Lower_Coated_Square_Sky_Ortho.jpg',
                'product_id' => 120,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Nickel_Titanium_Upper_&_Lower_Ovoid_Sky_Ortho.jpg',
                'product_id' => 121,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Nickel_Titanium_Upper_&_Lower_Square_Sky_Ortho.jpg',
                'product_id' => 122,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Open_Coil_Spring_Sky_Ortho.jpeg',
                'product_id' => 123,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Reverse_Curve_Wire_Ovoid_Sky_Ortho.jpg',
                'product_id' => 124,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Stainless_Steel_Upper_&_Lower_Ovoid_Sky_Ortho.jpg',
                'product_id' => 125,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Stainless_Steel_Upper_&_Lower_Ovoid_Sky_Ortho.jpg',
                'product_id' => 126,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Reverse_Curve_Wire_Ovoid_Unbranded.jpg',
                'product_id' => 127,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Nickel_Titanium_Upper_&_Lower_Ovoid_Unbranded.jpg',
                'product_id' => 128,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Crimpable_Hooks_Unbranded.png',
                'product_id' => 129,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Lingual_Buttons_Unbranded.png',
                'product_id' => 130,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Lingual_Retainer_Unbranded.png',
                'product_id' => 131,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Ligatures_Unbranded.jpg',
                'product_id' => 132,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Echain_Unbranded.jpg',
                'product_id' => 133,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Elastics_Unbranded.jpg',
                'product_id' => 134,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Rotation_Wedge_G&H.png',
                'product_id' => 135,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Molar_Separator_Unbranded.png',
                'product_id' => 136,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Ortho_Wax_Unbranded.png',
                'product_id' => 137,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Ortho_Brush_Unbranded.png',
                'product_id' => 138,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Stainless_Steel_Impression_Tray_Unbranded.png',
                'product_id' => 139,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Rubber_Impression_Tray_Unbranded.jpeg',
                'product_id' => 140,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'images' => 'Cheeks_Extractor_Unbranded.png',
                'product_id' => 141,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
