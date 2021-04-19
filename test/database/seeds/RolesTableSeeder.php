<?php

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        $roles = [
            [
                'label' => 'Administrator',
                'code' => 'admin',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'label' => 'User',
                'code' => 'user',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'label' => 'Company',
                'code' => 'commpany',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        Role::insert($roles);
            
    }
}
