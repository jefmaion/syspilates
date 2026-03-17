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
        $parts = explode(".", $host);

        $subdomain = $parts[0];

        if ($subdomain == 'localhost') {
            return $next($request);
        }

        $database = 'syspilates_' . $subdomain;



        // echo $database;

        Config::set('database.connections.tenant.database', $database);
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
