<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Test2 extends Notification
// class test extends Notification implements ShouldQueue // in questo modo gestisce le code
{
    use Queueable;
    
    protected $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message = 'Default message')
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
        // return ['mail', 'table', 'nexmo']; //in questo modo ci tornano più notifiche. multinotifica, multichannel
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    //ritorna new MailMessage 
    public function toMail($notifiable)
    {
        //prende come parametro una dot notation con una vista blade, dobbiamo crearla dentro resources > views la cartella mail
        //in questo modo ci creiamo noi la vista della mail, anche con i parametri
        return (new MailMessage)->markdown('mail.test2', ['message' => 'Messaggio']);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    public function preview(){
        //l'utente ci deve essere e non deve essere cancellato
        $user = User::find(52);
        return (new TestPreview())
            ->toMail($user);
    }
}
