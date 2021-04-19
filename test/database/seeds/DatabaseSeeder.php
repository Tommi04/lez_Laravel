<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        // chiamata alla classe con metodo statico
         $this->call(CategoriesTableSeeder::class);
         $this->call(MoviesTableSeeder::class);
         $this->call(HallsTableSeeder::class);
         $this->call(ShowsTableSeeder::class);
    }
}