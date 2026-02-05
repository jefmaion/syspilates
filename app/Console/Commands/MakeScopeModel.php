<?php

declare(strict_types = 1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeScopeModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:scope-model {name} {--msf} {--admin} {--app}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create model, migration, seeder and factory to app';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $name = $this->argument('name');

        $params = ['name' => $name];

        if ($this->option('msf')) {
            $params['--migration'] = true;
            $params['--seed']      = true;
            $params['--factory']   = true;
        }

        $this->call('make:model', $params);

        $this->moveMigrations($name);
    }

    private function moveMigrations($name)
    {
        $_folder = 'app';

        if ($this->option('admin')) {
            $_folder = 'admin';
        }

        $folders = ['database/migrations', 'database/seeders', 'app/models/'];

        // $path    = database_path('migrations');
        // $appPath = database_path('migrations/' . $folder);

        foreach ($folders as $folder) {
            $appPath = $folder . '/' . $_folder . '/';

            if (! file_exists($appPath)) {
                mkdir($appPath, 0755, true);
            }

            $files = File::files($folder);

            foreach ($files as $file) {
                File::move($file->getPathname(), $appPath . '/' . $file->getFilename());
            }
        }
    }
}
