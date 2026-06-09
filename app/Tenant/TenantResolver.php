<?php

namespace App\Tenant;

use App\Models\Admin\Tenant;
use Illuminate\Http\Request;

class TenantResolver
{
    public function resolve(Request $request): TenantContext
    {
        $context = new TenantContext();

        $host = $request->getHost();
        $domain = env('APP_DOMAIN');

        // ADMIN (landlord)
        if ($host === "admin.$domain") {
            $context->type = 'landlord';
            return $context;
        }

        // DOMAIN raiz
        if ($host === $domain) {
            abort(404);
        }

        $parts = explode('.', $host);

        if (count($parts) <= 2) {
            abort(404);
        }

        $subdomain = $parts[0];

        $tenant = Tenant::where('subdomain', $subdomain)
            ->where('active', 1)
            ->first();

        if (! $tenant) {
            abort(404, 'Tenant not found');
        }

        $context->type = 'tenant';
        $context->subdomain = $subdomain;
        $context->tenant = $tenant;
        $context->database = env('DB_PREFIX').'_'.$subdomain;

        return $context;
    }
}
