<?php

namespace App\Http\Controllers;
use App\Models\Movie;

use Illuminate\Http\Request;

//il nome della classe deve coincidere con il nome del file
class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallery = $this->getGallery();
        $movies = Movie::all();
        
        // return view('homeMovie');
        // come per il components posso passare array alla view
        // return view('homeMovie', ['pageTitle' => 'Nomepage']);

        $view_data = [
            'gallery' => $this->getGallery(),
            'dots' => true,
            'movies' => $movies,
        ];
        // qua sotto passo un array intero
        return view('homeMovie', $view_data);

        //modi diversi per passare dati
        /*
        $gallery = $this->getGallery();
        $dots = true;
        return view('homeMovie', compact('gallery', 'dots'));
        */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 'SELECT * FROM movies WHERE id = $id'; ::find restituisce un oggetto movie
        $movie = Movie::find($id);
        return view("singleMovie", compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function contacts()
    {
        return view('contacts');
    }

    private function getGallery(){
        return[
            [
                'title' => 'Slide 1',
                'url' => 'a-1.jpg'
            ],
            [
                'title' => 'Slide 2',
                'url' => 'a-2.jpg'
            ],
            [
                'title' => 'Slide 3',
                'url' => 'a-3.jpg'
            ],
            [
                'title' => 'Slide 4',
                'url' => 'a-4.jpg'
            ]
            ];
    }

    public function test ($a, $b, $c){
        echo $a.'<br>';
        echo $b.'<br>';
        echo $c.'<br>';
    }
}
