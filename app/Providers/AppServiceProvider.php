<?php

namespace App\Providers;

use App\Repositories\TrafficLogRepository;
use App\Services\TrafficLogService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TrafficLogRepository::class, function ($app) {
            return new TrafficLogRepository();
        });

        $this->app->bind(TrafficLogService::class, function ($app) {
            return new TrafficLogService($app->make(TrafficLogRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
