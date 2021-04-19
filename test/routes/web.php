<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//parte da qua quando viene chiamato dal web.
/* noi dobbiamo sostituirlo con ciò che ci interessa
Route::get('/', function () {
    return view('welcome');
});
*/

//dobbiamo richiamare un controller che si crea in APP/HTTP/CONTROLLERS aggiungendoci un file 

Route::get('/', 'WelcomeController@welcome'); 
//sto chiedendo la root del mio sito, la home, con '/'... è entrato nelle rotte nel routes poi gli sto dicendo che nelle
//views corrisponde il controlller WelcomeControlle al metodo welcome

// Route::get('/movies', 'MoviesController@index');
// Route::get('/movies/create', 'MoviesController@create'); //creare un film
// Route::get('/movies/edit', 'MoviesController@edit'); //pagina per modificare un film, sto prendendo la pagina di modifica

// Route::put('/movies/store', 'MoviesController@store'); //salvataggio del file. PUT = CREATE + UPDATE
// Route::patch('/movies/update', 'MoviesController@update'); //pagina per modificare un film, passare anche l'istanza e l'id
// Route::delete('/movies/destroy', 'MoviesController@destroy'); //cancellazione film

//questo lo ha aggiunto dopo il comando php artisan make:auth, rilanciamo php artisan route:list
//serve a gestire le autorizzazioni
Auth::routes();

Auth::routes([
    'verify'    => true, //attiva o disattiva rotte di verifica per l'autenticazione
    'register'  => true, //attiva o disattiva la registrazione   -  default => true
    'reset'     => true, //l'utente può resettare o meno la password   -  default => true
]);

Route::resource('movies', 'MoviesController'); 
//FA QUELLO CHE ABBIAMO FATTO SOPRA con il comando php artisan route:list
//potremo poi richiamare la rotta con
// Route('movies.index');
//possiamo dare noi il nome alla rotta senza che lo fa in automatico
// Route::get('/', 'WelcomeController@welcome')->name('tommaso');
// possiamo anche fare dei gruppi

//'/home' è l'url esposto nella barra degli indirizzi del browser. ->name è per assegnare l'alias.
Route::get('/home', 'HomeController@index')->name('home');
//possiamo configurare il middleware anche dal file di rotte
Route::get('/test', 'HomeController@test')->name('test')->middleware('auth'); //qui viene fatto il middleware
Route::get('/contact-us', 'MoviesController@contacts')->name('contact-us'); //qui viene fatto il middleware

// Route::resource('movies', 'Admin\AdminMoviesController');

//in questo modo qua sotto viene gestita la corrispondenza tra namespace e rotta nel namespace
//con prefix applico il prefisso della rotta del gruppo, non ha senso applicarlo su una rotta sola
Route::prefix('Admin')
    ->namespace('Admin')
    ->middleware('can:can-admin')
    ->name('admin.')
    ->group(function(){
    Route::resource('adminmovies', 'AdminMoviesController');
});

Route::prefix('Admin')
    ->namespace('Admin')
    ->middleware('can:can-admin')
    ->name('admin.')
    ->group(function(){
    Route::resource('adminusers', 'AdminUsersController')
        ->except([
        'create',
        'store'
    ]);
    Route::get('Admin/users/{user}/restore', 'AdminUsersController@restore')->name('adminusers.restore');
});


//rilanciare php artisan route:list, tutte le rotte verranno prefissate con quello definito dentro prefix
Auth::routes();

//in questo modo {parametro?} il parametro è opzionale
// Route::get('/entity/{id}/{name}/{filter?}', 'SiteController@test');


//un controller di prova
Route::get('/test', 'TestController@index');
Route::get('/sendmail', 'SendMail@index');
Route::get('/sendmailpreview', 'SendMail@preview');
// Route::get('/test', 'TestController@index')->miidleware('verified'); //applica l'accesso a questa rotta solo ad utenti verificati
//la pagina che controlla se l'utente è verificato o no e che consente il reinvio del link sta dentro
//views > auth > verifyblade.php
     //il middleware delle applicazioni è in app > http > kernel.php


//un controller di prova
Route::get('/file', 'FileController@index');

//slug è il parametro passato
Route::get('/single-category/{slug}', 'TestController@singleCat')->name('single-category');

Route::get('/profile', 'UsersController@profile')->name('profile');
Route::patch('/update-profile', 'UsersController@profileUpdate')->name('update-profile');

Route::delete('/delete-profile', 'UsersController@deleteProfile')->name('delete-profile');