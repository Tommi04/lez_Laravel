<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    protected $table = 'halls';
    
    //campi che possiamo compilare in mass assignement. Quali campi spossiamo assegnare in massa
    //in questo caso siccome è escluso l'id non possiamo creare utenti in massa
    protected $fillable = [
        'name',
        'halls_code',
        'seats'
    ];

    //in una hall ha n shows
    public function shows(){
        return $this->hasMany('App\Models\Show');
    }
}