<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions = [
            'role_edit',
            'role_create',
            'role_show',
            'role_access',
            'role_delete',
            'user_management_access',
            'user_create',
            'user_edit',
            'user_show',
            'user_delete',
            'customer_access',
            'brand_create',
            'brand_edit',
            'brand_delete',
            'brand_export',
            'brand_access',
            'category_create',
            'category_edit',
            'category_delete',
            'category_export',
            'category_access',
            'supplier_access',
            'supplier_archive_access',
            'supplier_create',
            'supplier_show',
            'supplier_edit',
            'supplier_archive',
            'supplier_restore',
            'supplier_forcedelete',
            'supplier_export',
            'product_access',
            'product_archive_access',
            'product_create',
            'product_edit',
            'product_archive',
            'product_export',
            'product_restore',
            'product_forcedelete',
            'report_access',
            'report_export',
            'order_access',
            'order_details_access',
            'order_show',
            'order_approval',
            'post_access',
            'post_create',
            'post_edit',
            'post_delete',
            'inventory_access',
            'inventory_edit',
            'inventory_logs',
            'inventory_transfer_access',
            'inventory_transfer_delete',
            'inventory_transfer_create',
        ];
        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
            ]);
        }

        //create roles and assign created permissions
        //Super Admin
        $admin = Role::create(['name' => 'Super Admin']);
        $admin->givePermissionTo(Permission::all());

        $manager = Role::create(['name' => 'Head Manager']);
        $managerpermissions = [
            'brand_access',
            'brand_create',
            'brand_edit',
            'brand_delete',
            'brand_export',

            'category_access',
            'category_create',
            'category_edit',
            'category_delete',
            'category_export',

            'supplier_access',
            'supplier_archive_access',
            'supplier_create',
            'supplier_show',
            'supplier_edit',
            'supplier_archive',
            'supplier_restore',
            'supplier_forcedelete',
            'supplier_export',

            'product_access',
            'product_archive_access',
            'product_create',
            'product_edit',
            'product_archive',
            'product_export',
            'product_restore',
            'product_forcedelete',

            'role_create',
            'role_edit',
            'role_show',
            'role_access',
            'role_delete',
            'user_management_access',
        ];
        foreach ($managerpermissions as $permission) {
            $manager->givePermissionTo($permission);
        }

        $inventory = Role::create(['name' => 'Inventory Employee']);
        $inventorypermission = [
            'brand_access',
            'brand_create',
            'brand_edit',

            'category_access',
            'category_create',
            'category_edit',

            'product_access',
            'product_archive_access',
            'product_create',
            'product_edit',
            'product_archive',
            'product_export',
            'product_restore',

        ];
        foreach ($inventorypermission as $permission) {
            $inventory->givePermissionTo($permission);
        }

        $customercare = Role::create(['name' => 'Customer Care Employee']);
        $customercarepermissions = [
            'customer_access',
        ];
        foreach ($customercarepermissions as $permission) {
            $customercare->givePermissionTo($permission);
        }


        $datamonitor = Role::create(['name' => 'Data Monitoring Employee']);
        $datamonitorpermissions = [
            'report_access',
            'report_export',
            'inventory_access',
            'inventory_logs',
            'inventory_transfer_access',
        ];
        foreach ($datamonitorpermissions as $permission) {
            $datamonitor->givePermissionTo($permission);
        }

    }
}
