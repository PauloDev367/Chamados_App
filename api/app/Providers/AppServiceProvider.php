<?php

namespace App\Providers;

use App\Services\SupportRequestService;
use Illuminate\Support\ServiceProvider;
use App\Services\Ports\ISupportRequestService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ISupportRequestService::class, SupportRequestService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
