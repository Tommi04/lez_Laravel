<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\LogHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Show;
use App\Models\Category;
use App\Http\Requests\CreateMovieRequest;
use App\Http\Requests\EditMovieRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator; //facades, Laravel prevede che ci siano delle classi delegate a fare sotto funzionalità di classi più ampie
use Illuminate\Support\Facades\Exceptions; //facades, Laravel prevede che ci siano delle classi delegate a fare sotto funzionalità di classi più ampie
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

//noi non arriveremo a tutti i metodi di Laravel, ma li richiameremo tramite le faceadd che espongono dei metodi
                // use Illuminate\Validation\Validator; questa è tutta la classe

class AdminMoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*messo il controllo  con il gate nella rotta
        if (Gate::allows('can-admin')){
            $movies = Movie::withCount('categories')->get();
            return view('admin.movies.list', compact('movies'));
        }else{
            abort(401);
        }
        */



        //ho aggiunto la classe in use sopra
        //all funziona quando non c'è nessuna cosa nella query
        // $movies = Movie::all();

        //get per selezionare qualcosa dalla query
       // $movies = Movie::with('categories')->get(); //un modo per tornare le category poi in list.blade.php le contiamo
        
        //altro modo per tornare le category e contarle. 
        //Le conta e le mette in una proprietà chiamate categories_count (nome della relationship splitatto con "_" se ci sono più parole con _count)

        $movies = Movie::withCount('categories')->get();

        //tutti i film che si chiamano Frozen
        // $movies = Movie::where('name', 'Frozen')->get();

        /*
        echo '<pre>';
        print_r($movies);
        echo '<\pre>';
        */
        //questo è un metodo migliore di questo sopra per stampare le cose. Dump&die
        // dd($movies);

        return view('admin.movies.list', compact('movies'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        App::setlocale('it');

        $categories = Category::all();


        //estrae id e name (chiave e valore) da categories stessa cosa che fa sotto il foreach.
        //ma siccome estrae prima il valore poi la chiave dobbiamo mettere gli indici al contrario
        // $categories_select_test =  $categories->pluck('name', 'id'); 
        // dd($categories_select_test)


        $categories_select = [];
        //con la tabella pivot categories_movies
        $categories_select =  $categories->pluck('name','id');
        //la passo a create.blade.php
        foreach ($categories as $c => $category) {
            $categories_select[$category->id] = $category->name; 
        }
        return view('admin.movies.create', compact('categories_select'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //store può essere chiamato solo in POST come da php artisan route:list
    public function store(Request $request)
    // public function store(CreateMovieRequest $request)
    {
        App::setlocale('it');
    //   dd($request->all('cover_path'));
     // non lo fare mai questo sopra, rischi di bloccare l'app
    //  dd($request);   

    //per vedere i file
    // dd($_FILES);

    // dd($request->hasFile('cover_path'));

    //possiamo creare ciò anche attraverso una request (php artisan make:request nomeRequest)
    //e sostituire questo qua sotto con un parametro aggiuntivo alla funzione
    //dovremo poi includerlo con use App\Http\Requests\CreateMovieRequest;
    
    $rules = [
            'name'          => 'bail|required|max:255', //bail dovrebbe andare in errore al primo errore trovato, max:255 per dirgli o il valore massimo
            'film_code'     => 'required|max:100|unique:laravel_movies,film_code', //per unique dobbiamo dirgli:sulla tabella movies alla colonna code
            'duration'      => 'required|numeric', //per testare che sia numerico
            'cover_path'    => 'required|mimes:jpeg,png,jpg,gif,svg',
            // 'cover_path'    => 'required|image|mimes:jpeg,png,jpg,gif,svg', //con file jpg il validatore image non funziona
            'categories'    => 'required|array|min:1',
    ];
    

    //sovrascrivo la proprietà validationmessages per fare uscire l'errore che voglio per i campi sbagliati
    //si può mettere anche questo attraverso la request
    
    $validationMessages = [
        'required' => 'The :attribute field is required!!!!!!!',
    ];
    

    //ci sono tutta una serie di validatori in laravel.
    //con questo metodo se va in errore torna indietro nella pagina
    //invece di farlo così
    // $validatedData = $request->validate([
    //     'name'          => 'bail|required|max:255', //bail dovrebbe andare in errore al primo errore trovato, max:255 per dirgli o il valore massimo
    //     'film_code'     => 'required|max:100|unique:laravel_movies,film_code', //per unique dobbiamo dirgli:sulla tabella movies alla colonna code
    //     'duration'      => 'required|numeric', //per testare che sia numerico
    //     'cover_path'    => 'required|max:255',
    // ]);
    //posso fare così e passargli altri parametri, metodo validate su una $request con array di rules e messaggi
    $validatedData = $request->validate($rules, $validationMessages);
    
    //qua sotto un altro metodo con la classe Validator. Aggiungere l'import della classe Validator in alto
    
    /* si può fare solo con il CreateMovieRequest
    $validator = Validator::make($request->all(), $request->rules(), $request->messages() );
    //ma Validator ci fa perdere il redirect
    
    
    //Validator esponde una serie di metodi e funzionalità con fails, passes
    if ($validator->fails()){
        return redirect()
        ->route('admin.adminmovies.create') //vai alla rotta create
        // ->back() //per tornare alla rotta precedente
        ->withErrors($validator) //con questi errori
        ->withInput();          //
    }
    */
    
    // dd('sono in try');
    $insert_data = $request->except(['_token', 'categories', 'cover_path']);

    //per prendere la roba in POST con ->get o con ->input. Ma non per i file
    $categories = $request->get('categories'); //prendo solo l'array delle categorie della request
    // dd($categories);
    try{

        $insert_data['cover_path'] = '';
        $insert_data['cover_filename'] = '';

        // $new_movie = Movie::create($validatedData);
        // $new_movie = Movie::create($validator->validate());
        $new_movie = Movie::create($insert_data); //prende il movie
        // dd($new_movie);

        //testa se presente il file
        if($request->hasFile('cover_path')){

            //estraggo il file, non vale nè ->get nè ->input. Solo ->file
            $file = $request->file('cover_path');

            //per riscrivere il nome del file
            $filename = time() . '.' . $file->getClientOriginalExtension() ;
            
            //carico il file
            $uploaded_file = $file->storeAs('movies/'. $new_movie->id . '/thumbs', $filename, 'public');

            // dd($uploaded_file);

            $new_movie->cover_path = $uploaded_file;
            $new_movie->cover_filename = $filename;
            
            $new_movie->save(); //salva il movie dopo averlo valorizzato
        }


        // potrei fare questo sotto ma laravel ci da dei metodi manyToMany da applicare alla relazione che sono migliori
        // foreach ($categories as $c => $category) {
            // query che inserisca in movies_categories la coppia $new_movie->id, $category
        // }
        //prendi il movie, prendi la funzione che genera la proprieta (la relationship nel modello Movie ed esegui il metodo)
        // $new_movie->categories()->add($categories);
        $new_movie->categories()->sync($categories); //delete di vecchi e add di nuovi
        // $new_movie->categories()->delete($categories);
        
        session()->flash( 'message', __('labels.create_form.create_movie_form_success', ['Default' => 'Defaule']));
        return redirect()->route('admin.adminmovies.index');  //ridirigiamo alla rotta, saltiamo alla rotta
    }catch(\Exceptions $e){
        // if ( !$new_movie ) { //$new_movie = false || $new_movie = null
            $errors = [
                'error_code' => 'Qualcosa',
                'error_message' => 'Qualcos altro',
                'details' => $e->getMessage(),
                // 'exception' => $e, // inutile
                //per cambiare il ritorno dell'error andare a mettere mano a app>Exceptions>Handler.php 
            ];
            //mettere qualcosa in sessione
            session()->flash( 'message', $errors);
            // session()->flash( 'new-movie-error', 'Non è stato possibile creare il film. Riprova o contatta l\'amministratore');
            // return redirect()->route('movies.create'); //ho rediretto l'utente alla pagina di create dove gestisco l'errore $errors
            // }else{
                // session()->flash( 'new-movie-success', __('labels.create_form.create_movie_form_succes', 'Default'));
                // redirect()->route('movies.index');  //ridirigiamo alla rotta, saltiamo alla rotta
                // }
                return redirect()->route('admin.adminmovies.index');  //ridirigiamo alla rotta, saltiamo alla rotta
            };
            

    // dd($new_movie);

    /*
    //un metodo per vedere la $request
    dd($request->capture());
    
    //un altro metodo
    dd($request->all());

    //per prendere un solo campo
    dd($request->get('name'));

    //per prendere un array
    dd($request->only(['name', 'code']));
    
    //per escludere dei campi
    dd($request->except(['name', 'code']));
    */

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        App::setlocale('it');
        //

        //con la relazione al film in Category grazie a laravel eloquent relationships
        // $category = Category::with('movies')->findOrFail(5);
        //se più film hanno la stessa categoria ci torneranno due movie dentro la tabella category
        // dd($category);

        //ma se per ogni dato facciamo una select non finiamo più ed è pesante
        // $movie = Movie::findOrFail($id);
        // $category = Category::where('id', $movie->category_id)->first();
        //dobbiamo fare una collection con eloquent relationships

        //con laravel eloquent relationships possiamo usare ::with per chiamare le relationship
        // $movie = Movie::with('category')->findOrFail($id);
        $movie = Movie::findOrFail($id);
        //il valore è un array sia con movie che con category

        //per gli shows con la relationship category
        // $shows = Show::with([
            // 'hall', //gli show in relazione con la hall che è in join con il movie
            // 'movie.category.movies', //il movie in join con la categoria che è in join con tutti i movie che ha
        // ])->get(); //dove l'inizio è minore di adesso
        // ])->where(['start', '<', now()])->get(); //dove l'inizio è minore di adesso
        // dd($shows);
        //crea tutte collection

        //facciamo logging
        //emergency è il peggior segnale possibile
        /*
        Log::emergency('Log:emergency');
        Log::alert('Log:alert');
        Log::critical('Log:critical');
        Log::error('Log:error');
        Log::warning('Log:warning');
        Log::notice('Log:notice');
        Log::info('Log:info');
        */

        //per usare un log che abbiamo creato personalizzato in logging.php
        /* Log::channel('custom')->error('Messaggio di errore custom'); */

        //per usare un helper senza dover per forza fare un log, dopo avere creato l'helper
        LogHelper::addToLog('Messaggio di log helper');
        //avendolo messo in autoload dentro app.php posso chiamarlo così. In teoria, in pratica non gl piace
        // LHelper::addToLog('Messaggio di log helper');

        // return view('admin.movies.details', compact('movie','category')); //con 2 SELECT
        return view('admin.movies.details', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        App::setlocale('it');
        // 'SELECT * FROM movies WHERE id = $id'; ::find restituisce un oggetto movie
        /*  $movie = Movie::find($id);
            if ($movie){
                return view('admin.movies.edit ', compact('movie'));
            }else{
                echo 'film non presente nella base dati.';
            }
            */

            $categories = Category::all();
            
            //mi estraggo ciò che mi arriva in una variabile
            // $input_request = $request->all();

            //findOrFail fallisce in caso che non trova il movie con l'id. Ma fallisce e va in errore il sito,
            //non ci torna indietro, ci porta in un unica pagina che è difficile personalizzare
            //with è un join con le categories
            $movie = Movie::with('categories')->findOrFail($id);
            //qua sotto usando laravel collective gli passo un form generico tipo questo qua sotto
            $form_config = ['route' => ['admin.adminmovies.update', $movie->id], 'method' => 'patch'];

            return view('admin.movies.edit ', compact('movie', 'form_config', 'categories'));
        }
        
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditMovieRequest $request, $id)
    {   
        App::setlocale('it');
        
        //mi estraggo ciò che mi arriva in una variabile
        $input_request = $request->all();

        /*
        // UNO DEI TANTI METODI
        $data = [
            'name' => strtoupper($input_request['name']),
            'duration' => ($input_request['duration']),
            'cover_path' => ($input_request['cover_path']),
        ];
        
        // $updated = Movie::where('id', $id)->update($request->except('_token', '_method'));
        // $updated = Movie::where('id', $id)->update($request->only('name'));
        $updated = Movie::where('id', $id)->update($data);
        //in questo caso updated ritorna il numero di righe
        if (!$updated){ //se non ci sono affected rows torna 0 quindi false
            //errore
        }else{
            //successo
        };

        if ($updated > 0){
            //successo
        }else{
            //errore
        };

        if ($updated === count($movies)){
            //successo
        }else{
            //errore
        };
        */
        

        $movie = Movie::find($id);
        if ($movie){

            $movie->name = strtoupper($input_request['name']);
            $movie->duration = $input_request['duration'];
            $movie->cover_path = $input_request['cover_path'];
            $updated = $movie->save();
            //in questo caso updated ritorna true o false
            
            if ($updated){
                $movie->categories()->syncWithoutDetaching($input_request['categories']);

                session()->flash('message', __('labels.edit_form.edit_movie_form_success'));
                return redirect()->route('admin.adminmovies.index');
            }else{
                session()->flash('message', __('labels.edit_form.edit_movie_form_error'));
                return redirect()->route('admin.adminmovies.index');
            }
        }else{
            session()->flash('message', __('labels.edit_form.edit_movie_not_found'));
            return redirect()->route('admin.adminmovies.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        App::setlocale('it');
        //primo metodo
        // $deleted = Movie::where('id', $id)->delete();
        //torna il numero di righe

        //secondo metodo
        $movie = Movie::find($id);
        //torna true
        if ($movie){
            $deleted = $movie->delete();
            //torna true o false
            //con softdelete() valorizza una colonna con deleted_at invece che eliminare davvero il film
        };
        
        if ($deleted){
            session()->flash('message', __('labels.movies.delete_success'));
            return redirect()->route('admin.adminmovies.index');
        }else{
            session()->flash('message', __('labels.movies.delete_error'));
            return redirect()->route('admin.adminmovies.index');
        }
        // dd($deleted);
        
    }
}
