<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Str;

class TestWithAttachment extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!')

                    //per mettere un allegato usare attach(), 
                    //primo parametro path dell'allegato, 
                    //secondo parametro array di maintype con almeno ['main'=>'application/pdf']
                    //Nell'array si può passare anche ['as'=>'contratto-' . Str::slug($notifiable->name) . '.pdf] che riscrive il nome dell'allegato
                    //per prendere il path in asset usare asset(); per quello in public usare public_path
                    ->attach(public_path('storage/docs/documento-di-testo.pdf', ['main'=>'applicatione/pdf', 'as'=>'Contratto' . Str::slug($notifiable->name) . '.pdf']));
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
