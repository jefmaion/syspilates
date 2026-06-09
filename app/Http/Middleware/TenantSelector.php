<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Actions\SetDatabase;
use App\Models\Admin\Tenant;
use App\Tenant\TenantDatabaseManager;
use App\Tenant\TenantResolver;
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
    public function __construct(
        private TenantResolver $resolver,
        private TenantDatabaseManager $db
    ) {}

    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $host = $request->getHost();

        $domain = env('APP_DOMAIN');

        // sem subdomínio
        if ($host === $domain) {
            abort(404);
        }

        $parts = explode(".", $host);
        $subdomain = $parts[0];

        if (count($parts) <= 2) {
            return $next($request);
        }

         if ($host === 'admin.' . $domain) {

             config(['database.default' => 'landlord']);
             URL::defaults(['tenant' => 'admin']);

             app()->instance('tenant', 'landlord');
            app()->instance('tenant_subdomain', config('app.admin'));
            app()->instance('tenant_db', 'landlord');

             app()->instance('tenant', 'landlord');

            DB::purge('landlord');
            DB::reconnect('landlord');


            return $next($request);
         }


        $tenant = Tenant::where('subdomain', $subdomain)->where('active', 1)->first();


        if (!$tenant) {
            abort('404', 'Tenant not found');
        }

        SetDatabase::run($tenant);


        return $next($request);

    }
}
