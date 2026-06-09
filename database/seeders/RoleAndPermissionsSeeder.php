<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Disable foreign key checks to avoid constraint errors
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // 3. Clear the main tables
        Permission::truncate();
        Role::truncate();

        // 4. Clear pivot relationship tables
        DB::table(config('permission.table_names.model_has_permissions'))->truncate();
        DB::table(config('permission.table_names.model_has_roles'))->truncate();
        DB::table(config('permission.table_names.role_has_permissions'))->truncate();

        // 5. Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $allPermissions = [];
        foreach (config('roles.permissions') as $group => $permissions) {
            foreach($permissions as $name => $label) {
               Permission::updateOrCreate(
                [
                    'name' => $name,
                ],
                [
                    'label' => $label,
                    'group' => $group,
                ]
        );

                $allPermissions[] = $name;
            }
        }

        foreach (config('roles.roles') as $name => $permissions) {

            $role = Role::firstOrCreate([
                'name' => $name
            ]);

            if ($permissions === '*') {
                $role->givePermissionTo($allPermissions);
                continue;
            }

            $role->givePermissionTo($permissions);
        }

    }
}
