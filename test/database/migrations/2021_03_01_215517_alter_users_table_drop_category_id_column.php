<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTableDropCategoryIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //mi butta giù la colonna
        Schema::table('laravel_movies', function (Blueprint $table) {
            $table->dropColumn('category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //torna indietro mi crea la colonna
        Schema::table('laravel_movies', function (Blueprint $table) {
            $table->integer('category_id')
                  ->unsigned()
                  ->after('cover_path');
        });
    }
}
