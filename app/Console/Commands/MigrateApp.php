<?php

declare(strict_types = 1);

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MigrateApp extends Command
{
    /**
     * Nome do comando (o que você digita no terminal).
     */
    protected $signature = 'migrate-app {--fresh} {--seed}';

    /**
     * Descrição do comando.
     */
    protected $description = 'Rodar migrations da pasta migrations/app';

    /**
     * Lógica do comando.
     */
    public function handle()
    {
        $command = $this->option('fresh') ? 'migrate:fresh' : 'migrate';
        $this->call($command, ['--path' => 'database/migrations/app', '--seed' => $this->option('seed'), ]);
    }
}
