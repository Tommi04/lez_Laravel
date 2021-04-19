<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\UserUpdatedNotification;
use App\Notifications\UserDeletedNotification;
use Illuminate\Support\Facades\Mail;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        //
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\Model\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        // dd($user);

        //potremmo mandare una mail all'utente per dirgli che c'è stata una modifica al profilo
        // $user->notify(new UserUpdatedNotification());
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\Model\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //potremmo mandare una mail all'utente per dirgli che c'è stata una modifica al profilo
        // $user->notify(new UserDeletedNotification());
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\Model\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\Model\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}