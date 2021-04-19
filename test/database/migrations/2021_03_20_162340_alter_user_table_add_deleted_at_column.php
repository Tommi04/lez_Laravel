<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserTableAddDeletedAtColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //per aggiungere una colonna
        Schema::table('users',function(Blueprint $table){
            // $table->timestamp('deleted_at')->nullable()->default(null);
            //oppure
            $table->softDeletes();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table){
            $table->dropColumn('deleted_at');
            //qua non abbiamo softDeletes()
        });
    }
}
