<?php

namespace App\Actions;

use App\Models\User;
use App\Jobs\SendInstructorCreatedJob;
use App\Support\TenantResolver;

class SendInstructorCreated
{
    public static function run(User $user, string $password): void
    {
        // 1. resolve tenant automaticamente
        SetDatabase::run();

        // 2. dispatch job (landlord queue)
        SendInstructorCreatedJob::dispatch(
            tenantId: app('tenant_data')->id,
            userId: $user->id,
            password: $password
        );
    }
}
