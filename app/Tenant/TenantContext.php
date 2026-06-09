<?php

namespace App\Tenant;

use App\Models\Admin\Tenant;

class TenantContext
{
    public ?string $type = null; // landlord | tenant
    public ?string $subdomain = null;
    public ?string $database = null;
    public ?Tenant $tenant = null;

    public function isLandlord(): bool
    {
        return $this->type === 'landlord';
    }

    public function isTenant(): bool
    {
        return $this->type === 'tenant';
    }
}
