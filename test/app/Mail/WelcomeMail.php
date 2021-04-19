<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $title;
    protected $content;
    protected $recipient_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $title="Titolo default", $content="Contenuto default", $recipient_name="recipient name")
    {
        $this->title = $title;
        $this->content = $content;
        $this->recipient_name = $recipient_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //
        $filename = "contratto-" . Str::slug($this->recipient_name) . '.pdf';
        // return $this->view('mail.simpleMailable', [ 
        //se vogliamo usare component e cose varie dentro la vista, dobbiamo cambiare view con markdown
        return $this->markdown('mail.simpleMailable', [
            'title' => $this->title,
            'content' => $this->content
        ])
        ->attachData(public_path('storage/docs/documento-di-testo.pdf'), $filename, [
            'mime' => 'application/pdf'
        ]);
    }
}
