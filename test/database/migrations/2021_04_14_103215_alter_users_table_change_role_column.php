<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AlterUsersTableChangeRoleColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //RICHIEDE INSTALLAZIONE DI DOCTRINE/dbal
        //cambiamo la colonna role da una stringa a un intero che fa riferimento alla tabella dei ruoli
        // Schema::table('users', function(Blueprint $table){
            //cambiamo una colonna.
            //Ma per fare quest'operazione dobbiamo avere doctrine: composer require doctrine/dbal
            // $table->integer('role')->change();
        // });

        //PER NON USARE DOCTRINE/dbal
        DB::statement("ALTER TABLE users MODIFY role INT");

        //DOBBIAMO MODIFICARE IL SEED UsersTableSeeder DELLA COLONNA 'role'
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //RICHIEDE INSTALLAZIONE DI DOCTRINE/dbal
        //riportiamo indietro la colonna role da un integer a una stringa
        // Schema::table('users', function(Blueprint $table){
            //cambiamo una colonna
            //Ma per fare quest'operazione dobbiamo avere doctrine: composer require doctrine/dbal
            // $table->string('role')->change();
        // });

        //PER NON USARE DOCTRINE/dbal
        DB::statement("ALTER TABLE users MODIFY role VARCHAR(10)");
    }
}
