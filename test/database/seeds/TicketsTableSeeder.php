<?php

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Show;
use App\Models\Ticket;

class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $users = User::where('email_verified_at', '<>', null ) -> get();
        $shows = Show::get();
        $tickets_count = 1;

        foreach ($users as $u => $user) {
            $how_many = $faker->numberBetween(0, floor($shows->count() / 3));
            if($how_many > 0){
                $random_shows = $shows->random($how_many);
                $insert = [];
                foreach ($random_shows as $rs => $random_show) {
                    $insert[] = new TIcket([
                        'show_id' => $random_show->id,
                        'code' => 'T' . $tickets_count,
                    ]);
                    $tickets_count++;
                }
                $user->tickets()->saveMany($insert);

            }
        }

        
        Ticket::insert($insert);
    }
}
