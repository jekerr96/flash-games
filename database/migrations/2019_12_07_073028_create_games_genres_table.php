<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games_genres', function (Blueprint $table) {
            $table->bigInteger("games_id")->unsigned();
            $table->bigInteger("genres_id")->unsigned();
            $table->foreign("genres_id")->references("id")->on("genres")->onDelete("cascade");
            $table->foreign("games_id")->references("id")->on("games")->onDelete("cascade");

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
        Schema::dropIfExists('game_genre');
    }
}
