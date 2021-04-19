<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        //per cambiare il ritorno dell'error
        // if ($exception instanceof \MassAssignementException){
            //logica
        // }
/*
        if ($exception instanceof ModelNotFoundException){
            // return  redirect()->route('home');
            
            //possiamo sostituire la vista del nostro codice erre creando un file in views > errors > 404.blade.php
            //il codice d'errore ce lo troveremo in $exception->statusCode()
            //il messaggio personalizzato ce lo troveremo in $exception->getMessage()
            //con questo errore va a caricare la vista dalla cartella delle liste e gli inietta questo errore
            abort( 404, 'errore!!!!' );

            //possiamo anche scrivere abort con una respnose, 
            //manda indietro una risposta riscrivendo il codice di errore, non va nelle liste
            // abort(response('errore response', 404));

            // return redirect()->back()->withNotFound('film non esistente');
        }else if ($exception instanceof MethodNotAllowedException){
            echo 'sukaaaaaaaaaaaaaa';
        }
        */

        return parent::render($request, $exception);
    }
}
