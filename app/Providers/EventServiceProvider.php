<?php

namespace App\Providers;

use App\Events\ProductCreated;
use App\Listeners\ProductCreatedDownloadPhoto;
use App\Listeners\ProductCreatedEmailNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

/**
 * Registering listeners for ProductCreated Event in Laravel event processing.
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        ProductCreated::class => [
            ProductCreatedEmailNotification::class,
            ProductCreatedDownloadPhoto::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
