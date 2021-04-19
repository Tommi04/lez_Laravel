<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMovieRequest extends FormRequest
{

    //in questo modo torniamoa alla home
    // protected $redirect = '/';

    //in questo modo lo ridirigiamo ad una rotta
    // protected $redirectRoute = 'login';
    
    //anche questo per redirigere, l'ultima colonna della route:list... inutile
    // protected $redirectAction = "Auth\LoginController@showLoginForm";

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return false; //se non lo metto a true il sito non funzionerà ma darà unauthorized
        return true; //in questo modo questa form request è autorizzata e validerà tramite le rules
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // laravel prende queste stringhe, le esplode per pipe, crea un array ed una funzione da eseguire per ogni elemento
            //possiamo passargli il validatore direttamente come array, senza pipe ma con 'regola', 'regola1', 'regola2'
            'name'          => 'bail|required|max:255', //bail dovrebbe andare in errore al primo errore trovato, max:255 per dirgli o il valore massimo
            'film_code'     => 'required|max:100|unique:laravel_movies,film_code', //per unique dobbiamo dirgli:sulla tabella movies alla colonna code
            'duration'      => 'required|numeric', //per testare che sia numerico
            // 'cover_path'    => 'required|max:255',

            //creo una regola per i file. min-max è per la dimensione. I mimes o mimetypes(image/) sono le estensioni dei file
            // 'cover_path'    => 'required|file|min:300|max:2048|mimes:png,gif,jpg,jpeg', 

            //abbiamo anche il validatore per le sole immagini. Possiamo anche dargli dimensioni in pixel e ratio che è la proporzione
            'cover_path'    => 'required|image|mimes:jpeg,jpg,png',
            // 'cover_path'    => 'required|image|max:2048|dimensions:min_width=300,min_height= 600,ratio=1/3', //esempio
            // 'cover_path'    => 'required',
                                //   'image',
                                //   'max:2048',
                                //   'dimensions:min_width=300,min_height= 600,ratio=1/3', 
                //uguale

            // 'category_id'   => 'required|numeric|exists:categories,id' //esistente tra l'id della tabella categorie
            //da quando ho cambiato e creato la tabella pivot tra categories e movies
            'categories'    => 'required|array|min:1',

            //questa è una partiva iva ad esempio
            // 'piva'          => 'required|size:11',
        ];
    }

    //l'ho messa io
    public function messages(){

        return [
            'required' => 'The :attribute field is required!!!!!!!',
        ];
    }
}
