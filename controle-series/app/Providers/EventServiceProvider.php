<?php

namespace App\Providers;

use App\Events\SeriesCreated as SeriesCreatedEvent;
use App\Events\SeriesDeleted as SeriesDeletedEvent;
use App\Listeners\EmailUserAboutSeriesCreated;
use App\Listeners\EmailUserAboutSeriesDeleted;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        SeriesCreatedEvent::class => [
            EmailUserAboutSeriesCreated::class,
        ],

        SeriesDeletedEvent::class => [
            EmailUserAboutSeriesDeleted::class
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
