<?php

namespace App\Tenant;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class TenantDatabaseManager
{
    public function setTenant($tenant, string $database, string $subdomain): void
    {


        // Config::set('database.connections.tenant.database', $database);

        // if (env('APP_DOMAIN') !== 'syspilates.test') {
        //     Config::set(
        //         'database.connections.tenant.username',
        //         env('DB_PREFIX') . '_' . $subdomain
        //     );
        // }


        // URL::defaults([
        //     'tenant' => $subdomain
        // ]);

        // DB::purge('tenant');
        // DB::reconnect('tenant');
        app()->instance('tenant', $subdomain);
        app()->instance('tenant_data', $tenant);
        app()->instance('tenant_subdomain', $subdomain);
        app()->instance('tenant_db', $database);

        URL::defaults([
            'tenant' => $subdomain
        ]);

        // echo $database;

        Config::set('app.name', $tenant->company_name);

        Config::set('database.connections.tenant.database', $database);

        if(env('APP_DOMAIN') != 'syspilates.test') {
            Config::set('database.connections.tenant.username', env('DB_PREFIX').'_'.$subdomain);
        }

        DB::purge('tenant');
        DB::reconnect('tenant');
    }

    public function setLandlord(): void
    {
        config([
            'database.default' => 'landlord',
        ]);

        app()->instance('tenant', 'landlord');

        URL::defaults([
            'tenant' => 'admin'
        ]);

        // echo $database;

        // Config::set('database.connections.tenant.database', 'syspilates_landlord');
        DB::purge('landlord');
        DB::reconnect('landlord');

        app()->instance('tenant', 'landlord');
        app()->instance('tenant_subdomain', config('app.admin'));
        app()->instance('tenant_db', 'landlord');
    }
}
