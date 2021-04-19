<?php


namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    protected $table = 'user_details';
    
    //campi che possiamo compilare in mass assignement. Quali campi spossiamo assegnare in massa
    //in questo caso siccome è escluso l'id non possiamo creare utenti in massa
    //ciò che non è qua dentro non possiamo crearlo con il metodo ::create, mentre con il metodo ::insert possiamo
    protected $fillable = [
        'user_id',
        'gender',
        'birth_date',
        'newsletter',
    ];

    //accessor. Modifica il ritorno degli attributi
    //get iniziale e Attirbute finale e in mezzo l'attributo di cui vogliamo modificare il getter in camel case
    public function getNewsletterAttribute($value){
        // return 'A';

        // return $this->newsletter ? 'SI' : 'NO';
        //$this->newsletter glielo passo con $value
        return $value ? 'SI' : 'NO';
    }
    //altrimenti sotto in $this->birth_date abbiamo 'B'
    // public function getBirthdateAttribute(){
    //     return 'B';
    // }
    public function getAgeAttribute(){
        return Carbon::parse($this->birth_date)->diffInYears(Carbon::now());
        return Carbon::parse($this->birth_date)->age; //calcola l'età
        return Carbon::parse($this->birth_date) //calcolare l'età per giorno
                ->diff(Carbon::now())
                ->format('%y anni %m mesi %d giorni');
    }

    public function user(){
        //relazione inversa su user
        return $this->belongsTo('App\Models\User');
    }
}
