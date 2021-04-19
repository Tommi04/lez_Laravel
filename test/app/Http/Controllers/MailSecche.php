<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailSecche extends Controller
{
    public  function index(){
        //inviare una mail secca

        // $body = '<h1>lorem ipsum</h1>';
        $title = 'lorem title';
        //NON USARE MAI $message PERCHE' LA USA GIA' LA FUNCTION
        Mail::send([
            //gli passo una vistas con dentro il body
            'text'=>'mail.simple', //, text è il maintype, simple è una vista
            'html'=>'mail.simple' //, html è il maintype, simple è una vista
        ], [
            'title'=>$title //passiamo alla vista simple in mail la variabile title
        ], function ($message) { //use ($body)
            $message
                ->to('tommaso.piccio95@gmail.com')
                ->subject('sono l\'oggetto della mail');
                //stringa e maintype. Avendo messo html posso mettere html nel primo parametro
                //->setBody($body, 'text/html'); //nel primo array gli ho messo una vista con dentro il body
        });
    }
}
