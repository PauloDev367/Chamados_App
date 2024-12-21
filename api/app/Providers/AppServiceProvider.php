<?php

namespace App\Providers;

use App\Services\MessageService;
use App\Repositories\MessageRepository;
use App\Services\Ports\IMessageService;
use App\Services\SupportRequestService;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Ports\IMessageRepository;
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
        $this->app->bind(IMessageService::class, MessageService::class);
        $this->app->bind(IMessageRepository::class, MessageRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
