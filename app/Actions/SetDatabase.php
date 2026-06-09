<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\ClassStatusEnum;
use App\Models\Admin\Tenant;
use App\Models\Classes;
use App\Models\ClassMakeup;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class SetDatabase
{
    public static function run(Tenant $tenant) {

        Config::set('app.name', $tenant->company_name);

        Config::set('database.connections.tenant.database', $tenant->database);

        if(env('APP_DOMAIN') != 'syspilates.test') {
            Config::set('database.connections.tenant.username', env('DB_PREFIX').'_'.$tenant->subdomain);
        }

        app()->instance('tenant', $tenant->subdomain);
        app()->instance('tenant_data', $tenant);
        app()->instance('tenant_subdomain', $tenant->subdomain);
        app()->instance('tenant_db', $tenant->database);

        config(['database.default' => 'tenant']);

        URL::defaults(['tenant' => $tenant->subdomain]);

        Config::set('app.name', $tenant->company_name);

        DB::purge('tenant');
        DB::reconnect('tenant');
    }
}
