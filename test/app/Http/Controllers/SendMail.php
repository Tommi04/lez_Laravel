<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\Test;
use App\Notifications\Test2;
use App\Notifications\TestPreview;
use App\Notifications\TestWithAttachment;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;

class SendMail extends Controller
{
    public function index(){
        $user = User::find(51);
        //in questo modo è senza niente
        // $user->notify(new Test);

        //in questo modo gli passo un messaggio al costruttore, ma devo andarlo a creare
        // $message = 'io sono il tuo messaggi personalizzato';
        // $user->notify(new Test($message) );

        // $user->notify(new Test2);

        // usando le notification. Per fare notifiche al volo
        //quando usiamo una notification abbiamo il parametro via($notifiable) nel modello che torna mail
        // Notification::send($user, new Test('Messaggio custom', 'bottone custom') );

        //altro metodo per le notification. route non è la rotta del web ma la rotta di notifica
        //primo parametro il canale, il secondo parametro la rotta associata al canale a cui va associata una classe notification
        // Notification::route('mail', 'tommaso.piccio95@gmail.com'->notify(new Test) )

        $user->notify(new TestWithAttachment);

        dd('fine');
    }
    
    public function preview(){
        $user = User::find(52);
        return (new TestPreview())
            ->toMail($user);
    }
}
