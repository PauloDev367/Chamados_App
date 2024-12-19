<?php

namespace App\Providers;

use App\Services\SupportRequestService;
use Illuminate\Support\ServiceProvider;
use App\Repositories\SupportRequestRepository;
use App\Services\Ports\ISupportRequestService;
use App\Repositories\Ports\ISupportRequestRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ISupportRequestService::class, SupportRequestService::class);
        $this->app->bind(ISupportRequestRepository::class, SupportRequestRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
