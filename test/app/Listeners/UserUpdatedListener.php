<?php

namespace App\Listeners;

use App\Events\UserUpdated;
use App\Models\User;
use App\Notifications\UserUpdatedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserUpdatedListener
{
    public $user;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    //ottimizziamo l'evento tipizzandolo
    public function handle(UserUpdated $event)
    {
        // dd($event->user);
        // $event->user->notify(new UserUpdatedNotification());
    }
}
