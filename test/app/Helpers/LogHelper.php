<?php

namespace App\Helpers;

use App\Models\Log;

class LogHelper {

    //questa è la classe del log personalizzato e la richiamo richiamando LogHelper dal controller
    //non potrò usarla in autoload perchè non corrisponde con gli standard psr-4 autoloading perchè non è in Controller

    public static function addToLog($message){

        $log = [
            'message' => $message
        ];
        Log::create($log);
    }

}