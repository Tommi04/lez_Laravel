<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

use App\Models\Category;
use App\Models\Movie;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        //prendo tutte le categorie
        //con il get()->toArray() prendo tutte le categories e le trasformo in array. Collection to Array
        // $categories = Category::get()->toArray();
        // per tirare fuori solo gli id
        $categories = Category::get()->pluck('id')->toArray();
        
        // dd($categories); //funziona anche a console e ci mostra il dd a console
        
        $movie = [];
        for ($i=1; $i < 4; $i++) { 
            $movie_code = 'M';
            //quale parametro per il padding, quante posizioni deve avere, con quale stringa deve fare padding, direzione
            $code_padded = str_pad($i, 4, '0', STR_PAD_LEFT);
            
            //faker è una libreria esterna per creare dati finti. In laravael è già importato
            $faker = Faker\Factory::create();
            

            $movie = [
                'name' => 'Movie' . $i,
                'film_code' => $movie_code . $code_padded,
                'duration' => $faker->numberBetween(80, 240),
                //imageUrl($width, $height, classe) faker online cerca
                'cover_path' => $faker->imageUrl(500, 1000, 'abstract'), //quando l'hai metti movies/default.jpg
                'cover_filename' => $faker->imageUrl(500, 1000, 'abstract'),
            ];

            // non userò il DB:table()
            $new_movie = Movie::create($movie);
            // echo 'movie created: ' . $new_movie['id'] .'\n';

            $movie_categories = [];

            /* userò Arr::random()
            for ($cc=0; $cc < 2; $cc++) { 
                $index = array_rand($categories);
                if (!in_array($categories[$index]['id'], $movie_categories)){
                    $movie_categories[] =  $categories[$index]['id'];
                }
            };
            */
   
            //uso il random()->pluck()
            $movie_categories = Arr::random($categories, 2);

            // $new_movie->categories()->sync($movie_categories);
            // per le performance è meglio ->attach()
            $new_movie->categories()->attach($movie_categories);
            
        };

        // da usare quando non ho il Movie::create()
        // DB::table('laravel_movies')->insert($movie);
    }

    private function getCategories(){
        return [

        ];
    }
}
