<?php

namespace App\Jobs;

use App\Actions\SetDatabase;
use App\Models\User;
use App\Support\TenantResolver;
use App\Notifications\InstructorCreated;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendInstructorCreatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public int $tenantId,
        public int $userId,
        public string $password
    ) {}

    public function handle(): void
    {
        // 1. ativa tenant correto
        // $tenant = app('tenant_data'); // ou buscar por Tenant::find()
        // TenantResolver::set($tenant);

        SetDatabase::run();

        // 2. agora tudo funciona normal
        $user = User::findOrFail($this->userId);

        $user->notify(
            new InstructorCreated(
                password: $this->password,
                name: $user->name,
                email: $user->email
            )
        );
    }
}
