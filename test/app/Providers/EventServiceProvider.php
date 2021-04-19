<?php

namespace App\Providers;

use App\Events\UserDeleted;
use App\Events\UserUpdated;
use App\Listeners\UserDeletedListener;
use App\Listeners\UserUpdatedListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */

    protected $listen = [
        //seconda sintassi non retrocompatibile
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        //prima sintassi retrocompatibile
        // 'App\Events\UserUpdated' => [
        //     'App\Listeners\UserUpdatedListener'
        // ]
        UserUpdated::class => [
            UserUpdatedListener::class
        ],
        UserDeleted::class => [
            UserDeletedListener::class
        ],
        //con php artisan event:generate genera in automatico quello che c'è qua dentro 
        'App\Events\TouchLastLogin' => [
            'App\Listeners\TouchLastLoginListener',
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
