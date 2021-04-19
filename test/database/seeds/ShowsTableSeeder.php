<?php

use Illuminate\Database\Seeder;
use App\Models\Movie;
use App\Models\Hall;
use App\Models\Show;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class ShowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //se non mettiamo condizioni dobbiamo passare la forma ::all()
        $movies = Movie::all();
        $halls = Hall::get()->pluck('id')->toArray();
        $shows = [];
        $now = Carbon::now();
        $show_counter = 1;
        $faker = Faker\Factory::create();
        
        // print '<pre>';
        // print_r($now);
        // print '</pre>';
        // dd($now);

        // $now2 = date('Y-n-d H:i:s');
        // print '<pre>';
        // var_dump($now);
        // print_r($now);
        // print '</pre>';
        // dd($now);
        
        //definendo le date in questo modo,come stringhe, non si può ciclare sulle date come si può fare con Carbon
        $startDate = '2020-03-02 00:00:00';
        $endDate = '2020-03-09 23:59:59';

        //definendo le date con Carbon si può ciclare sulle date, altrimenti sarebbero semplici stringhe
        $startDate = Carbon::create( 2020, 3, 2, 0, 0, 0, 'Europe/Rome');
        $endDate = Carbon::create( 2020, 3, 2, 23, 59, 59, 'Europe/Rome');
        //oppure dalla stringa
        // $startDate = Carbon::parse('2020-03-02 00:00:00');
        // $startDate = Carbon::parse('2020-03-09 23:59:59');

        // print '<pre>';
        // var_dump($start_date);
        // print_r($start_date);
        // print '</pre>';
        // dd($start_date);

        //lte = less than equal
        for($date = $startDate; $date->lte($endDate); $date->addDay()){
            foreach ($movies as $m => $movie){
                //setTime(ore, minuti, secondi) sposta l'orario
                $dayStart = $date->copy()->setTime( 17, 30, 0);
                $dayEnd = $date->copy()->setTime(22, 0, 0);

                //strtotime è di php e trasforma in secondi, va diviso per trovare minuti
                // $max_shows = strtotime($dayEnd) - ($dayStart);

                //Carbon ha tutto.
                //con ceil in php arrotondiamo in eccesso, con floor in difetto
                $max_shows = ceil($dayEnd->diffInMinutes($dayStart) / $movie->duration);

                for ($i=0; $i < $max_shows; $i++) { 

                    
                    //setTime(ore, minuti, secondi) sposta in avanti l'orario
                    // $movieStart = $date->copy()->setTime( 17, 30, 0);
                    // $movieEnd = $movieStart->copy()->addMinutes($movie->duration); //posso farlo con duration perchè 
                    //ho la durata codificata in minuti
                    
                    $movieStart = $dayStart->copy()->addMinute($i * $movie->duration);
                    $movieEnd = $movieStart->copy()->addMinute($movie->duration);
                    
                    $random_hall = $this->extractRandomHall($halls, $movieStart, $movieEnd);
                    
                    $shows[] = [
                        'shows_code'    => 'S' . $show_counter,
                        'price'         => $faker->randomElement([5, 7.50, 10.00, 12.00 ]),
                        // 'start'         => $date, //sarà sempre l'ultima data perchè la mette come referenza
                                                 //quindi esce dai cicli e siccome l'oggetto date sposta il giorno in avanti
                                                 //mi ritroverò tutti i movie con l'ultima data
                        'start'         => $movieStart, //stessa data per i 4 movie, faccio una copia di date
                                                 //e non uso più la referenza all'oggetto date
                        'end'           => $movieEnd,
                        'movie_id'      => $movie->id,
                        'hall_id'       => $random_hall,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                    $show_counter++;
                }
            }
        }
        Show::insert($shows);
    }

    private function extractRandomHall($halls, $start, $end ){
        $halls = Hall::get()->pluck('id')->toArray();
        $found = false;
        $hall_id = 0;
        $cycle_break = 10;

        while (!$found && $cycle_break > 0) { //fintanto che $found === false
            $random_hall_id = Arr::random($halls, 1)[0];
            $hall_empty = true;
 
            //cotrollo che la sala sia libera
            // SELECT * FROM `shows` WHERE
                // hall_id = 10 AND 
                // ((start >= '2020-03-02 17:30:00' AND start <= '2020-03-02 19:00:00') OR
                //  (end >= '2020-03-02 17:30:00' AND end <= '2020-03-02 19:00:00'))
                //ogno -> è un AND. Per fare OR serve ->or

            $hall_empty = Show::where('hall_id', $random_hall_id)
                            ->where(function ($query) use($start, $end){ //annido una query all'interno della where
                                $query
                                //dobbiamo avere accesso alle variabili esterne alla funzinoe annidiata
                                //per questo usiamo use($start, $end), per dirgli di prendere le variabili da fuori
                                ->whereBetween('start',[$start, $end])
                                ->orwhereBetween('end',[$start, $end]);
                                }
                            )
                            ->get();
                            //->checkEmpty(); //torna true o false

            //avremo una collection di oggetti che per empty non sarà mai completamente vuota
            // dd(empty($hall_empty));
            //per count si
            // dd($hall_empty->count());

            if ($hall_empty->isEmpty()) {
                //se è libera
                //found diventa true
                $found = true;

                //hall_id diventa random_hall
                $hall_id = $random_hall_id ;

                //ritorna l'id della sala
            }

            $cycle_break--;
        }

        return $hall_id;
    }
}
