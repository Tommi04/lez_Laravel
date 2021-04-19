<?php

use Illuminate\Database\Seeder;
use App\Models\Hall;
use Carbon\Carbon;

class HallsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $halls = [];
        $faker = Faker\Factory::create();
        $now = Carbon::now();

        for ($i=1; $i <= 10; $i++) { 
            $halls[] = [
                'name' => 'Sala' . $i,
                'halls_code' => 'S'.$i,
                'seats' => $faker->numberBetween(100, 250),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        Hall::insert($halls);
    }
}
