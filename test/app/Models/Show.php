<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    protected $table = 'shows';
    
    //campi che possiamo compilare in mass assignement. Quali campi spossiamo assegnare in massa
    //in questo caso siccome è escluso l'id non possiamo creare utenti in massa
    protected $fillable = [
        'shows_code',
        'price',
        'start',
        'end',
        'movie_id',
        'hall_id'
    ];

    //lo show dipende direttamente da movie e hall. questo è a tutti gli effetti un join
    public function movie(){
        return $this->belongsTo('App\Models\Movie');
    }
    public function hall(){
        return $this->belongsTo('App\Models\Hall');
    }
}