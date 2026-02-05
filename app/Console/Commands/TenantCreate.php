<?php

declare(strict_types = 1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class TenantCreate extends Command
{
    protected $signature = 'tenant:create {slug}';

    protected $description = 'Cria o banco do tenant, roda migrations e seeds';

    public function handle()
    {
        $slug   = $this->argument('slug');
        $dbName = $slug . '_app';

        // 1️⃣ Conecta no banco "central" (sem database)
        $root = config('database.connections.mysql');

        $pdo = new \PDO(
            "mysql:host={$root['host']};port={$root['port']}",
            $root['username'],
            $root['password'],
            [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
        );

        // 2️⃣ Força criar o banco
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

        $this->info("Banco [$dbName] criado/verificado!");

        // 3️⃣ Aponta a conexão tenant para o banco criado
        Config::set('database.connections.tenant.database', $dbName);
        DB::purge('tenant');
        DB::reconnect('tenant');

        // 4️⃣ Roda migrations do tenant
        $this->call('migrate', [
            '--path'     => 'database/migrations/app',
            '--database' => 'tenant',
            '--force'    => true,
        ]);

        // 5️⃣ (opcional) roda seeds
        $this->call('db:seed', [
            '--class'    => 'Database\\Seeders\\app',
            '--database' => 'tenant',
            '--force'    => true,
        ]);

        $this->info("Tenant [$slug] criado com sucesso! 🚀");
    }
}
