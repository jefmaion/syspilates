<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
