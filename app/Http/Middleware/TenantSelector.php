<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\Admin\Tenant;
use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class TenantSelector
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $host = $request->getHost();

        $domain = env('APP_DOMAIN');

        if ($host === 'admin.' . $domain) {

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


            return $next($request);
        }

          // sem subdomínio
        if ($host === $domain) {
            abort(404);
        }

        $parts = explode(".", $host);

        $subdomain = $parts[0];




        if (count($parts) <= 2) {
            return $next($request);
        }


        $database = env('DB_PREFIX') . '_' . $subdomain;
        $tenant = Tenant::where('subdomain', $subdomain)->where('active', 1)->first();


        if (!$tenant) {
            abort('404', 'Tenant not found');
        }

        app()->instance('tenant', $subdomain);
        app()->instance('tenant_data', $tenant);
        app()->instance('tenant_subdomain', $subdomain);

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



        return $next($request);



        // $host = str_replace('www.', '', $request->getHost());
        // $parts = explode('.', $host);


        // // default
        // $dbName = env('DB_DATABASE');

        // if (count($parts) >= 3 && $parts[0] !== 'admin') {
        //     $dbName = $parts[0] . '_app';
        // }

        // $dbName = $parts[0] . '_app';

        // dd($dbName);


        // // 🔥 força o reset total da conexão
        // DB::purge('mysql');

        // config(['database.connections.mysql.database' => $dbName]);

        // DB::reconnect('mysql');


        // // 🔥 força o Eloquent a usar a nova conexão
        // Model::setConnectionResolver(app('db'));

        // app()->instance('current_db', $dbName);

        // return $next($request);
    }
}
