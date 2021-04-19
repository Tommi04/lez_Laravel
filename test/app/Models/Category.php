<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    
    //campi che possiamo compilare in mass assignement. Quali campi spossiamo assegnare in massa
    //in questo caso siccome è escluso l'id non possiamo creare utenti in massa
    //ciò che non è qua dentro non possiamo crearlo con il metodo ::create, mentre con il metodo ::insert possiamo
    protected $fillable = [
        'name',
        'cat_code',
        'icon_path'
    ];

    //da laravel eloquent relationships
    //rappresenta una relazione con la tabella movie, da usare in AdminMoviesController
    public function movies(){
        //Più film appartengono ad una categoria 
        // return $this->hasMany('App\Models\Movie');
        //ho creato la tabella pivot tra categories e movies
        return $this->belongsToMany('App\Models\Movie', 'movies_categories', 'category_id', 'movie_id');
        // se non specificato laravel desume che la tabelle pivot si chiami category_movie
        // gli va specificato tramite parametri, 2 parametro è il nome della tabella, 
        // 3 parametro è la chiave esterna del modello corrente sulla tabella pivot,
        // 4 parametro il suo corrispettivo sulla tabella di arrivo
    }
}
