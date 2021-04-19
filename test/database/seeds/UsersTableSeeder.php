<?php

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->createAdmin();
        
        $faker = Faker\Factory::create('it_IT');    

        $user_role = Role::where('code', 'user')->first();
        for ($i=0; $i < 50; $i++) { 
            
            $user_name = $faker->name;
            $user_email = strtolower($user_name . '@example.com');

            $user_data = [
                'name'              => $user_name,
                'email'             => $faker->unique()->safeEmail,
                'email_verified_at' => $faker->randomElement([now(), null]),
                'password'          => Hash::make('password'),// invece di '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token'    => Str::random(10),
                'role'              => $user_role->id,
                // 'role'              => 'u',
                'last_login'        => $faker->randomElement([Carbon::parse($faker->dateTimeBetween( '-2 years', 'now' ))->format('Y-m-d'), null]),
                // 'deleted_at'        => $faker->randomElement(([now(), null])),
                'deleted_at'        => null,
                //Str, Arr, app sono classi di helper
            ];
            $new_user = User::create($user_data);

            //il secondo metodo prevede non di usare un array $user_details ma un oggetto
            // $user_details = [
            $user_details = new UserDetails([
                //primo metodo mettiamo user_id ma dobbiamo usare l'array $user_details
                // 'user_id'       => $new_user->id,
                //differenza tra randomElement(tira fuori 1 array) e randomElements(tira fuori più array)
                'gender'        => $faker->randomElement([ 'M', 'F', null ]),
                'birth_date'    => $faker->randomElement([Carbon::parse($faker->dateTimeBetween( '-100 years', '-18 years' ))->format('Y-m-d'), null]),
                'newsletter'    => $faker->boolean( 70 ), //percentuale di verità con boolean, true o false
            ]);
            //primo metodo
            // UserDetails::create($user_details);

            //secondo metodo sfruttiamo una relationship
            $new_user->details()->save($user_details);
            //->attach è per hasMany, relazionni manymany con una tabella pivot in mezzo
            //per hasMany ed hasOne usiamo ->save

        }
    }

    private function createAdmin(){
        
        $faker = Faker\Factory::create('it_IT');    
        
        $admin_role = Role::where('code', 'admin')->first();

        $user_data = [
            'name'              => 'Tommaso Piccinini',
            'email'             => 'tommaso.piccio95@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password'          => Hash::make('password'),// invece di '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10),
            'role'              => $admin_role->id,
            // 'role'              => 'a',
            'last_login'        => null,
            // 'deleted_at'        => $faker->randomElement([NOW(), null]),
            'deleted_at'        => null,
        ];

        $new_user = User::create($user_data);

        $user_details = new UserDetails([
            'gender'        => 'M',
            'birth_date'    => null,
            'newsletter'    => 0,
        ]);
    }
}
