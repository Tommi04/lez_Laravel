<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Test extends Notification
// class test extends Notification implements ShouldQueue // in questo modo gestisce le code
{
    use Queueable;
    
    protected $message;
    protected $action_test;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message = 'Default message', $action_test = "Default Action Test")
    {
        $this->message = $message;
        $this->action_test = $action_test;
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
        return (new MailMessage)
                    
                    //line è un blocco di testo, possiamo averne più di una
                    //tutto ciò che è prima di action viene stampato a ciclo nelle introline
                    ->line('The introduction to the notification.')
                    
                    //c'è ad esempio error() che fa cambiare la cromia della mail, se è una mail di errore, di conferma, generica
                    ->error()

                    //c'è ad esempio
                    ->greeting('CIAOO!')

                    //prende 2 parametri label e url, genera un bottone
                    //se esiste una chiamata al metodo action vengono stampate delle action, bottoni
                    //si può mettere più di un actiona andando ad hackerare i template ma è meglio evitare
                    // ->action('Notification Action', url('/'))
                    ->action($this->action_test, url('/'))
                    
                    //altra line, possiamo averne più di una
                    //viene stampato in outroline
                    ->line('Thank you for using our application!');
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
}
