<?php

namespace App\Actions;

use App\Models\Admin\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class CreateDatabase
{
    public static function run(Tenant $tenant)
    {
        Config::set('database.connections.tenant.database', $tenant->database);

        DB::statement("CREATE DATABASE " . $tenant->database);
        DB::purge('tenant');

        Artisan::call('migrate:fresh', [
            '--database' => 'tenant'
        ]);

        Artisan::call('db:seed', [
            '--database' => 'tenant',
            '--class' => 'RoleAndPermissionsSeeder'
        ]);

        // User::create([
        //     'name' => $this->name,
        //     'email' => $this->email,
        //     'phone1' => $this->phone,
        //     'password' => Hash::make('password')
        // ])->assignRole('Administrador');
    }
}
