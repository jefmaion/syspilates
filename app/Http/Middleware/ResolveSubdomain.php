<?php

declare(strict_types = 1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class ResolveSubdomain
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tenant = $request->route('tenant');

        // if (! $tenant) {
        //     app()->forgetInstance('tenant');

        //     return $next($request);
        // }

        app()->instance('tenant', $tenant);
        URL::defaults(['tenant' => $tenant]);

        // $dbName = $tenant . '_app';
        $dbName = env('DB_DATABASE');

        Config::set('database.connections.tenant.database', $dbName);

        DB::purge('tenant');
        DB::reconnect('tenant');

        return $next($request);
    }
}
