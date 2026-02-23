<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Instructor;
use App\Policies\InstructorPolicy;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    protected $policies = [
        Instructor::class => InstructorPolicy::class
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading(! app()->isProduction());
        Carbon::setLocale(config('app.locale')); // usa o locale do Laravel
        date_default_timezone_set(config('app.timezone'));
    }
}
