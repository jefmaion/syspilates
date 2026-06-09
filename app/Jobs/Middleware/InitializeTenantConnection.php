<?php

namespace App\Jobs\Middleware;

use App\Actions\SetDatabase;
use Closure;

class InitializeTenantConnection
{
    /**
     * Process the queued job.
     *
     * @param  Closure(object): void  $next
     */
    public function handle(object $job, Closure $next): void
    {
        logger()->info('Entrou no middlewaressss');
        SetDatabase::run();
        $next($job);
    }
}
