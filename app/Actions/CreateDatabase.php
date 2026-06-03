<?php

namespace App\Actions;

use App\Models\Admin\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateDatabase
{
    public static function run(Tenant $tenant)
    {
        Config::set('database.connections.tenant.database', $tenant->database);

        if(env('APP_DOMAIN') != 'syspilates.test') {
            Config::set('database.connections.tenant.username', env('DB_PREFIX').'_'.$tenant->subdomain);
        }

        // DB::statement("CREATE DATABASE " . $tenant->database);

        DB::purge('tenant');
        DB::reconnect('tenant');

        Artisan::call('migrate:fresh', [
            '--database' => 'tenant'
        ]);

        Artisan::call('db:seed', [
            '--database' => 'tenant',
            '--class' => 'TenantSeeder'
        ]);

        $user = new User();

        $user->setConnection('tenant');
        $user->fill([
            'name' => $tenant->name,
            'email' => $tenant->email,
            'phone1' => $tenant->phone,
            'password' => Hash::make('password')
        ]);

        $user->save();
        $user->setConnection('tenant');
        $user->assignRole('Administrador');
    }
}
