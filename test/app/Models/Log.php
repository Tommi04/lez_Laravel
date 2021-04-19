<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs';
    
    //campi che possiamo compilare in mass assignement. Quali campi spossiamo assegnare in massa
    //in questo caso siccome è escluso l'id non possiamo creare utenti in massa
    //ciò che non è qua dentro non possiamo crearlo con il metodo ::create, mentre con il metodo ::insert possiamo
    protected $fillable = [
        'message',
    ];
}
