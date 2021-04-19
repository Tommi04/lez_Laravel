<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'laravel_movies';
    
    //campi che possiamo compilare in mass assignement. Quali campi spossiamo assegnare in massa
    //in questo caso siccome è escluso l'id non possiamo creare utenti in massa
    protected $fillable = [
        'name',
        'film_code',
        'short_description',
        'long_description',
        'duration',
        'trailer_mp4',
        'trailer_ogv',
        'trailer_webm',
        'cover_path',
        'category_id',
        'cover_filename'
    ];

    //nome dell'attribute = set+Nomeattributo+Attribute
    //scatta sempre questa funzione ogni volta che viene chiamata la classe
    public function setNameAttribute($value){
        //per accedere agli attributi usiamo attributes
        //ucfirst è per mettere la prima lettera MAIUSCOLA (uppercasefirst)
        $this->attributes['name'] = ucfirst($value);
    }
    
    //da laravel eloquent relationships
    //rappresenta una relazione con la tabella category, da usare in AdminMoviesController
    public function categories(){
        //una categoria tiene più film
        // return $this->belongsTo('App\Models\Category');
        //ho creato la tabella pivot tra categories e movies
        return $this->belongsToMany('App\Models\Category', 'movies_categories', 'movie_id', 'category_id');
        // se non specificato laravel desume che la tabelle pivot si chiami category_movie
        // gli va specificato tramite parametri, 2 parametro è il nome della tabella, 
        // 3 parametro è la chiave esterna del modello corrente sulla tabella pivot,
        // 4 parametro il suo corrispettivo sulla tabella di arrivo
    }
    
    //un movie ha n shows
    public function shows(){
        return $this->hasMany('App\Models\Show');
    }
}