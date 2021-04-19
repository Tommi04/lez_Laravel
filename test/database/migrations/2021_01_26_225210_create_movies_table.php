<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laravel_movies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('film_code', 10)->unique();
            $table->text('short_description')->nullable()->default("");
            $table->text('long_description')->nullable()->default("");
            $table->integer('duration')->unsigned();
            $table->string('trailer_mp4',255)->nullable()->default(null);
            $table->string('trailer_ogv',255)->nullable()->default(null);
            $table->string('trailer_webm',255)->nullable()->default(null);
            $table->string('cover_path',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laravel_movies');
    }
}
