<?php

namespace App\Listeners;

use App\Events\TouchLastLogin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TouchLastLoginListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TouchLastLogin  $event
     * @return void
     */
    public function handle(TouchLastLogin $event)
    {
        //passo per il db, query sul db. Non genera l'evento dispatch perchè non passo per il modello
        User::where('id', $event->user_id)->update(['last_login' => Carbon::now()]);

        //passo per eloquent, lavoro sul modello. Fa il dispatch dell'evento, stiamo toccando il modello
        // $event->user->update(['last_login' => Carbon::now()]);
    }
}
