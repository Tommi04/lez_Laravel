<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMoviesTableAddCategoryIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //alter table
        Schema::table('laravel_movies', function (Blueprint $table) {
            $table->integer('category_id')
                  ->unsigned()
                  ->after('cover_path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //alter table
        Schema::table('laravel_movies', function (Blueprint $table) {
            $table->dropColumn('category_id');
        });
    }
}
