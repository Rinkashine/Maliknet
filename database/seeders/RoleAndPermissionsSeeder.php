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
            'category_create',
            'category_edit',
            'category_delete',
            'category_export',
            'category_access',
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

    }
}
