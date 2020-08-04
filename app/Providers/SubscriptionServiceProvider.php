<?php


namespace App\Providers;


use App\Interfaces\SubscriptionService;
use App\Services\Subscriptions;
use Illuminate\Support\ServiceProvider;

class SubscriptionServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        app()->singleton(SubscriptionService::class, static function () {
            return new Subscriptions();
        });
    }
}
